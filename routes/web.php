<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MesaController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\PedidoController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Muestra el formulario
Route::post('/login-post', [AuthController::class, 'login'])->name('login.post'); // Valida el login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Grupo para ADMIN (acceso total)
Route::middleware([CheckRole::class . ':admin'])->group(function () {

     // Rutas exclusivas del admin ( aca poner todas las rutas de administracion, en pocas palabras las de mantinimiento )
     //----------------------------------------------------------------------------------------------------------------------//
     // Rutas de mantenimiento de Categorías
     //Mostar index
     Route::get('/categoria/index', [CategoriaController::class, 'getCategorias'])->name('categoria.index');
     // Mostrar formulario de creación
     Route::get('/categoria/create', [CategoriaController::class, 'createForm'])->name('categoria.create');
     // Procesar formulario de creación
     Route::post('/categoria/store', [CategoriaController::class, 'storeData'])->name('categoria.store');
     // Mostrar formulario de edición
     Route::get('/categoria/edit/{id}', [CategoriaController::class, 'editForm'])->name('categoria.edit');
     // Procesar formulario de edición
     Route::put('/categoria/update/{id}', [CategoriaController::class, 'updateData'])->name('categoria.update');
     // Eliminar datos
     Route::delete('/categoria/delete/{id}', [CategoriaController::class, 'deleteData'])->name('categoria.destroy');
     //----------------------------------------------------------------------------------------------------------------------//
     // Rutas de mantenimiento de Producto
     //Mostar index
     Route::get('/producto/index', [ProductoController::class, 'getProductos'])->name('producto.index');
     // Mostrar formulario de creación
     Route::get('/producto/create', [ProductoController::class, 'createForm'])->name('producto.create');
     // Procesar formulario de creación
     Route::post('/producto/store', [ProductoController::class, 'storeData'])->name('producto.store');
     // Mostrar formulario de edición
     Route::get('/producto/edit/{id}', [ProductoController::class, 'editForm'])->name('producto.edit');
     // Procesar formulario de edición
     Route::put('/producto/update/{id}', [ProductoController::class, 'updateData'])->name('producto.update');
     // Eliminar datos
     Route::delete('/producto/delete/{id}', [ProductoController::class, 'deleteData'])->name('producto.destroy');
     //----------------------------------------------------------------------------------------------------------------------//
     // Rutas de mantenimiento de Mesas
     //Mostar index
     Route::get('/mesa/index', [MesaController::class, 'getMesas'])->name('mesa.index');
     // Mostrar formulario de creación
     Route::get('/mesa/create', [MesaController::class, 'createForm'])->name('mesa.create');
     // Procesar formulario de creación
     Route::post('/mesa/store', [MesaController::class, 'storeData'])->name('mesa.store');
     // Mostrar formulario de edición
     Route::get('/mesa/edit/{id}', [MesaController::class, 'editForm'])->name('mesa.edit');
     // Procesar formulario de edición
     Route::put('/mesa/update/{id}', [MesaController::class, 'updateData'])->name('mesa.update');
     // Eliminar datos
     Route::delete('/mesa/delete/{id}', [MesaController::class, 'deleteData'])->name('mesa.destroy');
});

// Subgrupo para MESEROS
Route::middleware([CheckRole::class . ':mesero,admin'])->group(function () {
     // Pone aca las rutas que solo podra acceder un mesero
     // Rutas de mantenimiento de Pedidos
     // Ruta para mostrar el formulario de creación de pedidos
     Route::get('/pedido/crear', [PedidoController::class, 'createForm'])->name('pedido.create');
     // Ruta para procesar el envío del formulario
     Route::post('/pedido', [PedidoController::class, 'store'])->name('pedido.store');
});

// Subgrupo para COCINEROS
Route::middleware([CheckRole::class . ':cocinero,admin'])->group(function () {
     //Mostar index
     Route::get('/pedido/index', [PedidoController::class, 'getPedidos'])->name('pedido.index');
     //Ruta para actualizar el estado 
     Route::patch('/pedido/update-estado/{id}', [PedidoController::class, 'updateEstado']);
});

// Rutas de mantenimiento de usuarios
Route::get('/user', [HomeController::class, 'index'])->name('user');
