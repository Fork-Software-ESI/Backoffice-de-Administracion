<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\EstanteriaController;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\Api\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/menu', function () {
    return view('users.user');
})->name('vistaUsuario');

Route::get('/usuarios', [UserController::class, 'mostrarUsuarios'])->name('mostrarUsuarios');

Route::get('/buscar-usuario', function () {
    return view('users.formularioBuscar');
})->name('vistaBuscarUsuario');

Route::post('/buscar-usuario', [UserController::class, 'buscarUsuario'])->name('buscarUsuario');

Route::get('/crear-usuario', function () {
    return view('users.crearUsuario');
})->name('crearUsuario');

Route::post('/crear-usuario', [UserController::class, 'crearUsuario']);

Route::get('/editar-usuario/{username}', [UserController::class, 'editarUsuario'])->name('editarUsuario');

Route::patch('/actualizar-usuario/{username}', [UserController::class, 'actualizarUsuario'])->name('actualizarUsuario');

//Route::match(['get', 'post', 'delete'], '/users/eliminarUsuario', [UserController::class, 'eliminarUsuario'])->name('user.eliminarUsuario');

Route::delete('/eliminar-user/{id}', [UserController::class, 'eliminarUsuario'])->name('eliminarUsuario');

//Route::delete('/eliminar', [UserController::class, 'eliminarUsuario'])->name('eliminarUsuario');

Route::get('/choferes', [ChoferController::class, 'mostrarChoferes'])->name('mostrarChoferes');

/*
Route::get('/paquetes', [PaqueteController::class, 'mostrarVistaPrincipalPaquete'])->name('paquete.mostrarVistaPrincipalPaquete');

Route::get('/paquetes', function () {
    return view('paquete.paquete');
})->name('vistaPaquetes');

Route::get('/paquetes/mostrarPaquetes', [PaqueteController::class, 'mostrarPaquetes'])->name('paquete.mostrarPaquetes');
Route::get('/paquetes/buscarPaquete', [PaqueteController::class, 'mostrarVistaBuscarPaquete'])->name('paquete.buscarPaquete');
Route::post('/paquetes/buscarPaquete', [PaqueteController::class, 'buscarPaquete'])->name('paquete.buscarPaquete');
Route::get('/paquetes/crearPaquete', [PaqueteController::class, 'mostrarVistaCrearPaquete'])->name('paquete.vistaCrearPaquete');
Route::post('/paquetes/crearPaquete', [PaqueteController::class, 'crearPaquete'])->name('paquete.crearPaquete');
Route::match(['get', 'patch'], '/paquetes/editarPaquete/{id}', [PaqueteController::class, 'editarPaquete'])->name('paquete.editarPaquete');
Route::match(['get', 'post', 'delete'], '/paquetes/eliminarPaquete', [PaqueteController::class, 'eliminarPaquete'])->name('paquete.eliminarPaquete');

Route::get('/almacenes', [AlmacenController::class, 'mostrarVistaPrincipalAlmacen'])->name('almacen.mostrarVistaPrincipalAlmacen');

Route::get('/almacenes', function () {
    return view('almacen.almacen');
})->name('vistaAlmacenes');

Route::get('/almacenes/mostrarAlmacenes', [AlmacenController::class, 'mostrarAlmacenes'])->name('almacen.mostrarAlmacenes');
Route::get('/almacenes/buscarAlmacen', [AlmacenController::class, 'mostrarVistaBuscarAlmacen'])->name('almacen.vistaBuscarAlmacen');
Route::post('/almacenes/buscarAlmacen', [AlmacenController::class, 'buscarAlmacen'])->name('almacen.buscarAlmacen');
Route::get('/almacenes/crearAlmacen', [AlmacenController::class, 'mostrarVistaCrearAlmacen'])->name('almacen.vistaCrearAlmacen');
Route::post('/almacenes/crearAlmacen', [AlmacenController::class, 'crearAlmacen'])->name('almacen.crearAlmacen');
Route::match(['get', 'patch'], '/almacenes/editarAlmacen/{id}', [AlmacenController::class, 'editarAlmacen'])->name('almacen.editarAlmacen');
Route::match(['get', 'post', 'delete'], '/almacenes/eliminarAlmacen', [AlmacenController::class, 'eliminarAlmacen'])->name('almacen.eliminarAlmacen');
*/

Route::get('/menu-almacen', function () {
    return view('almacen.almacen');
})->name('vistaAlmacen');

Route::get('/almacenes', [AlmacenController::class, 'mostrarAlmacenes'])->name('mostrarAlmacen');

Route::get('/buscar-almacen', function () {
    return view('almacen.formularioBuscar');
})->name('vistaBuscarAlmacen');

Route::post('/buscar/{id}', [AlmacenController::class, 'buscarAlmacen'])->name('buscarAlmacen');

Route::get('/crear-almacen', function () {
    return view('users.crearAlmacen');
})->name('crearAlmacen');

Route::post('/crear-almacen', [AlmacenController::class, 'crearAlmacen']);

Route::get('/editar-almacen/{id}', [AlmacenController::class, 'editarAlmacen'])->name('editarAlmacen');

Route::patch('/actualizar-almacen/{id}', [AlmacenController::class, 'actualizarAlmacen'])->name('actualizarAlmacen');

/*
Route::get('/lotes', [LoteController::class, 'mostrarVistaPrincipalLote'])->name('lote.mostrarVistaPrincipalLote');

Route::get('/lotes', function () {
    return view('lote.lote');
})->name('vistaLotes');

Route::get('/lotes/mostrarLotes', [LoteController::class, 'mostrarLotes'])->name('lote.mostrarLotes');
Route::get('/lotes/buscarLote', [LoteController::class, 'mostrarVistaBuscarLote'])->name('lote.vistaBuscarLote');
Route::post('/lotes/buscarLote', [LoteController::class, 'buscarLote'])->name('lote.buscarLote');
Route::get('/lotes/crearLote', [LoteController::class, 'mostrarVistaCrearLote'])->name('lote.vistaCrearLote');
Route::post('/lotes/crearLote', [LoteController::class, 'crearLote'])->name('lote.crearLote');
Route::match(['get', 'patch'], '/lotes/editarLote/{id}', [LoteController::class, 'editarLote'])->name('lote.editarLote');
Route::match(['get', 'post', 'delete'], '/lotes/eliminarLote', [LoteController::class, 'eliminarLote'])->name('lote.eliminarLote');

Route::get('/estanterias', [EstanteriaController::class, 'mostrarVistaPrincipalEstanteria'])->name('estanteria.mostrarVistaPrincipalEstanteria');

Route::get('/estanterias', function () {
    return view('estanteria.estanteria');
})->name('vistaEstanterias');

Route::get('/estanterias/mostrarEstanteria', [EstanteriaController::class, 'mostrarEstanteria'])->name('estanteria.mostrarEstanterias');
Route::get('/estanterias/buscarEstanteria', [EstanteriaController::class, 'mostrarVistaBuscarEstanteria'])->name('estanteria.vistaBuscarEstanteria');
Route::post('/estanterias/buscarEstanteria', [EstanteriaController::class, 'buscarEstanteria'])->name('estanteria.buscarEstanteria');
Route::get('/estanterias/crearEstanteria/', [EstanteriaController::class, 'mostrarVistaCrearEstanteria'])->name('estanteria.mostrarVistaCrearEstanteria');
Route::post('/estanterias/crearEstanteria', [EstanteriaController::class, 'crearEstanteria'])->name('estanteria.crearEstanteria');
Route::match(['get', 'patch'], '/estanterias/editarEstanteria/{id}', [EstanteriaController::class, 'editarEstanteria'])->name('estanteria.editarEstanteria');
Route::match(['get', 'post', 'delete'], '/estanterias/eliminarEstanteria', [EstanteriaController::class, 'eliminarEstanteria'])->name('estanteria.eliminarEstanteria');

*/