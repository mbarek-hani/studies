<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::view("/", "index")->name("index");
Route::view("/about", "about")->name("about");
Route::view("/contact", "contact")->name("contact");
Route::view("/books", "books")->name("books");
Route::view("/books/details", "books.details")->name("books.details");

Route::resource("book", BookController::class);
