<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class ForceHttpsMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!$request->secure()) {
            URL::forceScheme('https');
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
