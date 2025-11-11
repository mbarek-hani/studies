<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LivreApiController;

Route::post('livres', [LivreApiController::class, 'store']);
Route::put('livres/{livre}', [LivreApiController::class, 'update']);
Route::delete('livres/{livre}', [LivreApiController::class, 'destroy']);
Route::get('livres/{livre}', [LivreApiController::class, 'show']);
Route::get('livres', [LivreApiController::class, 'index']);
