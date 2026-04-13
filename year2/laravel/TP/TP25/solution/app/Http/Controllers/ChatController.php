<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->take(30)->get()->reverse();
        return view("chat", compact("messages"));
    }

    public function send(Request $request)
    {
        $message = Message::create([
            "content" => $request->input("content"),
        ]);
        // Diffusez le message à tous les clients connectés
        Log::info("broadcasting message: " . $message->content);
        event(new MessageSent($message->content));
        return response()->json(["status" => "Message sent!"]);
    }
}
