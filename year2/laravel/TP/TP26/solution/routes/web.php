<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("welcome");
});

Route::get(
    "/users",
    fn() => view("users", [
        "users" => User::where("id", "<>", auth()->id())->get(),
    ]),
)
    ->middleware(["auth", "verified"])
    ->name("users");

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit",
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update",
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy",
    );
    Route::get("/chat/{id}", [ChatController::class, "index"])->name(
        "chat.index",
    );
    Route::post("/chat/{id}/send", [ChatController::class, "send"])->name(
        "chat.store",
    );
});

require __DIR__ . "/auth.php";
