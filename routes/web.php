<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\LoteController;

Route::get('/', function () {
    return view('home');
});

Route::get('/users', [UserController::class, 'mostrarVistaPrincipal'])->name('user.mostrarVistaPrincipal');
Route::get('/users/mostrarUsuarios', [UserController::class, 'mostrarUsuarios'])->name('user.mostrarUsuarios');
Route::get('/users/buscarUsuario', [UserController::class, 'mostrarVistaBuscarUsuario'])->name('user.vistaBuscarUsuario');
Route::post('/users/buscarUsuario', [UserController::class, 'buscarUsuario'])->name('user.buscarUsuario');
Route::get('/users/crearUsuario/', [UserController::class, 'mostrarVistaCrearUsuario'])->name('user.mostrarVistaCrearUsuario');
Route::post('/users/crearUsuario', [UserController::class, 'crearUsuario'])->name('user.crearUsuario');
Route::match(['get', 'patch'], '/users/editarUsuario/{username}', [UserController::class, 'editarUsuario'])->name('user.editarUsuario');
Route::match(['get', 'post', 'delete'], '/users/eliminarUsuario', [UserController::class, 'eliminarUsuario'])->name('user.eliminarUsuario');

Route::get('/paquetes', [PaqueteController::class, 'mostrarVistaPrincipalPaquete'])->name('paquete.mostrarVistaPrincipalPaquete');
Route::get('/paquetes/mostrarPaquetes', [PaqueteController::class, 'mostrarPaquetes'])->name('paquete.mostrarPaquetes');
Route::get('/paquetes/buscarPaquete', [PaqueteController::class, 'buscarPaquete'])->name('paquete.buscarPaquete');
Route::post('/paquetes/buscarPaquete', [PaqueteController::class, 'buscarPaquete'])->name('paquete.buscarPaquete');
Route::get('/paquetes/crearPaquete', [PaqueteController::class, 'mostrarVistaCrearPaquete'])->name('paquete.vistaCrearPaquete');
Route::post('/paquetes/crearPaquete', [PaqueteController::class, 'crearPaquete'])->name('paquete.crearPaquete');
Route::match(['get', 'patch'], '/paquetes/editarPaquete/{id}', [PaqueteController::class, 'editarPaquete'])->name('paquete.editarPaquete');
Route::match(['get', 'post', 'delete'], '/paquetes/eliminarPaquete', [PaqueteController::class, 'eliminarPaquete'])->name('paquete.eliminarPaquete');

Route::get('/almacenes', [AlmacenController::class, 'mostrarVistaPrincipalAlmacen'])->name('almacen.mostrarVistaPrincipalAlmacen');
Route::get('/almacenes/mostrarAlmacenes', [AlmacenController::class, 'mostrarAlmacenes'])->name('almacen.mostrarAlmacenes');
Route::get('/almacenes/buscarAlmacen', [AlmacenController::class, 'mostrarVistaBuscarAlmacen'])->name('almacen.vistaBuscarAlmacen');
Route::post('/almacenes/buscarAlmacen', [AlmacenController::class, 'buscarAlmacen'])->name('almacen.buscarAlmacen');
Route::get('/almacenes/crearAlmacen', [AlmacenController::class, 'mostrarVistaCrearAlmacen'])->name('almacen.vistaCrearAlmacen');
Route::post('/almacenes/crearAlmacen', [AlmacenController::class, 'crearAlmacen'])->name('almacen.crearAlmacen');
Route::match(['get', 'patch'], '/almacenes/editarAlmacen/{id}', [AlmacenController::class, 'editarAlmacen'])->name('almacen.editarAlmacen');
Route::match(['get', 'post', 'delete'], '/almacenes/eliminarAlmacen', [AlmacenController::class, 'eliminarAlmacen'])->name('almacen.eliminarAlmacen');

Route::get('/lotes', [LoteController::class, 'mostrarVistaPrincipalLote'])->name('lote.mostrarVistaPrincipalLote');
Route::get('/lotes/mostrarLotes', [LoteController::class, 'mostrarLotes'])->name('lote.mostrarLotes');
Route::get('/lotes/buscarLote', [LoteController::class, 'mostrarVistaBuscarLote'])->name('lote.vistaBuscarLote');
Route::post('/lotes/buscarLote', [LoteController::class, 'buscarLote'])->name('lote.buscarLote');
Route::get('/lotes/crearLote', [LoteController::class, 'mostrarVistaCrearLote'])->name('lote.vistaCrearLote');
Route::post('/lotes/crearLote', [LoteController::class, 'crearLote'])->name('lote.crearLote');
Route::match(['get', 'patch'], '/lotes/editarLote/{id}', [LoteController::class, 'editarLote'])->name('lote.editarLote');
Route::match(['get', 'post', 'delete'], '/lotes/eliminarLote', [LoteController::class, 'eliminarLote'])->name('lote.eliminarLote');