<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\VerifiedUser;

use App\Models\User;
use App\Models\Group;
use App\Models\Post;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function showAdminPage(Request $request)
    {
        $user = auth()->user(); // Get the currently logged-in user

        $type = $request->query('type', 'user',  'groups');

        if (!$type) {
            $type = 'user';
        }

        if ($user->isAdmin() && $type == 'user') {
            $users = User::all();
            return view('pages.admin', ['users' => $users, 'type' => $type]);
        }

        if ($user->isAdmin() && $type == 'content') {
            $reportedPosts = Post::whereHas('reports')
                ->with(['user.verifiedUser', 'labels', 'reports'])
                ->get()
                ->map(function($post) {
                    $post->report_count = $post->reports->count();
                    $post->report_descriptions = $post->reports->pluck('description')->toArray();
                    return $post;
                })
                ->sortByDesc('report_count');
            
            return view('pages.admin', ['reportedPosts' => $reportedPosts, 'type' => $type]);
        }

        if ($user->isAdmin() && $type == 'group') {
            $groups = Group::all();
            return view('pages.admin', ['groups' => $groups, 'type' => $type]);
        }
        
        // User is not an admin, redirect them or show an error
        return redirect('/')->with('error', 'Unauthorized access.');
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
            return response()->json([
                'users' => $users
            ]);
        }
        
        // If it's a standard request, return the full view
        return view('pages.admin', ['users' => $users, 'type' => 'user']);
    }

    public function searchGroup(Request $request)
    {
        $search = $request->get('search');
        
        if ($search) {
            $input = $search . ':*';
            $groups = Group::whereRaw("tsvectors @@ to_tsquery('portuguese', ?)", [$input])
                         ->orderByRaw("ts_rank(tsvectors, to_tsquery('portuguese', ?)) DESC", [$input])
                         ->get();
        } else {
            $groups = Group::all();
        }

        if ($request->ajax()) {

            $groups = $groups->map(function($group) {
                $groupArray = $group->toArray();
                $groupArray['picture'] = $group->getGroupPicture();
                return $groupArray;
            });

            return response()->json([
                'groups' => $groups
            ]);
        }
        
        // If it's a standard request, return the full view
        return view('pages.admin', ['groups' => $groups, 'type' => 'group']);
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

    public function verifyUser($id){

        $user = User::findOrFail($id);

        VerifiedUser::create(['id_verified' => $user->id_user]);

        return redirect()->back()->with('status', 'User verified successfully.');
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        
        $post->delete();

        return redirect()->back()->with('status', 'Reported post deleted successfully.');
    }

    public function dismissReports($id)
    {
        $post = Post::findOrFail($id);
        
        $post->reports()->detach();

        return redirect()->back()->with('status', 'Reports dismissed successfully.');
    }
}