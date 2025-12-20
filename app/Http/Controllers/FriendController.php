<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{

    public function showFriendsPage($id) {

        $user = User::findOrFail($id);

        $friends = $user->friends; 

        return view('pages.friends', ['user' => $user, 'friends' => $friends]);
    }

    public function sendFriendRequest($id) {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return back()->withErrors(['msg' => 'You cannot send friend requests because your account has been banned.']);
        }

        $targetUser = User::findOrFail($id);
        $authId = Auth::id();

        if ($authId == $targetUser->id_user) {
            return back()->withErrors(['msg' => 'You cannot befriend yourself.']);
        }

        $existsRequest = DB::table('user_friend_request')
                ->where('id_requester', $authId)
                ->where('id_user', $targetUser->id_user)
                ->exists();

        if (!$existsRequest) {
            DB::table('user_friend_request')->insert([
                'id_user' => $targetUser->id_user,     
                'id_requester' => $authId               
            ]);
            
            $friendNotificationId = DB::table('notification')->insertGetId([
                'id_receiver' => $targetUser->id_user,
                'id_emitter' => $authId,
                'text' => Auth::user()->name . ' sent you a friend request.',
                'date' => now()
            ], 'id_notification');

            DB::table('friend_request_notification')->insert([
                'id_notification' => $friendNotificationId,
                'accepted' => null
            ]);
        }

        return back()->with('status', 'Friend request sent!');
    }

    public function removeFriend($id)
    {
        $currentUser = Auth::user();

        $friendToRemove = User::findOrFail($id);

        $currentUser->friends()->detach($friendToRemove->id_user);

         $friendToRemove->friends()->detach($currentUser->id_user);

        return back()->with('status', 'Friend removed successfully.');
    }
}