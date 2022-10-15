<?php

namespace Boost;

use Boost\Events\BoostServiceProviderRegistered;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class Boost
{
    /**
     * Get the current Boost version.
     *
     * @return string
     */
    public static function version()
    {
        return Cache::driver('array')->rememberForever('boost.version', function () {
            $manifest = json_decode(File::get(__DIR__.'/../composer.json'), true);

            $version = $manifest['version'] ?? '1.x';

            return $version;
        });
    }

    /**
     * Get the app name utilized by boost.
     *
     * @return string
     */
    public static function name()
    {
        return config('boost.name', 'Laravel Boost');
    }

    /**
     * Get the application host name.
     *
     * @return string
     */
    public static function host()
    {
        return config('boost.host');
    }

    /**
     * Register an event listener for the Boost "booted" event.
     *
     * @param  (\Closure(\Boost\Events\BoostServiceProviderRegistered):void)|string  $callback
     * @return void
     */
    public static function booted($callback)
    {
        Event::listen(BoostServiceProviderRegistered::class, $callback);
    }
}
