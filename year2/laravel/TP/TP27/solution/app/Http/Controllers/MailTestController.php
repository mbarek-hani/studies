<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class MailTestController extends Controller
{
    public function sendWelcomeMailTo(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "name" => "required|string|max:255",
        ]);
        Mail::to($request->email)->send(new WelcomeMail($request->name));
        return back()->with("success", "Email envoyé à {$request->email}");
    }
}
