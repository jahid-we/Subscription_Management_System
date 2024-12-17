<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureRateLimiting();
    }

    protected function configureRateLimiting(): void
    {
    RateLimiter::for('custom', function (Request $request) {
    return Limit::perMinute(5)->by($request->ip())->response(function () {
    return response()->json([
    'message' => 'Too many requests. Please try
    again later.'
    ], 429);
    });
    });
    }
}
