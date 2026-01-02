<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoggingController extends Controller
{
    public function index()
    {
        return view('welcome'); 
    }

    public function log(Request $request, $channel, $level)
    {
        // Vérification des canaux et niveaux valides (pour sécurité)
        $validChannels = ['stack', 'single', 'daily', 'slack'];
        $validLevels = [
            'emergency',
            'alert',
            'critical',
            'error',
            'warning',
            'notice',
            'info',
            'debug'
        ];
        if (
            !in_array($channel, $validChannels) || !in_array(
                $level,
                $validLevels
            )
        ) {
            return response()->json(
                ['error' => 'Canal ou niveau invalide.'],
                400
            );
        }
        // Log le message avec contexte (ex. IP de l'utilisateur)
        Log::channel($channel)->{$level}('Message de test au niveau ' . $level .
            ' sur le canal ' . $channel, [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        return response()->json([
            'message' => 'Log enregistré au niveau ' .
                $level . ' sur le canal ' . $channel . '!'
        ]);
    }
}
