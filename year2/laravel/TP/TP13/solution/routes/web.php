<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

Route::get('/session/set', [SessionController::class, 'setData']);
Route::get('/session/get', [SessionController::class, 'getData']);
Route::get('/session/all', [SessionController::class, 'getAll']);
Route::get('/session/has', [SessionController::class, 'checkHas']);
Route::get('/session/exists', [SessionController::class, 'checkExists']);
Route::get('/session/missing', [SessionController::class, 'checkMissing']);
Route::get('/session/push', [SessionController::class, 'pushToArray']);
Route::get('/session/pull', [SessionController::class, 'pullData']);
Route::get('/session/increment', [SessionController::class, 'incrementCount']);
Route::get('/session/decrement', [SessionController::class, 'decrementCount']);
Route::get('/session/flash', [SessionController::class, 'flashData']);
Route::get('/session/reflash', [SessionController::class, 'reflashData']);
Route::get('/session/keep', [SessionController::class, 'keepData']);
Route::get('/session/forget', [SessionController::class, 'forgetData']);
Route::get('/session/flush', [SessionController::class, 'flushData']);
Route::get('/session/regenerate', [SessionController::class, 'regenerateId']);
Route::get('/session/invalidate', [SessionController::class,'invalidateSession']);