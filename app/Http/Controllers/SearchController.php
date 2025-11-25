<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');
        $users = User::query();
        
        if($search) {
            // full-text search for name and username
            $tsquery = str_replace(' ', ' & ', trim($search));
            
            $users->where(function($query) use ($search, $tsquery) {
                // ull-text search on name and username using the index
                $query->whereRaw("tsvectors @@ to_tsquery('portuguese', ?)", [$tsquery]);
            });
        }
        
        $users = $users->get();

        if ($request->ajax()) {
            return response()->json([
                'users' => $users
            ]);
        }
        
        // If it's a standard request, return the full view
        return view('pages.admin', compact('users'));
    }
}

