<?php

namespace Boost\Http\Middleware;

use Boost\Events\BoostServiceProviderRegistered;
use Boost\Util;

class ServeBoost
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request):mixed  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        if (Util::isBoostRequest($request)) {
            BoostServiceProviderRegistered::dispatch();
        }

        return $next($request);
    }
}
