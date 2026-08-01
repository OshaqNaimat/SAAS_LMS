<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!Auth::check() || !$user->isSuperAdmin()) {
    abort(403, 'Unauthorized. Super admin access only.');
}

        return $next($request);
    }
}
