<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::prefix(config('app.admin_path'))
                ->middleware(['web', 'auth', 'isadmin'])
                ->group(base_path('routes/admin.php'));

            Route::middleware(['web', 'mt'])
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        // rate limiter forgot password
        RateLimiter::for('forgot-password', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        RateLimiter::for('license', function (Request $request) {
            if (RateLimiter::tooManyAttempts('license:' . $request->ip(), 6)) {
                $seconds = RateLimiter::availableIn('license:' . $request->ip());
                return redirect()->route('front.license.index')->with('error', 'You may try again in ' . $seconds . ' seconds.');
            }
            RateLimiter::hit('license:' . $request->ip());
        });

        RateLimiter::for('update_profile_settings', function (Request $request) {
            if (RateLimiter::tooManyAttempts('update_profile_settings:' . $request->ip(), 3)) {
                $seconds = RateLimiter::availableIn('update_profile_settings:' . $request->ip());
                return redirect()->back()->with('error', 'You may try again in ' . $seconds . ' seconds.');
            }
            RateLimiter::hit('update_profile_settings:' . $request->ip());
        });
    }
}
