<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Label;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $currentUser = Auth::user();

        // check block status
        $isBlockedByMe = false;
        $amIBlocked = false;

        if ($currentUser) {
            $isBlockedByMe = $currentUser->hasBlocked($user->id_user);
            $amIBlocked = $user->hasBlocked($currentUser->id_user);
        }

        // if he blocked me, show 404 
        if ($amIBlocked) {
            return view('pages.profile', [
                'user' => $user,
                'userUnavailable' => true, // flag to view
                'isBlockedByMe' => false,
                'posts' => collect(), // empty lists
                'isFriend' => false,
                'requestSent' => false,
                'savedPostIds' => [],
                'likedPostIds' => []
            ]);
        }

        // if i blocked him, show limited profile
        if ($isBlockedByMe) {
            // dont load posts or friendship status
            return view('pages.profile', [
                'user' => $user,
                'isBlockedByMe' => true, // flag to view
                'userUnavailable' => false,
                'posts' => collect(),
                'isFriend' => false,
                'requestSent' => false,
                'savedPostIds' => [],
                'likedPostIds' => []
            ]);
        }
        
        // load counts n labels
        $user = User::withCount(['posts', 'followers', 'following'])->with('labels')->findOrFail($id);

        // verify friendship status
        $isFriend = false;
        $requestSent = false;

        if ($currentUser) {
            $isFriend = DB::table('user_friend')
                ->where('id_user', $currentUser->id_user)->where('id_friend', $user->id_user)
                ->exists();

            $requestSent = DB::table('user_friend_request')
                ->where('id_requester', $currentUser->id_user)->where('id_user', $user->id_user)
                ->exists();
        }

        // load posts
        $posts = $user->posts()
                      ->with(['comments.user'])
                      ->withCount(['likes', 'comments'])
                      ->orderBy('date', 'desc')
                      ->get();

        $savedPostIds = $currentUser ? $currentUser->savedPosts()->pluck('post.id_post')->toArray() : [];
        $likedPostIds = $currentUser ? DB::table('post_like')->where('id_user', $currentUser->id_user)->pluck('id_post')->toArray() : [];

        return view('pages.profile', [
            'user' => $user,
            'posts' => $posts,
            'isFriend' => $isFriend,
            'requestSent' => $requestSent,
            'savedPostIds' => $savedPostIds,
            'likedPostIds' => $likedPostIds,
            'isBlockedByMe' => false, // not blocked, show full content
            'userUnavailable' => false // user is available
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

        // Check if user is banned (only for non-admin updates)
        if (!$isAdmin && $currentUser->isBanned()) {
            return redirect()->route('profile.show', $id)->withErrors(['form' => 'You cannot edit your profile because your account has been banned.']);
        }

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

    public function block($id)
    {
        $userToBlock = User::findOrFail($id);
        $currentUser = Auth::user();

        if ($currentUser->id_user === $userToBlock->id_user) {
            return back()->with('error', 'You cannot block yourself.');
        }

        // if blocked, unblock; else block
        if ($currentUser->hasBlocked($userToBlock->id_user)) {
            $currentUser->blockedUsers()->detach($userToBlock->id_user);
            $message = 'User unblocked successfully.';
        } else {
            $currentUser->blockedUsers()->attach($userToBlock->id_user);
            
            // remove friend connection both ways
            DB::table('user_friend')->where('id_user', $currentUser->id_user)->where('id_friend', $userToBlock->id_user)->delete();
            DB::table('user_friend')->where('id_user', $userToBlock->id_user)->where('id_friend', $currentUser->id_user)->delete();
            
            // remove pending friend requests both ways
            DB::table('user_friend_request')->where('id_requester', $currentUser->id_user)->where('id_user', $userToBlock->id_user)->delete();
            DB::table('user_friend_request')->where('id_requester', $userToBlock->id_user)->where('id_user', $currentUser->id_user)->delete();

            $message = 'User blocked. Content hidden.';
        }

        return redirect()->route('home')->with('status', $message);
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $currentUser = Auth::user();

        if ($currentUser->id_user !== $user->id_user) {
            return back()->with('error', 'Unauthorized action');
        }

        if ($user->profile_picture && $user->profile_picture !== 'img/default_avatar.png') {
            if (file_exists(public_path($user->profile_picture))) {
               unlink(public_path($user->profile_picture));
            }
        }

        $timestamp = time(); 
    
        $user->name = 'Deleted User';
    
        $user->username = 'deleted_' . $user->id_user . '_' . $timestamp;
    
        $user->email = 'deleted_' . $user->id_user . '_' . $timestamp . '@void.com';
    
        $user->password = Hash::make(Str::random(60));
    
        $user->biography = 'This user has deleted their account.';
        $user->profile_picture = 'img/default_avatar.png'; 
    
    
        $user->save();

        if ($currentUser->id_user === $user->id_user) {
            Auth::logout();
            return redirect()->route('login')->with('status', 'Your account has been deleted successfully');
        } else {
        return redirect()->route('admin')->with('status', 'User account anonymized successfully.');
        }
    }

}

