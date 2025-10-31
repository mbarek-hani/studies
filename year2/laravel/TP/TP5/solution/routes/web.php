<?php

use Illuminate\Support\Facades\Route;

Route::get("/bonjour", fn() => view("bonjour"));

Route::get("/salut/{nom}", fn(string $nom) => view("bonjour", ["nom" => $nom]));

Route::get("/users", function () {
    $users = [
        ["nom" => "Ali", "age" => 25],
        ["nom" => "Sara", "age" => 30],
        ["nom" => "Mohamed", "age" => 22],
    ];
    return view("utilisateurs", ["users" => $users]);
});
Route::get("/form", fn() => view("form"));
Route::post("/submit", fn() => redirect("/form")->withInput());
