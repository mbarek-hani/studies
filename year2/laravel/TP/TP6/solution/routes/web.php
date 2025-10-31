<?php

use Illuminate\Support\Facades\Route;

Route::get("/admin/dashboard", fn() => view("dashboard"));
