<?php

namespace App\Providers;

use App\Models\GroupPolicyDocument;
use App\Models\GroupPolicySetting;
use App\Models\Layout;
use App\Models\LayoutModule;
use App\Models\User;
use App\Models\UserDocument;
use App\Models\UserGroup;
use App\Models\UserGroupDocument;
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
     */
    public function boot(): void
    {
        Route::bind('user', function ($value) {
            return User::where('uuid', User::decodeHash($value))->firstOrFail();
        });

        Route::bind('userGroup', function ($value) {
            return UserGroup::where('uuid', UserGroup::decodeHash($value))->firstOrFail();
        });

        Route::bind('groupPolicySetting', function ($value) {
            return GroupPolicySetting::where('uuid', GroupPolicySetting::decodeHash($value))->firstOrFail();
        });

        Route::bind('userGroupDocument', function ($value) {
            return UserGroupDocument::where('uuid', UserGroupDocument::decodeHash($value))->firstOrFail();
        });

        Route::bind('userDocument', function ($value) {
            return UserDocument::where('uuid', UserDocument::decodeHash($value))->firstOrFail();
        });

        Route::bind('groupPolicyDocument', function ($value) {
            return GroupPolicyDocument::where('uuid', GroupPolicyDocument::decodeHash($value))->firstOrFail();
        });

        Route::bind('layout', function ($value) {
            return Layout::where('uuid', Layout::decodeHash($value))->firstOrFail();
        });

        Route::bind('layoutModule', function ($value) {
            return LayoutModule::where('uuid', LayoutModule::decodeHash($value))->firstOrFail();
        });

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            if (! app()->environment('production')) {
                Route::middleware('api')
                    ->group(base_path('routes/dev.php'));
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
