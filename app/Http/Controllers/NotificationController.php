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
            ->with(['emitter', 'friendRequestNotification', 'joinGroupRequestNotification','friendRequestResultNotification']) 
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
            if ($notification->friendRequestResultNotification) {
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

        $requester = User::findOrFail($notification->id_emitter);

        $user = Auth::user();

        $user->friends()->attach($notification->id_emitter);
            
        $emitter = User::find($notification->id_emitter);
        $emitter->friends()->attach($user->id_user);


        DB::table('user_friend_request')
            ->where('id_user', $user->id_user)
            ->where('id_requester', $notification->id_emitter)
            ->delete();

        $exists = DB::table('notification')
            ->where('id_receiver', $requester->id_user)
            ->where('id_emitter', $user->id_user)
            ->where('text', 'LIKE', '%is now your friend%')
            ->exists();

        if (!$exists){
            $resultNotificationId = DB::table('notification')->insertGetId([
                'id_receiver' => $requester->id_user,
                'id_emitter' => $user->id_user,
                'text' => $user->name . ' is now your friend.',
                'date' => now()
            ], 'id_notification');

            DB::table('friend_request_result_notification')->insert([
                'id_notification' => $resultNotificationId,
            ]);
        }
        
        return back()->with('status', 'Friend request accepted!');
    }

    public function denyFriendRequest($id) {
       
        $notification = Notification::findOrFail($id);

        $notification->friendRequestNotification()->update(['accepted' => false]);

        $requester = User::findOrFail($notification->id_emitter);

        $currentUser = Auth::user();

        DB::table('user_friend_request')
            ->where('id_user', Auth::id())
            ->where('id_requester', $notification->id_emitter)
            ->delete();

        $exists = DB::table('notification')
            ->where('id_receiver', $requester->id_user)
            ->where('id_emitter', $currentUser->id_user)
            ->where('text', 'LIKE', '%has denied your friend request%')
            ->exists();
        
        if (!$exists){
            $resultNotificationId = DB::table('notification')->insertGetId([
                'id_receiver' => $requester->id_user,
                'id_emitter' => $currentUser->id_user,
                'text' => $currentUser->name . ' has denied your friend request.',
                    'date' => now()
            ], 'id_notification');
    
            DB::table('friend_request_result_notification')->insert([
                'id_notification' => $resultNotificationId,
            ]);
        }
     

        return back()->with('status', 'Friend request denied.');
    }

    public function markNotificationAsRead($id) {

        $notification = Notification::findOrFail($id);

        $notification->delete();

        return back();
    }
}