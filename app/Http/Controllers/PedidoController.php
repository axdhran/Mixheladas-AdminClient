<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client; 

class PedidoController extends Controller
{
    protected $client;

    public function __construct()
    {
        // Obtén el token de la sesión
        $token = session('sanctum_token');

        // Inicializa el cliente Guzzle con el token en las cabeceras
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/api/', // URL base de la API
            'timeout'  => 5.0, // Tiempo de espera para la solicitud
            'headers' => [
                'Authorization' => 'Bearer ' . $token, // Incluye el token en las cabeceras
                'Accept' => 'application/json',
            ],
        ]);
    }

    // Método para mostrar una vista con datos de la API
    public function getPedidos()
    {
        try {
            // Realiza una solicitud GET a la API
            $response = $this->client->get('pedidos'); 

            // Decodifica la respuesta JSON
            $data = json_decode($response->getBody(), true);

            $mesas = $data['data'] ?? [];

             // Filtra los pedidos para excluir los que tienen estado 'cancelado' o 'completado'
            $mesas = array_filter($mesas, function ($pedido) {
                return !in_array($pedido['estado'], ['cancelado', 'completado']);
            });

            // Renderiza la vista y pasa los datos
            return view('pedido.index', ['data' => $mesas]);

        } catch (\Exception $e) {
            // Maneja errores
            return view('error', ['message' => 'Error al consumir la API: ' . $e->getMessage()]);
        }
    }

    // Método para mostrar el formulario de creación de pedidos
    public function createForm()
    {
        try {
            // Obtener todas las mesas desde la API
            $responseMesas = $this->client->get('mesas');
            $responseData = json_decode($responseMesas->getBody()->getContents(), true);
    
            // Verifica si la respuesta tiene la clave 'data'
            if (!isset($responseData['data'])) {
                throw new \Exception('La respuesta de la API no contiene datos de mesas.');
            }
    
            $mesas = $responseData['data']; // Accede a la clave 'data'
    
            // Obtener todos los productos desde la API
            $responseProductos = $this->client->get('productos');
            $productos = json_decode($responseProductos->getBody()->getContents(), true);
    
            // Verifica si la respuesta de productos tiene la clave 'data'
            if (isset($productos['data'])) {
                $productos = $productos['data']; // Accede a la clave 'data' si existe
            }
    
            return view('pedido.create', compact('mesas', 'productos'));
        } catch (RequestException $e) {
            return redirect()->route('pedido.create')->with('error', 'Error al obtener los datos: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('pedido.create')->with('error', $e->getMessage());
        }
    }

    // Método para procesar el envío del formulario
    public function store(Request $request)
    {
        // Validación de datos de entrada
        $request->validate([
            'mesa_id' => 'required|numeric', // Solo verifica que sea un número
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|numeric', // Solo verifica que sea un número
            'items.*.cantidad' => 'required|integer|min:1',
        ]);

        try {
            // Datos para enviar a la API
            $data = [
                'mesa_id' => $request->mesa_id,
                'items' => $request->items,
            ];

            // Enviar la solicitud POST a la API
            $response = $this->client->post('pedido', [
                'json' => $data,
            ]);

            // Decodificar la respuesta
            $pedido = json_decode($response->getBody()->getContents(), true);

            // Redireccionar con un mensaje de éxito
            return redirect()->route('pedido.create')->with('success', 'Pedido creado exitosamente.');
            
        } catch (RequestException $e) {
            // Redireccionar con un mensaje de error
            return redirect()->route('pedido.create')->with('error', 'Error al crear el pedido: ' . $e->getMessage());
        }
    }

    public function updateEstado(Request $request, $id)
    {
        try {
            // Enviar solicitud PATCH a la API
            $response = $this->client->patch("pedido/$id", [
                'json' => ['estado' => $request->estado]
            ]);
    
            return response()->json(['status' => 200, 'message' => 'Estado actualizado']);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Error al actualizar el estado']);
        }
    }
 
}
