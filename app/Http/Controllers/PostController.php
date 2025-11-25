<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function create()
    {
        return view('pages.create_post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:2048',
        ], [
            'image.image' => 'Uploaded file must be an image.',
        ]);

        // require at least one of description or image
        if (empty($request->description) && !$request->hasFile('image')) {
            return back()->withErrors(['form' => 'Post must have a description or an image.'])->withInput();
        }

        $imagePath = '';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'id_creator' => Auth::id(),
            'image' => $imagePath, // '' if none
            'description' => $request->description ?? '',
            'date' => now(),
        ]);

        return redirect()->route('home')->with('status', 'Post created successfully');
    }
    
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() != $post->id_creator) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['success' => true, 'message' => 'Post deleted successfully']);
    }
}