<?php
 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class RecoverPasswordController extends Controller
{

    public function showRecoverPasswordForm()
    {
        return view('auth.recoverPassword');  
    }

    public function sendRecoverEmail(Request $request){

        $request->validate(['email' => 'required|email|max:250']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => __($status)]);
        } 
        return back()->withErrors(['email' => __($status)]);
        
    }
}
