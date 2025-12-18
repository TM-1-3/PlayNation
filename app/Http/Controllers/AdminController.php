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
        $user = auth()->user();

        $type = $request->query('type', 'user');

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

            $reportedUsers = User::whereHas('reports')
                ->with(['verifiedUser', 'reports'])
                ->get()
                ->map(function($user) {
                    $user->report_count = $user->reports->count();
                    $user->report_descriptions = $user->reports->pluck('description')->toArray();
                    return $user;
                })
                ->sortByDesc('report_count');

            $reportedGroups = Group::whereHas('reports')
                ->with(['owner', 'reports'])
                ->get()
                ->map(function($group) {
                    $group->report_count = $group->reports->count();
                    $group->report_descriptions = $group->reports->pluck('description')->toArray();
                    return $group;
                })
                ->sortByDesc('report_count');

            return view('pages.admin', ['reportedPosts' => $reportedPosts, 'reportedUsers' => $reportedUsers, 'reportedGroups' => $reportedGroups, 'type' => $type]);
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
        // Redirect to unified edit form with admin flag
        return redirect()->route('profile.edit', ['id' => $id, 'from' => 'admin']);
    }

    // Removed: editUser method - now handled by UserController::update

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

    public function dismissUserReports($id)
    {
        $user = User::findOrFail($id);
        $user->reports()->detach();

        return redirect()->back()->with('status', 'User reports dismissed successfully.');
    }

    public function dismissGroupReports($id)
    {
        $group = Group::findOrFail($id);
        $group->reports()->detach();

        return redirect()->back()->with('status', 'Group reports dismissed successfully.');
    }

    public function deleteGroup($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return redirect()->back()->with('status', 'Group deleted successfully.');
    }

    public function dismissReports($id)
    {
        $post = Post::findOrFail($id);
        
        $post->reports()->detach();

        return redirect()->back()->with('status', 'Reports dismissed successfully.');
    }
}