<?php

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/form', function () {
    return view('form');
});

Route::post('/submit', function (Request $request) {
    return 'Formulaire soumis avec succès : ' . $request->input('name');
})->withoutMiddleware([VerifyCsrfToken::class]);
