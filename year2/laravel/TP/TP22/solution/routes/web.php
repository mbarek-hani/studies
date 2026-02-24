<?php

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get("/cache-users", function () {
    $users = User::all();
    Cache::put("users", $users, 600);
    return "Utilisateurs mis en cache avec succés!";
});

Route::get("/get-users", function () {
    $users = Cache::get("users");
    return $users ?? "Utilisateurs non trouvé dans le cache.";
});

Route::get("clear-cache", function () {
    Cache::forget("users");
    return "cache effacé avec succés!";
});
