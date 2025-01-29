<?php

namespace App\Http;

use App\Http\Middleware\CheckRole;
use Illuminate\Auth\Middleware\Authorize;
use App\Http\Middleware\CheckAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;

class Kernel extends HttpKernel
{
    /**
     * Les classes de middleware globales.
     *
     * Ces middleware s'exécutent pour toutes les requêtes dans l'application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    /**
     * Les classes de middleware de groupe.
     *
     * Ces middleware sont assignés à des groupes de routes.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Les middleware de route.
     *
     * Ces middleware sont assignés à des routes individuelles.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'superadmin' => \App\Http\Middleware\CheckSuperAdmin::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'role' => \App\Http\Middleware\CheckRole::class,
        'superadmin' => \App\Http\Middleware\CheckSuperAdmin::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => SubstituteBindings::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

    ];


    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'role' => \App\Http\Middleware\CheckRole::class,
        'superadmin' => \App\Http\Middleware\CheckSuperAdmin::class,
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class, // Correction ici
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
    ];

    /**
     * Les middleware globaux que vous souhaitez appliquer.
     *
     * Ces middleware s'appliquent à chaque requête, indépendamment de la route.
     */
    public function __construct()
    {
        parent::__construct();

        // Vous pouvez ajouter des middleware personnalisés ici si nécessaire.
    }
}