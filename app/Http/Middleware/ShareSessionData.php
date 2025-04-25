<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class ShareSessionData
{
    public function handle($request, Closure $next)
    {
        // Comparte los datos de la sesión con todas las vistas
        View::share('usuari', session('usuari'));
        View::share('admin', session('admin'));

        return $next($request);
    }
}
