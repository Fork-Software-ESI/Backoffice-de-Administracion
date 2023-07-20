<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Ruta para listar usuarios (ejemplo)
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Ruta para ver el formulario de creación de usuario
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Ruta para guardar un nuevo usuario (POST)
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Ruta para ver los detalles de un usuario específico
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

// Ruta para ver el formulario de edición de un usuario
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

// Ruta para actualizar un usuario específico (PUT/PATCH)
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// Ruta para eliminar un usuario específico (DELETE)
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

