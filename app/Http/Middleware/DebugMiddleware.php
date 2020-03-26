<?php

namespace App\Http\Middleware;

use Closure;

class DebugMiddleware
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
        // Sleep 2 seconds on each request while app debug mode is on
        if (config('app.debug'))
        {
            sleep(2);
        }

        return $next($request);
    }
}
