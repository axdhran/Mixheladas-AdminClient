<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Obtener el rol del usuario actual desde la sesión
        $userRole = session('role');
        
        // Si no hay rol en la sesión, redirige al login
        if (!$userRole) {
            return redirect()->route('login')->with('error', 'No estás autenticado');
        }

        // Si el rol del usuario no es el rol requerido, redirige a la página de error
        if ($userRole !== $role && $userRole !== 'admin') {
            return response()->view('errors.403', [], 403);
        }

        // Si el rol coincide o si es admin, permite el acceso
        return $next($request);
    }
}
