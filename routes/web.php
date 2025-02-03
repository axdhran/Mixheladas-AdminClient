<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Muestra el formulario
Route::post('/login-post', [AuthController::class, 'login'])->name('login.post'); // Valida el login


    // Rutas de mantenimiento de usuarios
    Route::get('/user', [HomeController::class, 'index'])->name('user');

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



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    