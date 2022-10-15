<?php

namespace Boost;

use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Illuminate\Support\ServiceProvider;

class BoostServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/boost.php', 'boost');
        $this->app->make(HttpKernel::class)
            ->pushMiddleware(Http\Middleware\ServeBoost::class);
    }
}
