<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Obtén el rol del usuario actual (almacenado en la sesión)
        $userRole = session('role');

        // Si el rol del usuario no es el rol requerido, redirige a la página de error (aca podemos poner una pagina personalizada)
        if ($role !== 'admin' && $userRole !== $role && $userRole !== 'admin') {
            return response()->view('errors.403', [], 403);
        }

        // Si el rol coincide, o si es admin, deja pasar la solicitud
        return $next($request);
    }
}
