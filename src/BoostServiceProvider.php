<?php

namespace Boost;

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
    }
}
