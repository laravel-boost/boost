<?php

use Boost\Events\BoostServiceProviderRegistered;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\get;

beforeEach(fn () => Event::fake());

// Test bootstraping
it('bootstrap on each requests', function () {
    Route::get('/', fn () => '');
    get('/')->assertStatus(200);

    Event::assertDispatched(BoostServiceProviderRegistered::class);
})->group('bootstraping');

it('prevnt bootstrap on excluded path', function () {
    $except = time();

    Route::get($except, fn () => '');
    Config::set('boost.excepts', compact('except'));
    get($except)->assertStatus(200);

    Event::assertNotDispatched(BoostServiceProviderRegistered::class);
})->group('bootstraping');

it('bootstrap on app url', function () {
    Config::set('boost.domain', config('app.url'));

    Route::get('/', fn () => '');
    get('/')->assertStatus(200);

    Event::assertDispatched(BoostServiceProviderRegistered::class);
})->group('bootstraping');

it('prevent bootstrap on diffrent domain', function () {
    Config::set('boost.domain', time().'.test');

    Route::get('/', fn () => '');
    get('/')->assertStatus(200);

    Event::assertNotDispatched(BoostServiceProviderRegistered::class);
})->group('bootstraping');
