<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Label;

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

        $user = User::withCount(['posts', 'followers', 'following'])->with('labels')->findOrFail($id);

        $posts = $user->posts()
                      ->with(['comments.user'])
                      ->withCount(['likes', 'comments'])
                      ->orderBy('date', 'desc')
                      ->get();

        $currentUser = Auth::user();
        $savedPostIds = $currentUser ? $currentUser->savedPosts()->pluck('post.id_post')->toArray() : [];

        $likedPostIds = $currentUser ? DB::table('post_like')
            ->where('id_user', $currentUser->id_user)
            ->pluck('id_post')
            ->toArray() : [];

        return view('pages.profile', [
            'user' => $user,
            'posts' => $posts,
            'isFriend' => $isFriend,
            'requestSent' => $requestSent,
            'savedPostIds' => $savedPostIds,
            'likedPostIds' => $likedPostIds
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

        $allLabels = Label::all();

        return view('pages.edit_profile', [
            'user' => $user,
            'isAdmin' => $isAdmin,
            'fromAdmin' => $request->query('from') === 'admin',
            'allLabels' => $allLabels
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
            'profile_picture' => 'nullable|image|max:4096', 
            'password' => 'nullable|string|min:8|confirmed',
            'labels' => 'array', 
            'labels.*' => 'exists:label,id_label'
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

        $user->labels()->sync($request->input('labels', []));

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
        $currentUserId = Auth::id();
        
        $query = User::query();
        
        $query->with('verifiedUser');
        
        if ($search) {
            $input = $search . ':*';
            $query->whereRaw("tsvectors @@ to_tsquery('portuguese', ?)", [$input]);
        }
        
        // Apply filters from filter form
        $query = $this->filterUsers($query, $request);
        
        $users = $query->get();

        if ($request->ajax()) {
            $users = $users->map(function($user) {
                return [
                    'id_user' => $user->id_user,
                    'name' => $user->name,
                    'username' => $user->username,
                    'profile_image' => $user->getProfileImage(),
                    'is_verified' => $user->verifiedUser !== null
                ];
            });
            
            return response()->json([
                'users' => $users
            ]);
        }
        
        // If it's a standard request, return the full view
        return view('pages.search', ['users' => $users]);
    }

    private function filterUsers($query, Request $request)
    {
        $search = $request->get('search');
        $currentUserId = Auth::id();
        
        // Filter by username using vectors
        $username = $request->query('username');
        if ($username) {
            $input = $username . ':*';
            $query->whereRaw("tsvectors @@ to_tsquery('portuguese', ?)", [$input]);
        }
        
        // Filter by verified users
        if ($request->has('verified')) {
            $query->whereHas('verifiedUser');
        }
        
        // Filter by minimum followers using whereRaw with subquery
        $minFollowers = $request->query('min_followers', 0);
        if ($minFollowers > 0) {
            $query->whereRaw('(select count(*) from "user_friend" where "user_friend"."id_friend" = "registered_user"."id_user") >= ?', [$minFollowers]);
        }
        
        // Filter by minimum common friends using whereRaw with subquery
        $minCommonFriends = $request->query('min_common_friends', 0);
        if ($minCommonFriends > 0 && $currentUserId) {
            $query->whereRaw('(select count(*) from "user_friend" as "uf1" where "uf1"."id_friend" = "registered_user"."id_user" and "uf1"."id_user" in (select "id_friend" from "user_friend" where "id_user" = ?)) >= ?', [$currentUserId, $minCommonFriends]);
        }
        
        // Apply sort option
        $sort = $request->query('sort', 'relevance');
        switch ($sort) {
            case 'followers':
                $query->orderByRaw('(select count(*) from "user_friend" where "user_friend"."id_friend" = "registered_user"."id_user") DESC');
                break;
            case 'common_friends':
                if ($currentUserId) {
                    $query->orderByRaw('(select count(*) from "user_friend" as "uf1" where "uf1"."id_friend" = "registered_user"."id_user" and "uf1"."id_user" in (select "id_friend" from "user_friend" where "id_user" = ?)) DESC', [$currentUserId]);
                } else {
                    // Fallback to followers if not authenticated
                    $query->orderByRaw('(select count(*) from "user_friend" where "user_friend"."id_friend" = "registered_user"."id_user") DESC');
                }
                break;
            case 'username':
                $query->orderBy('username', 'ASC');
                break;
            case 'relevance':
            default:
                if ($search) {
                    $input = $search . ':*';
                    $query->orderByRaw("ts_rank(tsvectors, to_tsquery('portuguese', ?)) DESC", [$input]);
                } else {
                    // Fallback to followers count when no search term
                    $query->orderByRaw('(select count(*) from "user_friend" where "user_friend"."id_friend" = "registered_user"."id_user") DESC');
                }
                break;
        }
        
        return $query;
    }

}

