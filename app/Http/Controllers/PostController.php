<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Label;
use App\Models\Report;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function create()
    {
        $labels = Label::orderBy('designation')->get();

        return view('pages.create_post', compact('labels'));
    }

    public function store(Request $request)
    {
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
        ->withCount('likes')
        ->with(['user.verifiedUser', 'labels'])
        ->orderByDesc('date')
        ->get();
        $savedPostIds = $posts->pluck('id_post')->toArray();
        
        return view('pages.saved', ['posts' => $posts, 'savedPostIds' => $savedPostIds]);
    }

    public function report(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string',
            'details' => 'nullable|string|max:1000',
        ]);

        $description = $request->reason;
        if ($request->filled('details')) {
            $description .= ': ' . $request->details;
        }

        $report = Report::create([
            'description' => $description
        ]);

        $report->posts()->attach($id);

        return redirect()->back()->with('status', 'Post reported successfully. Admins will review it.');
    }
}