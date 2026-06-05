<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. If they aren't logged in, kick them back to the login screen
        if (!Auth::check()) {
            return redirect('/');
        }

        // 2. If their role doesn't match the required route parameter, block them
        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized action. You do not have the required role to access this panel.');
        }

        return $next($request);
    }
}
