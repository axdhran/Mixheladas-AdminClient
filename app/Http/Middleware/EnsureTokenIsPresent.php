<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsPresent
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el token está en la sesión
        if (!Session::has('sanctum_token')) {
            return redirect()->route('login')->withErrors(['error' => 'Debes iniciar sesión para acceder a esta página.']);
        }

        return $next($request);
    }
}
