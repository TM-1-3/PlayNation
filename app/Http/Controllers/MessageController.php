<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\GroupMessage;
use App\Models\Group;
use App\Models\Notification;
use App\Models\GroupMessageNotification;

class MessageController extends Controller
{
    // send group message
    public function sendGroupMessage(Request $request, $id)
    {
        // Check if user is banned
        if (Auth::user()->isBanned()) {
            return response()->json(['error' => 'You cannot send messages because your account has been banned.'], 403);
        }

        // 1input validation
        $request->validate(['text' => 'required|string|max:1000']);
        
        $group = Group::findOrFail($id);
        $user = Auth::user();

        // create message in parent table
            $msgParent = Message::create([
            'text' => $request->text,
            'date' => now(),
            'image' => null 
        ]);

        // create group message entry in child table
        // connects msg id with group and sender
        $groupMsg = GroupMessage::create([
            'id_message' => $msgParent->id_message,
            'id_group'   => $group->id_group,
            'id_sender'  => $user->id_user
        ]);

        // Create notifications for all group members except the sender
        try {
            $members = $group->members()
                ->wherePivot('id_member', '!=', $user->id_user)
                ->get();
            
            foreach ($members as $member) {
                // Create base notification
                $notification = Notification::create([
                    'text' => $user->name . ' sent a message in ' . $group->name,
                    'date' => now(),
                    'id_receiver' => $member->id_user,
                    'id_emitter' => $user->id_user
                ]);

                // Create group message notification
                GroupMessageNotification::create([
                    'id_notification' => $notification->id_notification,
                    'id_message' => $msgParent->id_message
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Group message notification error: ' . $e->getMessage());
        }

        // resspond to ajax

        return response()->json([
            'status' => 'success',
            'message' => [
                'id_message' => $msgParent->id_message,
                'text'       => $msgParent->text, 
                'date'       => $msgParent->date,
                'shared_post_data' => $msgParent->shared_post_data,
                'id_sender'  => $user->id_user,
                'sender'     => [
                    'name' => $user->name,
                    'username' => $user->username,
                    'profile_image' => $user->getProfileImage()
                ]
            ]
        ]);
    }

    // read group messages
    public function getGroupMessages(Request $request, $id)
    {
        // sees if JS sent the last message id it has
        $lastId = $request->query('after_id', 0); 

        $messages = GroupMessage::where('id_group', $id)
            ->where('id_message', '>', $lastId) 
            ->with(['message', 'sender']) 
            ->orderBy('id_message', 'ASC')
            ->take(50) // limit to 50 messages at a time---------------------------------------------------------
            ->get()
            ->map(function ($item) {
                return [
                    'id_message' => $item->id_message,
                    'id_sender'  => $item->id_sender,
                    'text'       => $item->message->text,
                    'date'       => $item->message->date,
                    'shared_post_data' => $item->message->shared_post_data,
                    'sender'     => [
                        'name' => $item->sender->name,
                        'profile_image' => $item->sender->getProfileImage() // <--- ADICIONA ISTO
                    ]
                ];
            });

        return response()->json($messages);
    }
}