<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoggingController;

Route::get('/', [LoggingController::class, 'index']); 
Route::get('/log/{channel}/{level}', [LoggingController::class, 'log']); 
