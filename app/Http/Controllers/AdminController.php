<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AdminController extends Controller
{
    public function showAdminPage()
    {
        //$user = auth()->user(); // Get the currently logged-in user

        //if ($user->isAdmin()) {
            $users = User::all();
            return view('pages.admin', compact('users'));
        //}
        
        // User is not an admin, redirect them or show an error
        //return redirect('/')->with('error', 'Unauthorized access.');
    }

    public function searchUser(Request $request)
    {
    $search = $request->get('search');
    $users = User::query();
    
    $users = $users->all();

    if($search) {
        $users->where(function($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}")
                ->orWhere('username', 'LIKE', "%{$search}")
                ->orWhere('email', 'LIKE', "%{$search}");
        });
    }

    if ($request->ajax()) {
        return response()->json([
            'table_html' => view('pages.admin', compact('users'))->render()
        ]);
    }
    
    // If it's a standard request, return the full view
    return view('pages.admin', compact('users', 'search'));
}
}
