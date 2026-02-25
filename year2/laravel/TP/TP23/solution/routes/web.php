<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::resource("films", FilmController::class);
Route::controller(FilmController::class)->group(function () {
    Route::delete("films/force/{film}", "forceDestroy")->name(
        "films.force.destroy",
    );
    Route::put("films/restore/{film}", "restore")->name("films.restore");
});
