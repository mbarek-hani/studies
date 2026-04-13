<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get("/", [ChatController::class, "index"]);
Route::post("/send", [ChatController::class, "send"]);
