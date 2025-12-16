<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get("/", function () {
    return view("accueil");
});

Route::get("/test-chaine", function () {
    return "Hello World";
});

Route::get("/test-tableau", function () {
    return [1, 2, 3];
});

Route::get("/test-response", function () {
    return response("Hello World", 200)->header("Content-Type", "text/plain");
});

Route::get("/test-user/{user}", function (User $user) {
    return $user;
});

Route::get("/test-headers", function () {
    return response("Contenu")
        ->header("Content-Type", "text/plain")
        ->header("X-Header-One", "Valeur 1")
        ->header("X-Header-Two", "Valeur 2");
});

Route::get("/test-cookie", function () {
    return response("Hello World")->cookie("nom", "valeur", 60); // Valide 60 minutes
});

Route::get("/test-expire-cookie", function () {
    return response("Hello World")->withoutCookie("nom");
});

Route::get("/test-redirect", function () {
    return redirect("home/dashboard");
});

Route::get("/test-flash", function () {
    return redirect("/")->with("status", "Profil mis à jour !");
});

Route::get("/test-view", function () {
    return response()
        ->view("hello", ["data" => "valeur"], 200)
        ->header("Content-Type", "text/html");
});

Route::get("/test-json", function () {
    return response()->json(["name" => "Abigail", "state" => "CA"]);
});

Route::get("/test-download", function () {
    $path = public_path("fichier.txt"); // Créez un fichier test
    return response()->download($path, "nouveau-nom.txt");
});
