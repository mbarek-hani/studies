<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Message;
use App\Events\PrivateMessageSent;

class ChatController extends Controller
{
    public function index(string $id): View
    {
        $receiver = User::findOrFail($id);
        $messages = Message::where(function ($query) use ($id) {
            $query->where("sender_id", auth()->id())->where("receiver_id", $id);
        })
            ->orWhere(function ($query) use ($id) {
                $query
                    ->where("sender_id", $id)
                    ->where("receiver_id", auth()->id());
            })
            ->orderBy("created_at", "asc")
            ->get();
        return view("chat", [
            "messages" => $messages,
            "receiver" => $receiver,
        ]);
    }
    public function send(Request $request, string $id): JsonResponse
    {
        $message = Message::create([
            "content" => $request->content,
            "sender_id" => auth()->id(),
            "receiver_id" => (int) $id,
        ]);
        broadcast(new PrivateMessageSent($message));
        return response()->json(["status" => "ok"]);
    }
}
