<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Label;
use App\Models\User;

class SetupController extends Controller
{
    public function show(Request $request)
    {
        if (!$request->session()->has('registration_data')) {
            return redirect()->route('register');
        }

        $labels = Label::all();
        return view('auth.setup', ['labels' => $labels]);
    }

    public function store(Request $request)
    {

        $registrationData = $request->session()->get('registration_data');

        if (!$registrationData) {
            return redirect()->route('register')->withErrors(['msg' => 'Session expired. Please register again.']);
        }

        $request->validate([
            'biography' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|max:2048',
            'labels' => 'array',
            'labels.*' => 'exists:label,id_label',
        ]);

        $user = new User();
        $user->name = $registrationData['name'];
        $user->username = $registrationData['username'];
        $user->email = $registrationData['email'];
        $user->password = $registrationData['password'];
        
        $user->biography = $request->biography;
        $user->is_public = $request->has('is_public');

        /*if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = 'storage/' . $path;
        }*/

        if ($request->hasFile('image')) {
            $uploadrequest = new Request([
                'id' => $user->id_user,
                'type' => 'profile'
            ]);
            $uploadrequest->files->set('file', $request->file('profile_picture'));
            app(FileController::class)->upload($uploadrequest);
        }

        $user->save();

        if ($request->has('labels')) {
            $user->labels()->sync($request->labels);
        }

        Auth::login($user);

        $request->session()->forget('registration_data');
        $request->session()->regenerate();

        return redirect()->route('home');
    }
}