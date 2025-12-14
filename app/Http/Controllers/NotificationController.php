<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller {

    public function showNotificationsPage() {
        $userId = Auth::id();

        $notifications = Notification::where('id_receiver', $userId)
            ->with(['emitter', 'friendRequestNotification', 'joinGroupRequestNotification']) 
            ->orderByDesc('date')
            ->get();
        
        $pendingNotifications = $notifications->filter(function ($notification) {
            // from group request and not accepted yet (null), keep
            if ($notification->joinGroupRequestNotification && $notification->joinGroupRequestNotification->accepted === null) {
                return true;
            }
            // from friend request and not accepted yet (null), keep
            if ($notification->friendRequestNotification && $notification->friendRequestNotification->accepted === null) {
                return true;
            }
           
            return false; 
        });

        return view('pages.notifications', [
            'notifications' => $pendingNotifications
        ]);
    }

    public function acceptFriendRequest($id) {
 
     
        $notification = Notification::findOrFail($id);
            
        $notification->friendRequestNotification()->update(['accepted' => true]);

        $user = Auth::user();

        $user->friends()->attach($notification->id_emitter);
            
        $emitter = User::find($notification->id_emitter);
        $emitter->friends()->attach($user->id_user);


        DB::table('user_friend_request')
            ->where('id_user', $user->id_user)
            ->where('id_requester', $notification->id_emitter)
            ->delete();
        
        return back()->with('status', 'Friend request accepted!');
    }

    public function denyFriendRequest($id) {
       
        $notification = Notification::findOrFail($id);

        $notification->friendRequestNotification()->update(['accepted' => false]);

        DB::table('user_friend_request')
            ->where('id_user', Auth::id())
            ->where('id_requester', $notification->id_emitter)
            ->delete();
     

        return back()->with('status', 'Friend request denied.');
    }
}