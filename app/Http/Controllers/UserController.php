<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function show($id)
    {
        // getting user so thet name appears in the title
        // If error, use findOrFail($id) that sends 404 if not found
        $user = User::findOrFail($id);

        $authId = Auth::id();

        $isFriend = false;

        $requestSent = false;

        if ($authId) {
            $isFriend = DB::table('user_friend')
                ->where('id_user', $authId)->where('id_friend', $user->id_user)
                ->exists();

            $requestSent = DB::table('user_friend_request')
                ->where('id_requester', $authId)->where('id_user', $user->id_user)
                ->exists();
        }

        $user = User::withCount(['posts', 'followers', 'following'])->findOrFail($id);

        $posts = $user->posts()
                      ->orderBy('date', 'desc')
                      ->get();

        $currentUser = Auth::user();
        $savedPostIds = $currentUser ? $currentUser->savedPosts()->pluck('post.id_post')->toArray() : [];

        return view('pages.profile', [
            'user' => $user,
            'posts' => $posts,
            'isFriend' => $isFriend,
            'requestSent' => $requestSent,
            'savedPostIds' => $savedPostIds
        ]);
    }
    
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $currentUser = Auth::user();
        $isAdmin = $currentUser && $currentUser->isAdmin();

        // only profile owner or admin can edit
        if (Auth::id() !== $user->id_user && !$isAdmin) {
            return redirect()->route('profile.show', $id)
                ->with('status', 'Não tens permissão para editar este perfil.');
        }

        return view('pages.edit_profile', [
            'user' => $user,
            'isAdmin' => $isAdmin,
            'fromAdmin' => $request->query('from') === 'admin'
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $currentUser = Auth::user();
        $isAdmin = $currentUser && $currentUser->isAdmin();

        // only profile owner or admin can update
        if (Auth::id() !== $user->id_user && !$isAdmin) {
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

        if ($request->hasFile('profile_picture')) {
            $uploadrequest = new Request([
                'id' => $user->id_user,
                'type' => 'profile'
            ]);
            $uploadrequest->files->set('file', $request->file('profile_picture'));
            app(FileController::class)->upload($uploadrequest);
        }

        $user->save();

        // Redirect based on where the edit came from
        $fromAdmin = $request->input('from_admin');
        if ($fromAdmin && $isAdmin) {
            return redirect()->route('admin')->with('status', 'User updated successfully!');
        }

        return redirect()->route('profile.show', $user->id_user)
            ->with('status', 'Profile updated successfully!');
    }

    public function searchUser(Request $request)
    {
        $search = $request->get('search');
        
        if ($search) {
            $input = $search . ':*';
            $users = User::whereRaw("tsvectors @@ to_tsquery('portuguese', ?)", [$input])
                         ->orderByRaw("ts_rank(tsvectors, to_tsquery('portuguese', ?)) DESC", [$input])
                         ->get();
        } else {
            $users = User::all();
        }

        if ($request->ajax()) {
            $users = $users->map(function($user) {
                return [
                    'id_user' => $user->id_user,
                    'name' => $user->name,
                    'username' => $user->username,
                    'profile_image' => $user->getProfileImage()
                ];
            });
            
            return response()->json([
                'users' => $users
            ]);
        }
        
        // If it's a standard request, return the full view
        return view('pages.search', ['users' => $users, '']);
    }

}

