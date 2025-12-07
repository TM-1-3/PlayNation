<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TimelineController extends Controller {

    public function index(Request $request): View {

        /** @var User|null $user */
        $user = Auth::user();

        $timelineType = $request->query('timeline', 'public');

        $query = Post::with(['user.verifiedUser', 'labels']);

        if ($user && $timelineType === 'following') {
            // avoid ambiguity between registered_user.id_user and user_friend.id_user
            $followingIds = $user->following()->pluck('registered_user.id_user')->toArray();

            // if user follows nobody return empty collection quickly
            if (empty($followingIds)) {
                $posts = collect();
                return view('pages.home', ['posts' => $posts, 'activeTimeline' => $timelineType]);
            }

            $query->whereIn('id_creator', $followingIds)
                  ->orderByDesc('date');

        } else if ($user && $timelineType === 'personalized') {

            $userLabels = $user->labels()->pluck('label.id_label')->toArray();
            if (!empty($userLabels)) {
                $query->withCount(['labels as relevance' => function ($q) use ($userLabels) {
                    $q->whereIn('label.id_label', $userLabels);
                }])
                ->orderByDesc('relevance')
                ->orderByDesc('date');
            } 
            else {
                $query->orderByDesc('date');
            }
        }  
        else {
            $query->orderByDesc('date');
        }

        // Filter posts: only show posts from public profiles, from friends, or own posts
        if ($user) {
            $query->where(function($q) use ($user) {
                $q->where('id_creator', $user->id_user) // Own posts
                ->orWhereHas('user', function($userQuery) {
                    $userQuery->where('is_public', true);
                })
                ->orWhereHas('user', function($userQuery) use ($user) {
                    $userQuery->whereIn('id_user', function($subQuery) use ($user) {
                        $subQuery->select('id_friend')
                            ->from('user_friend')
                            ->where('id_user', $user->id_user);
                    });
                });
            });
        } else {
            // Guest users can only see public posts
            $query->whereHas('user', function($userQuery) {
                $userQuery->where('is_public', true);
            });
        }

        $posts = $query->get();

        return view('pages.home', ['posts' => $posts, 'activeTimeline' => $timelineType]);
    }

    public function searchPost(Request $request)
    {
        $search = $request->get('search');
        
        if ($search) {
            $input = $search . ':*';
            $postIds = Post::leftJoin('registered_user', 'post.id_creator', '=', 'registered_user.id_user')
                         ->leftJoin('post_label', 'post.id_post', '=', 'post_label.id_post')
                         ->leftJoin('label', 'post_label.id_label', '=', 'label.id_label')
                         ->whereRaw("
                             post.tsvectors @@ to_tsquery('portuguese', ?) OR
                             registered_user.tsvectors @@ to_tsquery('portuguese', ?) OR
                             to_tsvector('portuguese', label.designation) @@ to_tsquery('portuguese', ?)
                         ", [$input, $input, $input])
                         ->select('post.id_post')
                         ->selectRaw("
                             ts_rank(post.tsvectors, to_tsquery('portuguese', ?)) +
                             ts_rank(registered_user.tsvectors, to_tsquery('portuguese', ?)) +
                             ts_rank(to_tsvector('portuguese', COALESCE(label.designation, '')), to_tsquery('portuguese', ?)) as rank
                         ", [$input, $input, $input])
                         ->distinct()
                         ->orderByDesc('rank')
                         ->pluck('id_post');
            
            // Load the posts with relationships in the correct order
            $posts = Post::with(['user', 'labels'])
                         ->whereIn('id_post', $postIds)
                         ->get()
                         ->sortBy(function($post) use ($postIds) {
                             return array_search($post->id_post, $postIds->toArray());
                         })
                         ->values();
        } else {
            $posts = Post::with(['user', 'labels'])->get();
        }

        if ($request->ajax()) {
            // Transform posts to include profile_image and post_image for consistency
            $posts = $posts->map(function($post) {
                $postArray = $post->toArray();
                if (isset($postArray['user'])) {
                    $postArray['user']['profile_picture'] = $post->user->getProfileImage();
                }
                $postArray['image'] = $post->getPostImage();
                return $postArray;
            });
            
            return response()->json([
                'posts' => $posts
            ]);
        }
        
        return view('pages.home', ['posts' => $posts]);
    }

}
