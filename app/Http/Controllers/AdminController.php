<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminPage()
{
    //$user = auth()->user(); // Get the currently logged-in user

    //if ($user->isAdmin()) {
        // User is an admin, proceed to the admin dashboard logic
        return view('pages.admin');
    //}
    
    // User is not an admin, redirect them or show an error
    //return redirect('/')->with('error', 'Unauthorized access.');
}
}
