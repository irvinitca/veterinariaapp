<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check() && $request->user()->hasAnyRole($roles)) {
            return $next($request);
        }

        return redirect('/'); // Redirige a la página principal si el usuario no tiene el rol requerido
    }
}
