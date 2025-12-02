<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\Models\User;

class AdminController extends Controller
{
    public function showAdminPage(Request $request)
    {
        $user = auth()->user(); // Get the currently logged-in user

        $type = $request->query('type', 'user');

        if ($user->isAdmin()) {
            $users = User::all();
            return view('pages.admin', ['users' => $users, 'type' => $type]);
        }
        
        // User is not an admin, redirect them or show an error
        return redirect('/')->with('error', 'Unauthorized access.');
    }
    

    public function searchUser(Request $request)
    {
        $search = $request->get('search');
        $users = User::query();
        
        if($search) {
            // full-text search for name and username
            $tsquery = str_replace(' ', ' & ', trim($search));
            
            $users->where(function($query) use ($search, $tsquery) {
                // ull-text search on name and username using the index
                $query->whereRaw("tsvectors @@ to_tsquery('portuguese', ?)", [$tsquery]);
            });
        }
        
        $users = $users->get();

        if ($request->ajax()) {
            return response()->json([
                'users' => $users
            ]);
        }
        
        // If it's a standard request, return the full view
        return view('pages.admin', compact('users'));
    }

    public function showCreateUserForm()
    {
        return view('pages.create_user');
    }

    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'username' => 'required|string|max:250|unique:registered_user',
            'email' => 'required|email|max:250|unique:registered_user',
            'password' => 'required|min:8|confirmed'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        
        $user->save();

        return redirect()->route('admin');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        $user->delete();

        return redirect()->route('admin');
    }

    public function showEditUserForm($id)
    {
        $user = User::findOrFail($id);

        return view('pages.edit_user', ['user' => $user]);
    }

    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

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

        // Upload Image
        if ($request->hasFile('profile_picture')) {
    
            if ($user->profile_picture && $user->profile_picture !== 'img/default-user.png') {
                
                $oldPath = str_replace('storage/', '', $user->profile_picture);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = 'storage/' . $path;
        }

        $user->save();

        return redirect()->route('admin');
    }
}