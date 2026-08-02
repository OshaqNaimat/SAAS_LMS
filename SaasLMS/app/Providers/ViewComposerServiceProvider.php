<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('components.admin-sidebar', function ($view) {
            $organization = Auth::check() ? Auth::user()->organization : null;
            $view->with('organization', $organization);
        });
    }
}
