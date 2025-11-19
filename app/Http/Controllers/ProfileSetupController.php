<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Label;

class ProfileSetupController extends Controller
{
   
    public function show()
    {
        // Fetch all labels to display as cards
        $labels = Label::all();
        return view('auth.profile-setup', ['labels' => $labels]);
    }


    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'biography' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|max:2048', 
            'labels' => 'array', 
            'labels.*' => 'exists:label,id_label',
        ]);

        $user->biography = $request->biography;
        $user->is_public = $request->has('is_public');

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path; 
        }

        $user->save();

        if ($request->has('labels')) {
            $user->labels()->sync($request->labels);
        }

        return redirect()->route('cards.index');
    }
}