<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $message = \sprintf("%s %s %s", $request->method(), $request->path(), $response->getStatusCode());
        Log::channel("daily")->info($message, ["ip"=> $request->ip(), "user-agent" => $request->userAgent()]);
        return $response;
    }
}
