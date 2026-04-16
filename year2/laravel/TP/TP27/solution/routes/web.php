<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailTestController;

Route::get("/", function () {
    return view("welcome");
});
Route::post("/send-mail", [MailTestController::class, "sendWelcomeMailTo"]);
Route::get("/subscribe", function () {
    return view("subscribe");
});
