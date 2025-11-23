<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        // getting user so thet name appears in the title
        // If error, use findOrFail($id) that sends 404 if not found
        $user = User::findOrFail($id);

        return view('pages.profile', ['user' => $user]);
    }

    public function edit($id) {
    return "edit form placeholder"; // Placeholder
}
}
