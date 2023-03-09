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
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware([
                'web',
                'ssl'
            ])->group(base_path('routes/web.php'));

            Route::prefix('api/user')
                ->middleware([
                    'api',
                    'ssl'
                ])->group(base_path('routes/user/api.php'));

            Route::prefix('user')
                ->middleware([
                    'web',
                    'ssl'
                ])->group(base_path('routes/user/web.php'));

            Route::prefix('api/employee')
                ->middleware([
                    'api',
                    'ssl'
                ])->group(base_path('routes/employee/api.php'));

            Route::prefix('employee')
                ->middleware([
                    'web',
                    'ssl'
                ])->group(base_path('routes/employee/web.php'));

            Route::prefix('api/market')
                ->middleware([
                    'api',
                    'ssl'
                ])->group(base_path('routes/market/api.php'));

            Route::prefix('market')
                ->middleware([
                    'web',
                    'ssl'
                ])->group(base_path('routes/market/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
