<?php

namespace App\Http\Middleware\User;

use App\Traits\Response;
use Closure;
use Illuminate\Http\Request;

class CheckSuspend
{
    use Response;

    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->suspend == 1) {
            return $this->error('User is suspended', 403);
        }
        return $next($request);
    }
}
