<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Label;
use App\Models\Report;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Notification;
use App\Models\CommentNotification;
use App\Models\LikeCommentNotification;
use App\Models\CommentTag;


class PostController extends Controller
{
    public function create()
    {
        $labels = Label::orderBy('designation')->get();

        return view('pages.create_post', compact('labels'));
    }

    public function store(Request $request)
    {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return back()->withErrors(['form' => 'You cannot create posts because your account has been banned.'])->withInput();
        }

        $request->validate([
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:2048',
            'labels' => 'nullable|array',
            'labels.*' => 'integer|exists:label,id_label',
            'new_label' => 'nullable|string|max:255',
        
        ], [
            'image.image' => 'Uploaded file must be an image.',
        ]);

        // require at least one of description or image
        if (empty($request->description) && !$request->hasFile('image')) {
            return back()->withErrors(['form' => 'Post must have a description or an image.'])->withInput();
        }

        $post = new Post();
        $post->id_creator = Auth::id();
        $post->description = $request->description ?? '';
        $post->date = now(); 
        $post->image = ''; // default empty (NOT NULL)

        $post->save();

        if ($request->hasFile('image')) {
            $uploadrequest = new Request([
                'id' => $post->id_post,
                'type' => 'posts'
            ]);
            $uploadrequest->files->set('file', $request->file('image'));
            app(FileController::class)->upload($uploadrequest);
        }

        // handle labels: attach selected existing labels and optionally create+attach a new label
        $attachIds = $request->input('labels', []);

        if ($request->filled('new_label')) {
            $designation = trim($request->input('new_label'));
            if ($designation !== '') {
                // label.image is NOT NULL in schema; store empty string for now
                $label = Label::firstOrCreate(
                    ['designation' => $designation],
                    ['image' => '']
                );
                $attachIds[] = $label->id_label;
            }
        }

        if (!empty($attachIds)) {
            // avoid duplicates
            $post->labels()->syncWithoutDetaching(array_unique($attachIds));
        }

        return redirect()->route('home')->with('status', 'Post created successfully');
    }

   public function show($id)
    {
        // bet post w/ userdata associated
        $post = Post::with('user')->findOrFail($id);

        // initiate empty arrys for visitors
        $likedPostIds = [];
        $savedPostIds = [];

        // logd user? fill the lists
        if (Auth::check()) {
            $user = Auth::user();
            
            // gets just the idds of liked posts
            // use realtion likes of user model
            $likedPostIds = $user->likes()->pluck('post.id_post')->toArray();
            
            // gets only saved posts ids
            $savedPostIds = $user->savedPosts()->pluck('post.id_post')->toArray();
        }

        // return view w/ all data
        return view('pages.show_post', [
            'post' => $post,
            'likedPostIds' => $likedPostIds, 
            'savedPostIds' => $savedPostIds  
        ]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() != $post->id_creator) {
            abort(403);
        }

        $labels = Label::orderBy('designation')->get();

        return view('pages.edit_post', compact('post', 'labels'));
    }

    public function update(Request $request, $id)
    {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return redirect()->back()->withErrors(['form' => 'You cannot edit posts because your account has been banned.']);
        }

        $post = Post::findOrFail($id);

        if (Auth::id() != $post->id_creator) {
            return redirect()->back()->withErrors(['form' => 'Unauthorized']);
        }

        $request->validate([
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:2048',
            'labels' => 'nullable|array',
            'labels.*' => 'integer|exists:label,id_label',
            'new_label' => 'nullable|string|max:255',
        ], [
            'image.image' => 'Uploaded file must be an image.',
        ]);

        // require at least one of description or image (existing image counts)
        $hasExistingImage = !empty($post->image);
        if (empty($request->description) && !$request->hasFile('image') && !$hasExistingImage) {
            return back()->withErrors(['form' => 'Post must have a description or an image.'])->withInput();
        }

        if ($request->hasFile('image')) {
            $uploadrequest = new Request([
                'id' => $post->id_post,
                'type' => 'posts'
            ]);
            $uploadrequest->files->set('file', $request->file('image'));
            app(FileController::class)->upload($uploadrequest);
        }

        $post->description = $request->description ?? $post->description;
        $post->save();

        // handle labels (selected + optional new_label)
        $attachIds = $request->input('labels', []);

        if ($request->filled('new_label')) {
            $designation = trim($request->input('new_label'));
            if ($designation !== '') {
                $label = Label::firstOrCreate(
                    ['designation' => $designation],
                    ['image' => '']
                );
                $attachIds[] = $label->id_label;
            }
        }

        if (!empty($attachIds)) {
            $post->labels()->sync(array_unique($attachIds));
        } else {
            // remove all labels if none sent
            $post->labels()->sync([]);
        }

        return redirect()->route('profile.show', $post->id_creator ?? Auth::id())->with('status', 'Post updated successfully');
    }

    

    public function destroy($id)
    {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return redirect()->back()->withErrors(['form' => 'You cannot delete posts because your account has been banned.']);
        }

        $post = Post::findOrFail($id);
        if (Auth::id() != $post->id_creator) {
            return redirect()->back()->withErrors(['form' => 'Unauthorized']);
        }
        if (!empty($post->image)) {
            Storage::disk('storage')->delete('posts/' . $post->image);
        }
        $ownerId = $post->id_creator;
        $post->delete();
        return redirect()->route('profile.show', $ownerId)->with('status', 'Post deleted successfully');
    }

    public function save($id)
    {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return redirect()->back()->withErrors(['form' => 'You cannot save posts because your account has been banned.']);
        }

        $post = Post::findOrFail($id);
        $user = Auth::user();

        // Toggle save: if already saved, remove it; otherwise, add it
        if ($user->savedPosts()->where('post.id_post', $id)->exists()) {
            $user->savedPosts()->detach($id);
            return redirect()->route('saved.index')->with('status', 'Post unsaved');
        } else {
            $user->savedPosts()->attach($id);
            return redirect()->route('saved.index')->with('status', 'Post saved');
        }
    }

    public function showSaved()
    {
        $user = Auth::user();
        $posts = $user->savedPosts()
        ->with(['comments.user'])
        ->withCount(['likes', 'comments'])
        ->with(['user.verifiedUser', 'labels'])
        ->orderByDesc('date')
        ->get();
        $savedPostIds = $posts->pluck('id_post')->toArray();

        $likedPostIds = DB::table('post_like')
            ->where('id_user', $user->id_user)
            ->pluck('id_post')
            ->toArray();
        
        return view('pages.saved', [
            'posts' => $posts,
            'savedPostIds' => $savedPostIds,
            'likedPostIds' => $likedPostIds
        ]);
    }

    public function getLikes($id)
    {
        $post = Post::findOrFail($id);
        
        $likers = User::join('post_like', 'registered_user.id_user', '=', 'post_like.id_user')
            ->where('post_like.id_post', $id)
            ->select('registered_user.id_user', 'registered_user.username', 'registered_user.name', 'registered_user.profile_picture')
            ->get()
            ->map(function($user) {
                return [
                    'id_user' => $user->id_user,
                    'username' => $user->username,
                    'name' => $user->name,
                    'profile_picture' => $user->getProfileImage()
                ];
            });
        return response()->json(['likers' => $likers]);
        
    }

    public function toggleLike($id)
    {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return response()->json(['error' => 'You cannot like posts because your account has been banned.'], 403);
        }

        $post = Post::findOrFail($id);
        $user = Auth::user();

        // Check if user already liked the post
        $existingLike = DB::table('post_like')
            ->where('id_post', $id)
            ->where('id_user', $user->id_user)
            ->exists();

        if ($existingLike) {
            // Unlike
            DB::table('post_like')
                ->where('id_post', $id)
                ->where('id_user', $user->id_user)
                ->delete();
            $liked = false;

            // Remove notification when unliking
            $notification = DB::table('notification')
                ->join('like_post_notification', 'notification.id_notification', '=', 'like_post_notification.id_notification')
                ->where('notification.id_receiver', $post->id_creator)
                ->where('notification.id_emitter', $user->id_user)
                ->where('like_post_notification.id_post', $id)
                ->first();

            if ($notification) {
                DB::table('like_post_notification')
                    ->where('id_notification', $notification->id_notification)
                    ->delete();
                DB::table('notification')
                    ->where('id_notification', $notification->id_notification)
                    ->delete();
            }
        } else {
            // Like
            DB::table('post_like')->insert([
                'id_post' => $id,
                'id_user' => $user->id_user
            ]);
            $liked = true;

            // Create notification for post creator (if not liking own post)
            if ($post->id_creator !== $user->id_user) {
                // Check if notification already exists to avoid duplicates
                $existingNotification = DB::table('notification')
                    ->join('like_post_notification', 'notification.id_notification', '=', 'like_post_notification.id_notification')
                    ->where('notification.id_receiver', $post->id_creator)
                    ->where('notification.id_emitter', $user->id_user)
                    ->where('like_post_notification.id_post', $id)
                    ->exists();

                if (!$existingNotification) {
                    $notificationId = DB::table('notification')->insertGetId([
                        'id_receiver' => $post->id_creator,
                        'id_emitter' => $user->id_user,
                        'text' => $user->name . ' liked your post.',
                        'date' => now()
                    ], 'id_notification');

                    DB::table('like_post_notification')->insert([
                        'id_notification' => $notificationId,
                        'id_post' => $id
                    ]);
                }
            }
        }

        // Get updated like count
        $likeCount = DB::table('post_like')->where('id_post', $id)->count();

        return response()->json([
            'liked' => $liked,
            'like_count' => $likeCount
        ]);
    }

    public function getComments(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $currentUserId = Auth::id();

            // Eloquent models loaded for HTML rendering
            $query = $post->comments()->with('user')->withCount('likes'); // ADD withCount('likes')
            
            // Add search filter if provided
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
                $query->where('text', 'ILIKE', '%' . $searchTerm . '%');
            }
            
            $commentModels = $query->orderBy('date', 'desc')->get();

            // Get liked comment IDs for current user
            $likedCommentIds = [];
            if ($currentUserId) {
                $likedCommentIds = DB::table('comment_like')
                    ->where('id_user', $currentUserId)
                    ->pluck('id_comment')
                    ->toArray();
            }

            // If HTML requested, render Blade partial and return HTML
            if ($request->query('format') === 'html') {
                return response()->view('partials.comments_list', [
                    'comments' => $commentModels,
                    'postId' => $id,
                    'likedCommentIds' => $likedCommentIds,
                ]);
            }

            // Default JSON response (existing behavior)
            $comments = $commentModels->map(function ($comment) use ($currentUserId, $likedCommentIds) {
                return [
                    'id_comment' => $comment->id_comment,
                    'text' => $comment->text,
                    'date' => \Carbon\Carbon::parse($comment->date)->diffForHumans(),
                    'is_owner' => $currentUserId === $comment->id_user,
                    'likes_count' => $comment->likes_count ?? 0,
                    'is_liked' => in_array($comment->id_comment, $likedCommentIds),
                    'user' => [
                        'id_user' => $comment->user->id_user,
                        'username' => $comment->user->username,
                        'name' => $comment->user->name,
                        'profile_picture' => $comment->user->getProfileImage(),
                    ],
                ];
            });

            return response()->json(['comments' => $comments]);
        } catch (\Exception $e) {
            \Log::error('Error fetching comments: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function toggleCommentLike($id)
    {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return response()->json(['error' => 'You cannot like comments because your account has been banned.'], 403);
        }

        try {
            $comment = Comment::findOrFail($id);
            $user = Auth::user();

            // Check if user already liked the comment
            $existingLike = DB::table('comment_like')
                ->where('id_comment', $id)
                ->where('id_user', $user->id_user)
                ->exists();

            if ($existingLike) {
                // Unlike
                DB::table('comment_like')
                    ->where('id_comment', $id)
                    ->where('id_user', $user->id_user)
                    ->delete();
                $liked = false;

                // Remove notification when unliking
                $notification = DB::table('notification')
                    ->join('like_comment_notification', 'notification.id_notification', '=', 'like_comment_notification.id_notification')
                    ->where('notification.id_receiver', $comment->id_user)
                    ->where('notification.id_emitter', $user->id_user)
                    ->where('like_comment_notification.id_comment', $id)
                    ->first();

                if ($notification) {
                    DB::table('like_comment_notification')
                        ->where('id_notification', $notification->id_notification)
                        ->delete();
                    DB::table('notification')
                        ->where('id_notification', $notification->id_notification)
                        ->delete();
                }
            } else {
                // Like
                DB::table('comment_like')->insert([
                    'id_comment' => $id,
                    'id_user' => $user->id_user
                ]);
                $liked = true;

                // Create notification for comment owner (if not liking own comment)
                if ($comment->id_user !== $user->id_user) {
                    // Check if notification already exists to avoid duplicates
                    $existingNotification = DB::table('notification')
                        ->join('like_comment_notification', 'notification.id_notification', '=', 'like_comment_notification.id_notification')
                        ->where('notification.id_receiver', $comment->id_user)
                        ->where('notification.id_emitter', $user->id_user)
                        ->where('like_comment_notification.id_comment', $id)
                        ->exists();

                    if (!$existingNotification) {
                        $notificationId = DB::table('notification')->insertGetId([
                            'id_receiver' => $comment->id_user,
                            'id_emitter' => $user->id_user,
                            'text' => $user->name . ' liked your comment.',
                            'date' => now()
                        ], 'id_notification');

                        DB::table('like_comment_notification')->insert([
                            'id_notification' => $notificationId,
                            'id_comment' => $id
                        ]);
                    }
                }
            }

            // Get updated like count
            $likeCount = DB::table('comment_like')->where('id_comment', $id)->count();

            return response()->json([
                'success' => true,
                'liked' => $liked,
                'like_count' => $likeCount
            ]);
        } catch (\Exception $e) {
            \Log::error('Error toggling comment like: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addComment(Request $request, $id)
    {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return response()->json(['error' => 'You cannot comment because your account has been banned.'], 403);
        }

        try {
            $request->validate([
                'comment_text' => 'required|string|max:1000',
            ]);

            $post = Post::findOrFail($id);
            $user = Auth::user();

            $commentText = $request->input('comment_text');

            // Create comment
            $comment = Comment::create([
                'id_post' => $id,
                'id_user' => $user->id_user,
                'text' => $commentText,
                'date' => now(),
            ]);

            // Extract tagged users from comment text (@username)
            preg_match_all('/@(\w+)/', $commentText, $matches);
            $taggedUsernames = array_unique($matches[1]);
            
            foreach ($taggedUsernames as $username) {
                $taggedUser = User::where('username', $username)->first();
                if ($taggedUser) {
                    // Save tag
                    DB::table('user_tag')->insert([
                        'id_comment' => $comment->id_comment,
                        'id_user' => $taggedUser->id_user
                    ]);
                    
                    // Create notification for tagged user (if not tagging self)
                    if ($taggedUser->id_user !== $user->id_user) {
                        $notificationId = DB::table('notification')->insertGetId([
                            'id_receiver' => $taggedUser->id_user,
                            'id_emitter' => $user->id_user,
                            'text' => $user->name . ' tagged you in a comment.',
                            'date' => now()
                        ], 'id_notification');

                        DB::table('comment_notification')->insert([
                            'id_notification' => $notificationId,
                            'id_comment' => $comment->id_comment
                        ]);
                    }
                }
            }

            // Create notification for post creator (if not commenting on own post and not already notified)
            if ($post->id_creator !== $user->id_user) {
                $notificationId = DB::table('notification')->insertGetId([
                    'id_receiver' => $post->id_creator,
                    'id_emitter' => $user->id_user,
                    'text' => $user->name . ' commented on your post.',
                    'date' => now()
                ], 'id_notification');

                DB::table('comment_notification')->insert([
                    'id_notification' => $notificationId,
                    'id_comment' => $comment->id_comment
                ]);
            }

            // Return success immediately - no need for transaction wrapping
            return response()->json([
                'success' => true,
                'comment' => [
                    'id_comment' => $comment->id_comment,
                    'text' => $comment->text,
                    'date' => \Carbon\Carbon::parse($comment->date)->diffForHumans(),
                    'user' => [
                        'id_user' => $user->id_user,
                        'username' => $user->username,
                        'name' => $user->name,
                        'profile_picture' => $user->getProfileImage(),
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error adding comment: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateComment(Request $request, $id)
    {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return response()->json(['error' => 'You cannot edit comments because your account has been banned.'], 403);
        }

        try {
            $comment = Comment::findOrFail($id);
            
            // Check if user owns the comment
            if (Auth::id() !== $comment->id_user) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $request->validate([
                'text' => 'required|string|max:1000',
            ]);

            $comment->text = $request->text;
            $comment->save();

            return response()->json([
                'success' => true,
                'comment' => [
                    'id_comment' => $comment->id_comment,
                    'text' => $comment->text,
                    'date' => \Carbon\Carbon::parse($comment->date)->diffForHumans(),
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating comment: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteComment($id)
    {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return response()->json(['error' => 'You cannot delete comments because your account has been banned.'], 403);
        }

        try {
            $comment = Comment::findOrFail($id);
            
            // Check if user owns the comment
            if (Auth::id() !== $comment->id_user) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $postId = $comment->id_post;
            $comment->delete();

            // Get updated comment count
            $commentCount = Comment::where('id_post', $postId)->count();

            return response()->json([
                'success' => true,
                'comment_count' => $commentCount
            ]);
        } catch (\Exception $e) {
            \Log::error('Error deleting comment: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function searchComments(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $searchTerm = $request->query('search', '');
            $currentUserId = Auth::id();
            
            $query = $post->comments()->with('user')->withCount('likes'); // ADD withCount('likes')
            
            if (!empty($searchTerm)) {
                $query->where('text', 'ILIKE', '%' . $searchTerm . '%');
            }
            
            $comments = $query->orderBy('date', 'desc')->get();

            // Get liked comment IDs
            $likedCommentIds = [];
            if ($currentUserId) {
                $likedCommentIds = DB::table('comment_like')
                    ->where('id_user', $currentUserId)
                    ->pluck('id_comment')
                    ->toArray();
            }
            
            // Return HTML for AJAX update
            if ($request->expectsJson() || $request->ajax()) {
                $html = view('partials.comments_list', [
                    'comments' => $comments,
                    'postId' => $id,
                    'likedCommentIds' => $likedCommentIds,
                ])->render();
                
                return response()->json([
                    'html' => $html,
                    'count' => $comments->count()
                ]);
            }
            
            return response()->json(['comments' => $comments]);
        } catch (\Exception $e) {
            \Log::error('Error searching comments: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}