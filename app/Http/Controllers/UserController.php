<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    public function show($id)
    {
        // getting user so thet name appears in the title
        // If error, use findOrFail($id) that sends 404 if not found
        //$user = User::findOrFail($id);

        $user = User::withCount(['posts', 'followers', 'following'])->findOrFail($id);

        $posts = $user->posts()
                      ->orderBy('date', 'desc')
                      ->get();

        return view('pages.profile', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // only profile owner can edit
        if (Auth::id() !== $user->id_user) {
            return redirect()->route('profile.show', $id)
                ->with('status', 'Não tens permissão para editar este perfil.');
        }

        return view('pages.edit_profile', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() !== $user->id_user) { // only profile owner can update
            return redirect()->route('profile.show', $id)->with('status', 'Unauthorized action.');
        }

        // validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('registered_user')->ignore($user->id_user, 'id_user')],
            'email' => ['required', 'email', 'max:255', Rule::unique('registered_user')->ignore($user->id_user, 'id_user')],
            'biography' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|max:4096', // Max 4MB
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // update user data
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->biography = $request->biography;
        
        $user->is_public = $request->has('is_public');

        // Password updates only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $filename = '';
        if ($request->hasFile('profile_picture')) {
            if (!empty($user->id_user) && File::exists(public_path($user->profile_picture))) {
                File::delete(public_path($user->profile_picture));
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/users'), $filename);
            
            $user->profile_picture = 'img/users/' . $filename;
        }

        $user->save();

        return redirect()->route('profile.show', $user->id_user)
            ->with('status', 'Profile updated successfully!');
    }
}

