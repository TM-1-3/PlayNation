<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use App\Models\User;

class AdminController extends Controller
{
    public function showAdminPage()
    {
        //$user = auth()->user(); // Get the currently logged-in user

        //if ($user->isAdmin()) {
            $users = User::all();
            return view('pages.admin', compact('users'));
        //}
        
        // User is not an admin, redirect them or show an error
        //return redirect('/')->with('error', 'Unauthorized access.');
    }
    

    public function searchUser(Request $request)
    {
        $search = $request->get('search');
        $users = User::query();
        
        if($search) {
            $users->where(function($query) use ($search) {
                $query->where('name', 'ILIKE', "%{$search}%")
                    ->orWhere('username', 'ILIKE', "%{$search}%")
                    ->orWhere('email', 'ILIKE', "%{$search}%");
                    
                if (is_numeric($search)) {
                    $query->orWhere('id_user', (int)$search);
                }
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
        return view('partials.create');
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
}