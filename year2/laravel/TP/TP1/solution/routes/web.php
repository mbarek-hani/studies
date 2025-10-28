<?php

use Illuminate\Support\Facades\Route;

Route::get("/greeting", fn() => "Hello, world");

Route::post("/produits", fn() => "Création d'un produit");

Route::put("/produits/{id}", fn($id) => "Mise à jour du produit {$id} (PUT)");

Route::delete(
    "/produits/{id}",
    fn($id) => "Suppression du produit {$id} (DELETE)",
);

Route::view("/hello", "hello");

Route::match(
    ["GET", "POST"],
    "/contact",
    fn() => "Page de cantact (GET, POST)",
);

Route::any("/joker", fn() => "Réponse à n'importe quelle méthode HTTP");
