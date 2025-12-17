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

        // Agrupar por "Outro Utilizador" para ficarmos apenas com 1 entrada por conversa
        $conversations = $allMessages->map(function($pm) use ($myId) {
            $isMeSender = $pm->id_sender == $myId;
            $otherUser = $isMeSender ? $pm->receiver : $pm->sender;
            
            return [
                'user_id' => $otherUser->id_user,
                'name' => $otherUser->name,
                'username' => $otherUser->username,
                'avatar' => asset($otherUser->getProfileImage()), // ✅ Asset fix
                'last_message' => $pm->message->text,
                'date' => $pm->message->date,
                'timestamp' => strtotime($pm->message->date) // para ordenar
            ];
        })->unique('user_id')->values(); // Unique remove duplicados, values reseta as chaves do array

        return view('pages.messages.index', [
            'conversations' => $conversations
        ]);
    }

    /**
     * API: /messages/{id}
     * Carrega as mensagens de uma conversa específica (Polling)
     */
    public function show($id)
    {
        $myId = Auth::id();
        $friendId = $id;

        // Buscar mensagens entre Mim e o Amigo (nos dois sentidos)
        $messages = PrivateMessage::with(['message', 'sender'])
            ->join('message', 'message.id_message', '=', 'private_message.id_message')
            ->where(function($q) use ($myId, $friendId) {
                // Eu enviei, ele recebeu
                $q->where('id_sender', $myId)
                  ->where('id_receiver', $friendId);
            })
            ->orWhere(function($q) use ($myId, $friendId) {
                // Ele enviou, eu recebi
                $q->where('id_sender', $friendId)
                  ->where('id_receiver', $myId);
            })
            ->orderBy('message.date', 'asc') // Cronológico
            ->get()
            ->map(function($pm) {
                return [
                    'id_message' => $pm->id_message,
                    'text' => $pm->message->text,
                    'date' => $pm->message->date,
                    'id_sender' => $pm->id_sender,
                    'sender_name' => $pm->sender->name,
                    'sender_image' => asset($pm->sender->getProfileImage())
                ];
            });

        return response()->json($messages);
    }

    /**
     * API: POST /messages/{id}
     * Enviar mensagem nova
     */
    public function store(Request $request, $id)
    {
        $request->validate(['text' => 'required|string|max:1000']);
        
        $myId = Auth::id();
        $friendId = $id;

        // Transaction para garantir consistência nas duas tabelas
        $messageData = DB::transaction(function () use ($request, $myId, $friendId) {
            
            // 1. Criar na tabela pai (MESSAGE)
            $msg = Message::create([
                'text' => $request->text,
                'date' => now()
            ]);

            // 2. Criar na tabela filha (PRIVATE_MESSAGE)
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
                'date' => $messageData->date
            ]
        ]);
    }
}