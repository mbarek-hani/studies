<?php

namespace App\Listeners;

use App\Events\AccueilEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class AccueilListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AccueilEvent $event): void
    {
        DB::table("visits")->insert([
            "ip" => request()->ip(),
            "created_at" => now(),
        ]);
    }
}
