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
        
        if($search) {
            $users->where(function($query) use ($search) {
                $query->where('name', 'ILIKE', "%{$search}%")
                    ->orWhere('username', 'ILIKE', "%{$search}%")
                    ->orWhere('email', 'ILIKE', "%{$search}%");
                    
                if (is_numeric($search)) {
                    $query->orWhere('id_user', (int)$search);
                }
            });
        }
        
        $users = $users->get();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.admin-users-table', compact('users'))->render(),
            ]);
        }
        
        // If it's a standard request, return the full view
        return view('pages.admin', compact('users'));
    }
}
