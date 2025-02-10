<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProductoController extends Controller
{
    protected $client;

    public function __construct()
    {
        // Obtén el token de la sesión
        $token = session('sanctum_token');

        // Inicializa el cliente Guzzle con el token en las cabeceras
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/api/', // URL base de la API
            'timeout'  => 25.0, // Tiempo de espera para la solicitud
            'headers' => [
                'Authorization' => 'Bearer ' . $token, // Incluye el token en las cabeceras
                'Accept' => 'application/json',
            ],
        ]);
    }

    // Método para mostrar una vista con datos de la API
    public function getProductos(Request $request)
    {
        try {
            // Realiza una solicitud GET a la API
            $response = $this->client->get('productos');
    
            // Decodifica la respuesta JSON
            $data = json_decode($response->getBody(), true);
    
            $productos = $data['data'] ?? [];
    
            // Verificar si hay un término de búsqueda
            if ($request->has('search') && $request->get('search') != '') {
                $search = $request->get('search');
                // Filtrar productos por el término de búsqueda (ajustar los campos a tus necesidades)
                $productos = array_filter($productos, function ($producto) use ($search) {
                    return stripos($producto['nombre'], $search) !== false || stripos($producto['descripcion'], $search) !== false;
                });
            }
    
            // Configuración de paginación
            $perPage = 10;  // Cantidad de productos por página
            $currentPage = $request->get('page', 1);  // Obtiene el número de página desde la URL
            $totalItems = count($productos);
            $totalPages = ceil($totalItems / $perPage);  // Calcula el total de páginas
    
            // Paginar los productos (obtenemos solo los productos para la página actual)
            $offset = ($currentPage - 1) * $perPage;
            $paginatedProducts = array_slice($productos, $offset, $perPage);
    
            // Crea un objeto de paginación manual
            $pagination = new \Illuminate\Pagination\LengthAwarePaginator(
                $paginatedProducts,
                $totalItems,
                $perPage,
                $currentPage,
                ['path' => $request->url(), 'query' => $request->query()]  // Asegura que la URL se mantenga
            );
    
            // Renderiza la vista y pasa los productos paginados
            return view('producto.index', ['data' => $pagination]);
        } catch (\Exception $e) {
            // Maneja errores
            return view('error', ['message' => 'Error al consumir la API: ' . $e->getMessage()]);
        }
    }
    

    // Método para mostrar un formulario de creación
    public function createForm()
    {
        try {
            // Obtener las categorías desde la API
            $response = $this->client->get('categorias');
            $data = json_decode($response->getBody(), true);
            $categorias = $data['data'] ?? [];

            return view('producto.create', compact('categorias'));
        } catch (\Exception $e) {
            return view('error', ['message' => 'Error al obtener categorías: ' . $e->getMessage()]);
        }
    }

    // Método para procesar el formulario de creación y enviar datos a la API
    public function storeData(Request $request)
    {
        try {
            // Envía los datos del formulario a la API
            $response = $this->client->post('producto', [
                'json' => $request->all() // Envía los datos del request como JSON
            ]);

            // Decodifica la respuesta JSON
            $data = json_decode($response->getBody(), true);

            // Redirige a la vista de detalles con los datos creados
            return redirect()->route('producto.index'); //PEDIENTE A ESTA RUTA

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
            $response = $this->client->get("producto/{$id}");
            $data = json_decode($response->getBody(), true);

            // Verifica que 'data' existe en la respuesta
            $producto = $data['data'] ?? null;

            if (!$producto) {
                return view('error', ['message' => 'No se encontraron datos para esta categoría.']);
            }

            // Obtener las categorías disponibles
            $responseCategorias = $this->client->get('categorias');
            $dataCategorias = json_decode($responseCategorias->getBody(), true);
            $categorias = $dataCategorias['data'] ?? [];

            // Renderiza la vista de edición con los datos
            return view('producto.edit', compact('producto', 'categorias'));
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
            $response = $this->client->put("producto/{$id}", [
                'json' => $request->all() // Envía los datos del request como JSON
            ]);

            // Decodifica la respuesta JSON
            $producto = json_decode($response->getBody(), true);

            // Redirige a la vista de detalles con los datos actualizados
            return redirect()->route('producto.index');
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
            $this->client->delete("producto/{$id}");

            // Redirige a la página principal (index)
            return redirect()->route('producto.index')->with('success', 'Categoría eliminada correctamente');
        } catch (\Exception $e) {
            // Maneja errores
            return view('error')->with('message', 'Error al eliminar la categoría: ' . $e->getMessage());
        }
    }
}
