<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $userPermission)
    {
        if (auth()->guard('user_web')->user()->userPermissions()->pluck('id')->contains($userPermission)) {
            return $next($request);
        }

        return abort(403);
    }
}
