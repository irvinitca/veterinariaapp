<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
     /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        $this->routes(function () {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::prefix('')
                ->middleware(['web', 'auth', 'role:Administrador']) // Middleware 'role:admin' para rutas de administrador
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

            Route::prefix('')
                ->middleware(['web', 'auth', 'role:Veterinario']) // Middleware 'role:user' para rutas de usuario
                ->namespace($this->namespace)
                ->group(base_path('routes/veterinario.php'));
            
                Route::prefix('')
                ->middleware(['web', 'auth', 'role:Recepcion']) // Middleware 'role:recepcion' para rutas de usuario
                ->namespace($this->namespace)
                ->group(base_path('routes/recepcion.php'));
        });
    }
}
