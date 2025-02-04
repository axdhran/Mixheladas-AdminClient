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

    // Método para mostrar el formulario de creación de pedidos
    public function createForm()
    {
        try {
            // Obtener todas las mesas desde la API
            $responseMesas = $this->client->get('mesas');
            $mesas = json_decode($responseMesas->getBody()->getContents(), true);

            
            // Obtener todos los productos desde la API
            $responseProductos = $this->client->get('productos');
            $productos = json_decode($responseProductos->getBody()->getContents(), true);

            return view('pedido.create', compact('mesas', 'productos'));
        } catch (RequestException $e) {
            return redirect()->route('pedido.create')->with('error', 'Error al obtener los datos: ' . $e->getMessage());
        }
    }

 // Método para procesar el envío del formulario
 public function store(Request $request)
 {
     // Validación de datos de entrada
     $request->validate([
         'mesa_id' => 'required|exists:mesas,id',
         'items' => 'required|array|min:1',
         'items.*.producto_id' => 'required|exists:productos,id',
         'items.*.cantidad' => 'required|integer|min:1',
     ]);

     try {
         // Datos para enviar a la API
         $data = [
             'mesa_id' => $request->mesa_id,
             'items' => $request->items,
         ];

         // Enviar la solicitud POST a la API
         $response = $this->client->post('pedidos', [
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
}
