<?php

namespace Boost;

use Illuminate\Support\Str;

class Util
{
    /**
     * Determine if the given request is intended for Boost.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function isBoostRequest($request): bool
    {
        if (static::isIgnoredRequest($request)) {
            return false;
        }

        if (is_null($domain = config('boost.domain')) || $domain === config('app.url')) {
            return true;
        }

        if (! Str::startsWith($domain, ['http://', 'https://', '://'])) {
            $domain = $request->getScheme().'://'.$domain;
        }

        if (! in_array($port = $request->getPort(), (array) config('boost.ports')) && ! Str::endsWith($domain, ":{$port}")) {
            $domain = $domain.':'.$port;
        }

        $uri = parse_url($domain);

        return isset($uri['port'])
            ? rtrim($request->getHttpHost(), '/') === $uri['host'].':'.$uri['port']
            : rtrim($request->getHttpHost(), '/') === $uri['host'];
    }

    /**
     * Determine if the given request has to ignore by Boost.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function isIgnoredRequest($request): bool
    {
        return collect(config('boost.excepts', []))
            ->filter(fn ($path) => $request->is($path) || $request->is(trim($path.'/*', '/')))
            ->isNotEmpty();
    }
}
