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
    
        // URL de la API que utiliza Sanctum
        $apiUrl = 'http://127.0.0.1:8000/api/login'; // Ajusta según la URL de tu API
    
        // Realiza la solicitud HTTP
        $response = Http::post($apiUrl, $credentials);
    
        // Verifica si la respuesta fue exitosa
        if ($response->successful()) {
            $responseData = $response->json();
            
            if (isset($responseData['token'])) {
                $token = $responseData['token'];
                session(['sanctum_token' => $token]);
    
                // Redirige al usuario después de iniciar sesión
                return redirect()->route('user');
            }
        }
    
        // Maneja los errores si no se recibió un token
        return back()->withErrors([
            'email' => 'Las credenciales no son correctas o la API no devolvió un token.',
        ]);
    }


    public function logout(Request $request)
    {
        // Eliminar el token de la cookie y de la sesión
        Cookie::forget('sanctum_token');
        Session::forget('sanctum_token');

        // Responder con un mensaje de cierre de sesión exitoso
        return response()->json(['message' => 'Cierre de sesión exitoso.'], 200);
    }
}
