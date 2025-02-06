<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie; // Importar Cookie
use Illuminate\Support\Facades\Session; // Importar Session

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        // Valida los datos del formulario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $apiUrl = 'http://127.0.0.1:8000/api/login';

        $response = Http::post($apiUrl, $credentials);

        if ($response->successful()) {
            $responseData = $response->json();

            if (isset($responseData['token'], $responseData['role'])) {
                $token = $responseData['token'];
                $role = $responseData['role'];

                // Almacena el token y el rol en la sesión actual
                session([
                    'sanctum_token' => $token,
                    'role' => $role,
                ]);

                // Redirigir según el rol (aca se va redirigir cuando ya las vistas esten definidas)
                // Ejemplo: si es admin que lo mande a la parte administrativa, si es cocinero o mesero a sus vistas correspondientes
                if ($role == 'admin') {
                    return redirect()->route('home');
                } elseif ($role == 'mesero') {
                    return redirect()->route('pedido.create');
                } elseif ($role == 'cocinero') {
                    return redirect()->route('pedido.index');
                } else {
                    return redirect()->route('home');
                }
            }
        }

        // Maneja los errores si no se recibió un token
        return back()->withErrors([
            'error' => 'Las credenciales no son correctas o la API no devolvió un token.',
        ]);
    }


    public function logout(Request $request)
    {
        // Eliminar el token de la cookie y de la sesión
        Cookie::forget('sanctum_token');
        Session::forget('sanctum_token');

        // Redirige al usuario después de iniciar sesión
        return redirect()->route('login');

        // Responder con un mensaje de cierre de sesión exitoso
        return response()->json(['message' => 'Cierre de sesión exitoso.'], 200);
    }
}
