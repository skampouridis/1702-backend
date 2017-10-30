<?php

namespace App\Http\Middleware;

use App\RequestLog;
use Closure;
use Log;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Append the incoming request to info log file
        Log::info('Request: ' . (string) $request);

        // Also store the incoming request to the database
        RequestLog::create([
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'full_request' => (string) $request
        ]);

        return $next($request);
    }
}
