<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\TrayectoriaController;


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

Route::get('/user',[UserController::class, 'mostrarVistaPrincipal']);

//Route::get('/users', [UserController::class, 'mostrarUsuarios'])->name('users.mostrarUsuarios');

Route::get('/user/mostrarUsuarios', [UserController::class, 'mostrarUsuarios']);

Route::match(['get', 'post'], '/user/buscarUsuario', [UserController::class, 'buscarUsuario'])->name('users.buscarUsuario');

// crearUsuario esta en api.php

Route::get('/user/crearUsuario', [UserController::class, 'mostrarVistaCrearUsuario'])->name('user.mostrarVistaCrearUsuario');
Route::post('/user/crearUsuario', [UserController::class, 'crearUsuario'])->name('user.crearUsuario');

Route::match(['get', 'post', 'delete'],'/user/eliminarUsuario', [UserController::class, 'eliminarUsuario'])->name('users.eliminarUsuario');

// Rutas para PaqueteController

Route::get('/paquete', [PaqueteController::class, 'getPaquete'])->name('paquete.getPaquete');

Route::post('/paquete', [PaqueteController::class, 'crearPaquete'])->name('paquete.crearPaquete');

Route::get('/paquete/{id}', [PaqueteController::class, 'infoPaquete'])->name('paquete.infoPaquete');

Route::put('/paquete/{id}', [PaqueteController::class, 'editarPaquete'])->name('paquete.editarPaquete');

Route::delete('/paquete/{id}', [PaqueteController::class, 'eliminarPaquete'])->name('paquete.elimiarPaquete');

// Rutas para AlmacenController

Route::get('/almacenes', [AlmacenController::class, 'mostrarAlmacenes'])->name('almacenes.mostrar');

Route::post('/almacenes', [AlmacenController::class, 'crearAlmacen'])->name('almacenes.crearAlmacen');

Route::put('/almacenes/{id}', [AlmacenController::class, 'editarAlmacen'])->name('almacenes.editarAlmacen');

Route::delete('/almacenes/{id}', [AlmacenController::class, 'eliminarAlmacen'])->name('almacenes.eliminarAlmacen');

// Rutas para CamionController

Route::get('/camiones', [CamionController::class, 'index'])->name('camiones.index');

Route::post('/camiones', [CamionController::class, 'store'])->name('camiones.store');

// Rutas para LoteController

Route::get('/lotes', [LoteController::class, 'getLotes'])->name('lotes.getLotes');

Route::post('/lotes', [LoteController::class, 'createLote'])->name('lotes.createLote');

// Rutas para TrayectoriaController

Route::get('/trayectorias', [TrayectoriaController::class, 'mostrarTrayectorias'])->name('trayectorias.mostrarTrayectorias');

Route::post('/trayectorias', [TrayectoriaController::class, 'crearTrayectoria'])->name('trayectorias.crearTrayectoria');

Route::post('/trayectorias', [TrayectoriaController::class, 'editarTrayectoria'])->name('trayectorias.editarTrayectoria');

Route::post('/trayectorias', [TrayectoriaController::class, 'eliminarTrayectoria'])->name('trayectorias.eliminarTrayectoria');