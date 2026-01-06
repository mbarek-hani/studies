<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "users:list";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Affiche la liste de tous les utilisateurs";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->warn("Aucun utilisateur trouvé.");
            return;
        }
        $this->info("Liste des utilisateurs :");
        foreach ($users as $user) {
            $this->line(
                "ID: {$user->id} | Nom: {$user->name} | Email: {$user->email}",
            );
        }
    }
}
