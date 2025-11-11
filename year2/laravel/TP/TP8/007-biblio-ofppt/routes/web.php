<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\LivreController;

Route::get('/', [AccueilController::class, 'index'])->name('accueil');
Route::resource('livres', LivreController::class);
