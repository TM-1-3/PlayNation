<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Label;

class SetupController extends Controller
{
   
    public function show()
    {
        $labels = Label::all();
        return view('auth.setup', ['labels' => $labels]);
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