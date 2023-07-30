<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\TrayectoriaController;

Route::get('/', function () {
    return view('home');
});

Route::get('/user', [UserController::class, 'mostrarVistaPrincipal'])->name('user.mostrarVistaPrincipal');
Route::get('/user/mostrarUsuarios', [UserController::class, 'mostrarUsuarios'])->name('user.mostrarUsuarios');
Route::get('/user/buscarUsuario', [UserController::class, 'mostrarVistaBuscarUsuario'])->name('user.vistaBuscarUsuario');
Route::post('/user/buscarUsuario', [UserController::class, 'buscarUsuario'])->name('user.buscarUsuario');
Route::get('/user/crearUsuario/', [UserController::class, 'mostrarVistaCrearUsuario'])->name('user.mostrarVistaCrearUsuario');
Route::post('/user/crearUsuario', [UserController::class, 'crearUsuario'])->name('user.crearUsuario');
Route::match(['get', 'patch'], '/user/editarUsuario/{username}', [UserController::class, 'editarUsuario'])->name('user.editarUsuario');
Route::match(['get', 'post', 'delete'], '/user/eliminarUsuario', [UserController::class, 'eliminarUsuario'])->name('user.eliminarUsuario');

Route::get('/paquete', [PaqueteController::class, 'mostrarVistaPrincipalPaquete'])->name('paquete.mostrarVistaPrincipalPaquete');
Route::get('/paquete/mostrarPaquetes', [PaqueteController::class, 'mostrarPaquetes'])->name('paquete.mostrarPaquetes');
Route::post('/paquete/crearPaquete', [PaqueteController::class, 'crearPaquete'])->name('paquete.crearPaquete');
Route::get('/paquete/buscarPaquete', [PaqueteController::class, 'buscarPaquete'])->name('paquete.buscarPaquete');
Route::put('/paquete/editarPaquete', [PaqueteController::class, 'editarPaquete'])->name('paquete.editarPaquete');
Route::delete('/paquete/eliminarPaquete', [PaqueteController::class, 'eliminarPaquete'])->name('paquete.eliminarPaquete');

Route::get('/almacen', [AlmacenController::class, 'mostrarVistaPrincipalAlmacen'])->name('almacen.mostrarVistaPrincipalAlmacen');
Route::get('/almacenes/mostrarAlmacenes', [AlmacenController::class, 'mostrarAlmacenes'])->name('almacen.mostrarAlmacenes');
Route::get('/almacenes/buscarAlmacen', [AlmacenController::class, 'mostrarVistaBuscarAlmacen'])->name('almacen.vistaBuscarAlmacen');
Route::post('/almacenes/buscarAlmacen', [AlmacenController::class, 'buscarAlmacen'])->name('almacen.buscarAlmacen');
Route::get('/almacenes/crearAlmacen', [AlmacenController::class, 'mostrarVistaCrearAlmacen'])->name('almacen.vistaCrearAlmacen');
Route::post('/almacenes/crearAlmacen', [AlmacenController::class, 'crearAlmacen'])->name('almacen.crearAlmacen');

//Route::put('/almacenes/editarAlmacen', [AlmacenController::class, 'editarAlmacen'])->name('almacenes.editarAlmacen');
Route::match(['get', 'patch'], '/user/editarAlmacen/{direccion}', [AlmacenController::class, 'editarAlmacen'])->name('almacen.editarAlmacen');
//Route::delete('/almacenes/eliminarAlmacen', [AlmacenController::class, 'eliminarAlmacen'])->name('almacenes.eliminarAlmacen');
Route::match(['get', 'post', 'delete'], '/almacen/eliminarAlmacen', [AlmacenController::class, 'eliminarAlmacen'])->name('almacen.eliminarAlmacen');

Route::get('/camiones/mostrarCamiones', [CamionController::class, 'mostrarCamiones'])->name('camiones.mostrarCamiones');
Route::post('/camiones/crearCamion', [CamionController::class, 'crearCamion'])->name('camiones.crearCamion');

Route::get('/lote', [LoteController::class, 'mostrarVistaPrincipalLote'])->name('lote.mostrarVistaPrincipalLote');
Route::get('/lote/mostrarLotes', [LoteController::class, 'mostrarLotes'])->name('lote.mostrarLotes');
Route::post('/lote/crearLote', [LoteController::class, 'crearLote'])->name('lote.crearLote');

Route::get('/trayectorias', [TrayectoriaController::class, 'mostrarTrayectorias'])->name('trayectorias.mostrarTrayectorias');
Route::post('/trayectorias', [TrayectoriaController::class, 'crearTrayectoria'])->name('trayectorias.crearTrayectoria');
Route::post('/trayectorias', [TrayectoriaController::class, 'editarTrayectoria'])->name('trayectorias.editarTrayectoria');
Route::post('/trayectorias', [TrayectoriaController::class, 'eliminarTrayectoria'])->name('trayectorias.eliminarTrayectoria');