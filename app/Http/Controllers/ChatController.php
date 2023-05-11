<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Models\{ChatMessage,ChatRoom};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getRooms()
    {
        return ChatRoom::all();
    }
    public function getMessages($roomId)
    {
        return ChatMessage::where('room_id', $roomId)->with(['user'])->get();
    }
    public function postMessage(Request $request, $roomId)
    {
        $request->validate([
            'message' => 'required',
        ]);
        $newMessage = new ChatMessage();
        $newMessage->user_id = Auth::id();
        $newMessage->room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();
        $user = \App\Models\User::find(Auth::id());

        broadcast(new MessageSentEvent($user, $newMessage))->toOthers();

        return $newMessage;

    }
}
