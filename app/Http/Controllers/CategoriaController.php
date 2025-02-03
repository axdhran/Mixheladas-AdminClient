<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CategoriaController extends Controller
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
    public function getCategorias()
    {
        try {
            // Realiza una solicitud GET a la API
            $response = $this->client->get('categorias'); 

            // Decodifica la respuesta JSON
            $data = json_decode($response->getBody(), true);

            $categorias = $data['data'] ?? [];

            // Renderiza la vista y pasa los datos
            return view('categoria.index', ['data' => $categorias]);

        } catch (\Exception $e) {
            // Maneja errores
            return view('error', ['message' => 'Error al consumir la API: ' . $e->getMessage()]);
        }
    }

    // Método para mostrar un formulario de creación
    public function createForm()
    {
        return view('categoria.create');
    }

    // Método para procesar el formulario de creación y enviar datos a la API
    public function storeData(Request $request)
    {
        try {
            // Envía los datos del formulario a la API
            $response = $this->client->post('categoria', [
                'json' => $request->all() // Envía los datos del request como JSON
            ]);

            // Decodifica la respuesta JSON
            $data = json_decode($response->getBody(), true);

            // Redirige a la vista de detalles con los datos creados
            return redirect()->route('categoria.index'); //PEDIENTE A ESTA RUTA

        } catch (\Exception $e) {
            // Maneja errores
            return view('error', ['message' => 'Error al enviar datos a la API: ' . $e->getMessage()]);
        }
    }

    // Método para mostrar un formulario de edición
    public function editForm($id)
    {
        try {
            // Obtiene los datos actuales de la API
            $response = $this->client->get("categoria/{$id}");

            $data = json_decode($response->getBody(), true);

            // Verifica que 'data' existe en la respuesta
            $categoria = $data['categoria'] ?? null;

            if (!$categoria) {
                return view('error', ['message' => 'No se encontraron datos para esta categoría.']);
            }

            // Renderiza la vista de edición con los datos
            return view('categoria.edit', compact('categoria'));

        } catch (\Exception $e) {
            // Maneja errores
            return view('error', ['message' => 'Error al obtener datos de la API: ' . $e->getMessage()]);
        }
    }

    // Método para procesar el formulario de edición y actualizar datos en la API
    public function updateData(Request $request, $id)
    {
        try {
            // Envía los datos actualizados a la API
            $response = $this->client->put("categoria/{$id}", [
                'json' => $request->all() // Envía los datos del request como JSON
            ]);

            // Decodifica la respuesta JSON
            $categoria = json_decode($response->getBody(), true);

            // Redirige a la vista de detalles con los datos actualizados
            return redirect()->route('categoria.index');

        } catch (\Exception $e) {
            // Maneja errores
            return view('error', ['message' => 'Error al actualizar datos en la API: ' . $e->getMessage()]);
        }
    }

    //Metodo para eliminar una categoria
    public function deleteData($id)
    {
        try {
            // Elimina los datos en la API
            $this->client->delete("categoria/{$id}");

            // Redirige a la página principal (index)
            return redirect()->route('categoria.index')->with('success', 'Categoría eliminada correctamente');

        } catch (\Exception $e) {
            // Maneja errores
            return view('error')->with('message', 'Error al eliminar la categoría: ' . $e->getMessage());
        }
    }
 }

