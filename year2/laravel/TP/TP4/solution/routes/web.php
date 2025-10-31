<?php

use Illuminate\Support\Facades\Route;

Route::get("/salut", fn() => "bonjour depuis laravel!");

Route::get("/utilisateur/{id}", fn(string $id) => "Utilisateur: {$id}")->where(
    "id",
    "[0-9]+",
);

Route::get("/nom/{nom?}", fn(?string $nom = "mbarek") => "name: {$nom}");

Route::get("/profil", fn() => "Page de profil")->name("profil");

Route::prefix("admin")->group(function () {
    Route::get("/dashboard", fn() => "admin dashboard page");
    Route::get("/help", fn() => "admin help page");
});

Route::redirect("/ancien", "/nouveau");

Route::view("/bienvenue", "bienvenue", ["nom" => "mbarek hani"]);
