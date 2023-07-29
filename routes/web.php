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
    return view('home');
});

// Rutas para UserController

Route::get('/user',[UserController::class, 'mostrarVistaPrincipal'])->name('user.mostrarVistaPrincipal');

//Route::get('/users', [UserController::class, 'mostrarUsuarios'])->name('users.mostrarUsuarios');

Route::get('/user/mostrarUsuarios', [UserController::class, 'mostrarUsuarios'])->name('user.mostrarUsuarios');

Route::match(['get', 'post'], '/user/buscarUsuario', [UserController::class, 'buscarUsuario'])->name('user.buscarUsuario');

// crearUsuario esta en api.php

Route::get('/user/crearUsuario', [UserController::class, 'mostrarVistaCrearUsuario'])->name('user.mostrarVistaCrearUsuario');

Route::post('/user/crearUsuario', [UserController::class, 'crearUsuario'])->name('user.crearUsuario');

Route::match(['get', 'post', 'delete'],'/user/eliminarUsuario', [UserController::class, 'eliminarUsuario'])->name('users.eliminarUsuario');

// Rutas para PaqueteController

Route::get('/paquete',[PaqueteController::class, 'mostrarVistaPrincipalPaquete'])->name('paquete.mostrarVistaPrincipalPaquete');

Route::get('/paquete/mostrarPaquetes', [PaqueteController::class, 'mostrarPaquetes'])->name('paquete.mostrarPaquetes');

Route::post('/paquete', [PaqueteController::class, 'crearPaquete'])->name('paquete.crearPaquete');

Route::get('/paquete/{id}', [PaqueteController::class, 'infoPaquete'])->name('paquete.infoPaquete');

Route::put('/paquete/{id}', [PaqueteController::class, 'editarPaquete'])->name('paquete.editarPaquete');

Route::delete('/paquete/{id}', [PaqueteController::class, 'eliminarPaquete'])->name('paquete.elimiarPaquete');

// Rutas para AlmacenController

Route::get('/almacen',[AlmacenController::class, 'mostrarVistaPrincipalAlmacen'])->name('almacenes.mostrarVistaPrincipalAlmacen');

Route::get('/almacenes', [AlmacenController::class, 'mostrarAlmacenes'])->name('almacenes.mostrar');

Route::post('/almacenes', [AlmacenController::class, 'crearAlmacen'])->name('almacenes.crearAlmacen');

Route::put('/almacenes/{id}', [AlmacenController::class, 'editarAlmacen'])->name('almacenes.editarAlmacen');

Route::delete('/almacenes/{id}', [AlmacenController::class, 'eliminarAlmacen'])->name('almacenes.eliminarAlmacen');

// Rutas para CamionController

Route::get('/camiones/mostrarCamiones', [CamionController::class, 'mostrarCamiones'])->name('camiones.mostrarCamiones');

Route::post('/camiones/crearCamion', [CamionController::class, 'crearCamion'])->name('camiones.crearCamion');

// Rutas para LoteController

Route::get('/lote',[LoteController::class, 'mostrarVistaPrincipalLote'])->name('lote.mostrarVistaPrincipalLote');

Route::get('/lote/mostrarLotes', [LoteController::class, 'mostrarLotes'])->name('lote.mostrarLotes');

Route::post('/lote/crearLote', [LoteController::class, 'crearLote'])->name('lote.crearLote');

// Rutas para TrayectoriaController

Route::get('/trayectorias', [TrayectoriaController::class, 'mostrarTrayectorias'])->name('trayectorias.mostrarTrayectorias');

Route::post('/trayectorias', [TrayectoriaController::class, 'crearTrayectoria'])->name('trayectorias.crearTrayectoria');

Route::post('/trayectorias', [TrayectoriaController::class, 'editarTrayectoria'])->name('trayectorias.editarTrayectoria');

Route::post('/trayectorias', [TrayectoriaController::class, 'eliminarTrayectoria'])->name('trayectorias.eliminarTrayectoria');