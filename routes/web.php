<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaqueteController;

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


// Rutas para UserController

Route::get('/users', [UserController::class, 'mostrarUsuarios'])->name('users.mostrarUsuarios');

Route::get('/users/{username}', [UserController::class, 'getUsuarioId'])->name('users.getUsuarioId');

Route::put('/users/{username}/edit', [UserController::class, 'editarUsuario'])->name('users.editarUsuario');

Route::delete('/users/{username}', [UserController::class, 'EliminarUsuario'])->name('users.EliminarUsuario');

// Rutas para PaqueteController

Route::get('/paquete', [PaqueteController::class, 'getPaquete'])->name('paquete.getPaquete');

Route::post('/paquete', [PaqueteController::class, 'crearPaquete'])->name('paquete.crearPaquete');

Route::get('/paquete/{id}', [PaqueteControllerr::class, 'infoPaquete'])->name('paquete.infoPaquete');

Route::put('/paquete/{id}/edit', [PaqueteController::class, 'editarPaquete'])->name('paquete.editarPaquete');

Route::delete('/paquete/{id}', [PaqueteController::class, 'eliminarPaquete'])->name('paquete.elimiarPaquete');

// Rutas para AlmacenController

Route::get('/almacenes', [AlmacenController::class, 'index'])->name('almacenes.index');

Route::post('/almacenes', [AlmacenController::class, 'store'])->name('almacenes.store');

// Rutas para CamionController

Route::get('/camiones', [CamionController::class, 'index'])->name('camiones.index');

Route::post('/camiones', [CamionController::class, 'store'])->name('camiones.store');

// Rutas para LoteController

Route::get('/lotes', [LoteController::class, 'getLotes'])->name('lotes.getLotes');

Route::post('/lotes', [LoteController::class, 'createLote'])->name('lotes.createLote');

// Rutas para TrayectoriaController

Route::get('/trayectorias', [TrayectoriaController::class, 'index'])->name('trayectorias.index');

Route::post('/trayectorias', [TrayectoriaController::class, 'store'])->name('trayectorias.store');