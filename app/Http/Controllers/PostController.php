<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
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