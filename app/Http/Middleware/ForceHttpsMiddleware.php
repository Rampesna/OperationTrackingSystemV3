<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class ForceHttpsMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!$request->secure() && env('APP_ENV') === 'production') {
            URL::forceScheme('https');
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
