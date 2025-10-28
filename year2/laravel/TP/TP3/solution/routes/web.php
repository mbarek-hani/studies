<?php

use Illuminate\Support\Facades\Route;

Route::get(
    "/posts/{post}/comments/{comment}",
    fn($postId, $commentId) => "Article: {$postId}, commentaire: {$commentId}.",
);

Route::get("/user/{name?}", fn($name = null) => $name ?? "Utilisateur Inconnu");

Route::get("/user/{id}/profile", fn($id) => "Profil utilisateur {$id}")->name(
    "profile",
);

Route::get("/test-generateur", function () {
    $url1 = route("profile", ["id" => 12]);

    $url2 = route("profile", ["id" => 654, "photos" => "yes"]);

    // return to_route("profile", [
    //     "id" => "12dfs657fs34fs3skeils",
    //     "verified" => "yes",
    // ]);
    return "Url1: {$url1}, Url2: {$url2}";
});
