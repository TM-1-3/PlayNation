<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'username' => 'required|string|max:250|unique:registered_user',
            'email' => 'required|email|max:250|unique:registered_user',
            'password' => 'required|min:8|confirmed'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $request->session()->put('registration_data', $validatedData);

        return redirect()->route('profile.setup');
    }
}