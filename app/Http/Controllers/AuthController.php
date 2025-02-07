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

    public function showRegisterForm()
    {
        return view('usuario.register');
    }
    public function register(Request $request)
    {
        // Validar datos en el frontend antes de enviarlos
        $request->validate([
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'phone' => 'required|digits:8',
            'dui' => 'required|digits:9',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:admin,mesero,cocinero',
        ]);

        $apiUrl = "http://127.0.0.1:8000/api/register";

        try {
            // Enviar los datos a la API usando Http::post
            $response = Http::post($apiUrl, $request->all());

            // Verificar si la API responde correctamente
            if ($response->successful()) {
                return redirect()->route('usuario.index')->with('success', 'Usuario registrado correctamente.');
            }

            // Si la API responde con un error, obtener el mensaje
            $errorMessage = $response->json()['error'] ?? 'Error desconocido al registrar el usuario.';
            return redirect()->back()->withErrors(['api_error' => $errorMessage]);
        } catch (\Exception $e) {
            return redirect()->route('usuario.index')->with('error', 'Error de conexión con el servidor.');
        }
    }



    public function getUsuarios()
    {
        // Obtener el token de la sesión
        $token = session('sanctum_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Por favor, inicie sesión para continuar.');
        }

        // URL de la API
        $apiUrl = 'http://127.0.0.1:8000/api/users';

        // Solicitud a la API con autenticación
        $response = Http::withToken($token)->get($apiUrl);

        // Verifica si la respuesta es exitosa
        if ($response->successful()) {
            // Verifica la estructura de la respuesta
            $users = $response->json()['usuarios'] ?? [];

            return view('usuario.index', compact('users'));
        }

        return redirect()->route('login')->with('error', 'No se pudo obtener la lista de usuarios.');
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
