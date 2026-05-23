<?php

// ---------------------------------------------------------------------------
// In Laravel 11, middleware aliases live in bootstrap/app.php.
// Merge the withMiddleware() call below into your existing bootstrap/app.php.
// ---------------------------------------------------------------------------

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Register the 'super_admin' route middleware alias
        $middleware->alias([
            'super_admin' => \App\Http\Middleware\RequireSuperAdmin::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
