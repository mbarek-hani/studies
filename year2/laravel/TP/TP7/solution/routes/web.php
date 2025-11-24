<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get("/", fn() => view("welcome"))->middleware("logger");

Route::get("/form", fn() => view("csrf-form"));
Route::post(
    "submit-data",
    fn(Request $request) => "Données soumises (aucune validation CSRF ici) : " .
        $request->input("data"),
);
