<?php
 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }

    public function authenticate(Request $request): RedirectResponse
    {
        
        $request->validate([
            'usernameEmail' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $inputValue = $request->input('usernameEmail');

        if (filter_var($inputValue, FILTER_VALIDATE_EMAIL)) {
            $fieldType = 'email';
        }
        else {
            $fieldType = 'username';
        }
        
        $credentials = [
            $fieldType => $inputValue,
            'password' => $request->input('password')
        ];
 
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }
 
        return back()->withErrors([
            'email' => 'Wrong email or password',
        ])->onlyInput('email');
    }
}
