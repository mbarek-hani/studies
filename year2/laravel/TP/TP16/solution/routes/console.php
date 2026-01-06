<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

Artisan::command("inspire", function () {
    $this->comment(Inspiring::quote());
})->purpose("Display an inspiring quote");

Artisan::command("users:count", function () {
    $count = User::count();
    $this->info("Nombre total d'utilisateurs : {$count}");
})->purpose('Affiche le nombre total d\'utilisateurs');
