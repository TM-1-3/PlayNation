<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Models\PrivateMessage;
use App\Models\User;

class DirectMessageController extends Controller
{
    public function index()
    {
        $myId = Auth::id();

        // querry to get last message of each conversation
        // select every msg where im sender or reciever
        // order by recency
        $allMessages = PrivateMessage::with(['message', 'sender', 'receiver'])
            ->join('message', 'message.id_message', '=', 'private_message.id_message')
            ->where(function($q) use ($myId) {
                $q->where('id_sender', $myId)
                  ->orWhere('id_receiver', $myId);
            })
            ->orderBy('message.date', 'desc')
            ->get();

        // group other user so we only get 1 user by convo
        $conversations = $allMessages->map(function($pm) use ($myId) {
            $isMeSender = $pm->id_sender == $myId;
            $otherUser = $isMeSender ? $pm->receiver : $pm->sender;
            
            return [
                'user_id' => $otherUser->id_user,
                'name' => $otherUser->name,
                'username' => $otherUser->username,
                'avatar' => asset($otherUser->getProfileImage()),
                'last_message' => $pm->message->text,
                'date' => $pm->message->date,
                'timestamp' => strtotime($pm->message->date) // to sorganize
            ];
        })->unique('user_id')->values(); // filter duplicates

        return view('pages.messages.index', [
            'conversations' => $conversations
        ]);
    }

    // load messages from a specific convo
    public function show($id)
    {
        $myId = Auth::id();
        $friendId = $id;

        // get msgs form me n friend (both ways)
        $messages = PrivateMessage::with(['message', 'sender'])
            ->join('message', 'message.id_message', '=', 'private_message.id_message')
            ->where(function($q) use ($myId, $friendId) {
                // i send / they recieve
                $q->where('id_sender', $myId)
                  ->where('id_receiver', $friendId);
            })
            ->orWhere(function($q) use ($myId, $friendId) {
                // they send / I recieve
                $q->where('id_sender', $friendId)
                  ->where('id_receiver', $myId);
            })
            ->orderBy('message.date', 'asc') // cronological
            ->get()
            ->map(function($pm) {
                return [
                    'id_message' => $pm->id_message,
                    'text' => $pm->message->text,

                    'shared_post_data' => $pm->message->shared_post_data, // for shared posts

                    'date' => $pm->message->date,
                    'id_sender' => $pm->id_sender,
                    'sender_name' => $pm->sender->name,
                    'sender_image' => asset($pm->sender->getProfileImage())
                ];
            });

        return response()->json($messages);
    }

    public function store(Request $request, $id)
    {
        $request->validate(['text' => 'required|string|max:1000']);
        
        $myId = Auth::id();
        $friendId = $id;

        // transaction to gurrenty concistency between tables
        $messageData = DB::transaction(function () use ($request, $myId, $friendId) {
            
            // create on parent table
            $msg = Message::create([
                'text' => $request->text,
                'date' => now()
            ]);

            // create on child table(private messages)
            PrivateMessage::create([
                'id_message' => $msg->id_message,
                'id_sender'  => $myId,
                'id_receiver' => $friendId
            ]);

            return $msg;
        });

        return response()->json([
            'status' => 'success',
            'message' => [
                'id_message' => $messageData->id_message,
                'text' => $messageData->text,
                'date' => $messageData->date,

                'shared_post_data' => $messageData->shared_post_data
            ]
        ]);
    }

    public function getFriendsToChat(Request $request)
    {
        $user = Auth::user();
        
        $friends = $user->friends->map(function($friend) {
            return [
                'id' => $friend->id_user,
                'name' => $friend->name,
                'username' => $friend->username,
                'image' => asset($friend->getProfileImage())
            ];
        });

        return response()->json($friends);
    }
}