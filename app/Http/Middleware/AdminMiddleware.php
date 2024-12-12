<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        // When User stay Login
        if ($user) {
            if ($user->role == 'admin' || $user->role == 'superadmin') {
                // prevent access to login & register routes
                if ($request->route()->getName() == 'login' || $request->route()->getName() == 'register') {
                    return back();
                }
                // user call all requests excepts login and register
                return $next($request);
            }

            return back();
        } else {
            return $next($request);
        }
    }
}
