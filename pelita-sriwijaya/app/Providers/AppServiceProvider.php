<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::useTailwind();

        if ($this->app->environment('production') || (request() && str_contains(request()->getHost(), 'ngrok'))) {
            URL::forceScheme('https');
        }
    }
}
	