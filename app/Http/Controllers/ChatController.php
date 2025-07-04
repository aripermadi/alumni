<?php
namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Tampilkan daftar chat user login
    public function index()
    {
        $userId = Auth::id();
        $chats = Chat::where('user1_id', $userId)->orWhere('user2_id', $userId)->with(['user1', 'user2'])->get();
        $users = User::where('id', '!=', $userId)->get();
        return view('modules.chat.index', compact('chats', 'users'));
    }

    // Ambil pesan untuk chat tertentu (AJAX)
    public function messages($chatId)
    {
        $chat = Chat::findOrFail($chatId);
        $messages = $chat->messages()->with('sender')->orderBy('created_at')->get();
        return response()->json(['messages' => $messages]);
    }

    // Kirim pesan baru (AJAX)
    public function send(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'message' => 'required|string',
        ]);
        $chat = Chat::findOrFail($request->chat_id);
        $msg = ChatMessage::create([
            'chat_id' => $chat->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);
        $chat->last_message_at = now();
        $chat->save();
        return response()->json(['success' => true, 'message' => $msg]);
    }

    // Mulai chat baru (AJAX)
    public function start(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $user1 = Auth::id();
        $user2 = $request->user_id;
        $chat = Chat::where(function($q) use ($user1, $user2) {
            $q->where('user1_id', $user1)->where('user2_id', $user2);
        })->orWhere(function($q) use ($user1, $user2) {
            $q->where('user1_id', $user2)->where('user2_id', $user1);
        })->first();
        if (!$chat) {
            $chat = Chat::create(['user1_id' => $user1, 'user2_id' => $user2]);
        }
        return response()->json(['chat_id' => $chat->id]);
    }

    // Ambil daftar user lain untuk chat (AJAX, support search)
    public function users(Request $request)
    {
        $userId = Auth::id();
        $query = \App\Models\User::where('id', '!=', $userId);
        if ($request->has('search') && trim($request->search) !== '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }
        $users = $query->select('id', 'name')->orderBy('name')->limit(30)->get();
        return response()->json(['users' => $users]);
    }

    // Cek pesan baru untuk notifikasi (AJAX)
    public function checkNew()
    {
        $userId = Auth::id();
        // Ambil pesan yang belum dibaca oleh user login
        $newMessages = \App\Models\ChatMessage::whereHas('chat', function($q) use ($userId) {
            $q->where('user1_id', $userId)->orWhere('user2_id', $userId);
        })
        ->where('sender_id', '!=', $userId)
        ->whereNull('read_at')
        ->get();
        return response()->json([
            'count' => $newMessages->count(),
            'messages' => $newMessages
        ]);
    }

    // Tandai pesan di chat ini sebagai sudah dibaca oleh user login
    public function read($chatId)
    {
        $userId = Auth::id();
        \App\Models\ChatMessage::where('chat_id', $chatId)
            ->where('sender_id', '!=', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }
} 