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
}
