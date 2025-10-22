<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome', [
    'name' => 'mbarek',
]);

Route::get('/new-uri', action: function () {
    return "redirected from /old-uri";
});

Route::get('/new-user', function () {
    return "redirected from /old-user";
});

Route::redirect('/old-uri', '/new-uri');

Route::permanentRedirect('/old-user', '/new-user');

Route::get('/user-request', function (Request $request) {
    $param = $request->input('q');
    return "Requete reçu. Parametre q: $param";
});
