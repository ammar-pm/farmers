<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Laravel\Spark\Http\Middleware\CreateFreshApiToken::class,
            \App\Http\Middleware\Language::class, // Globally setting of Language
            \App\Http\Middleware\CommonSite::class,
        ],

        'api' => [
            'throttle:1000,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'dev' => \Laravel\Spark\Http\Middleware\VerifyUserIsDeveloper::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'hasTeam' => \Laravel\Spark\Http\Middleware\VerifyUserHasTeam::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'subscribed' => \Laravel\Spark\Http\Middleware\VerifyUserIsSubscribed::class,
        'teamSubscribed' => \Laravel\Spark\Http\Middleware\VerifyTeamIsSubscribed::class,
        'isadmin' => \App\Http\Middleware\IsAdmin::class,
        'iseditor' => \App\Http\Middleware\IsEditor::class,
    ];
}
