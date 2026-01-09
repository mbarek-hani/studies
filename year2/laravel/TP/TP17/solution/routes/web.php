<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get("/films/seed", [FilmController::class, "seed"]);
Route::get("/films/select-all", [FilmController::class, "selectAll"]);
Route::get("/films/first", [FilmController::class, "first"]);
Route::get("/films/value", [FilmController::class, "value"]);
Route::get("/films/find", [FilmController::class, "find"]);
Route::get("/films/pluck", [FilmController::class, "pluck"]);
Route::get("/films/pluck-key", [FilmController::class, "pluckKey"]);
Route::get("/films/chunk", [FilmController::class, "chunk"]);
Route::get("/films/chunk-stop", [FilmController::class, "chunkStop"]);
Route::get("/films/lazy", [FilmController::class, "lazy"]);
Route::get("/films/lazy-by-id", [FilmController::class, "lazyById"]);
Route::get("/films/aggregates", [FilmController::class, "aggregates"]);
Route::get("/films/exists", [FilmController::class, "exists"]);
Route::get("/films/select-columns", [FilmController::class, "selectColumns"]);
Route::get("/films/raw", [FilmController::class, "raw"]);
Route::get("/films/join", [FilmController::class, "join"]);
Route::get("/films/left-right-join", [FilmController::class, "leftRightJoin"]);
Route::get("/films/union", [FilmController::class, "union"]);
Route::get("/films/where", [FilmController::class, "where"]);
Route::get("/films/or-where", [FilmController::class, "orWhere"]);
Route::get("/films/where-not", [FilmController::class, "whereNot"]);
Route::get("/films/additional-wheres", [
    FilmController::class,
    "additionalWheres",
]);
Route::get("/films/order-by", [FilmController::class, "orderBy"]);
Route::get("/films/latest-oldest", [FilmController::class, "latestOldest"]);
Route::get("/films/random-reorder", [FilmController::class, "randomReorder"]);
Route::get("/films/group-having", [FilmController::class, "groupHaving"]);
Route::get("/films/skip-take", [FilmController::class, "skipTake"]);
Route::get("/films/insert", [FilmController::class, "insert"]);
Route::get("/films/insert-using", [FilmController::class, "insertUsing"]);
Route::get("/films/upsert", [FilmController::class, "upsert"]);
Route::get("/films/update", [FilmController::class, "update"]);
Route::get("/films/update-or-insert", [
    FilmController::class,
    "updateOrInsert",
]);
Route::get("/films/increment-decrement", [
    FilmController::class,
    "incrementDecrement",
]);
Route::get("/films/delete", [FilmController::class, "delete"]);
Route::get("/films/truncate", [FilmController::class, "truncate"]);
