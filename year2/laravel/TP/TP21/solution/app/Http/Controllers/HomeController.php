<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $events = Cache::get("home.upcoming_events");

        if (!$events) {
            $events = Event::where("start_date", ">=", now())
                ->orderBy("participants_count", "desc")
                ->take(8)
                ->get();

            Cache::put("home.upcoming_events", $events, 5 * 60);
        }

        return view("welcome", compact("events"));
    }
}
