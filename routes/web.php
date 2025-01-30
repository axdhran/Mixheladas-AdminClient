<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Muestra el formulario
Route::post('/login-post', [AuthController::class, 'login'])->name('login.post'); // Valida el login


Route::get('/user', [HomeController::class, 'index'])->name('user');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    