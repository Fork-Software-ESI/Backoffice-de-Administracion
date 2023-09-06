<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\EstanteriaController;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
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

    Route::delete('/eliminar-user/{id}', [UserController::class, 'eliminarUsuario'])->name('eliminarUsuario');

    Route::get('/choferes', [ChoferController::class, 'mostrarChoferes'])->name('mostrarChoferes');

    //

    Route::get('/menu-almacen', function () {
        return view('almacen.almacen');
    })->name('vistaAlmacen');

    Route::get('/almacenes', [AlmacenController::class, 'mostrarAlmacenes'])->name('mostrarAlmacen');

    Route::get('/buscar-almacen', function () {
        return view('almacen.formularioBuscar');
    })->name('vistaBuscarAlmacen');

    Route::post('/buscar-almacen', [AlmacenController::class, 'buscarAlmacen'])->name('buscarAlmacen');

    Route::get('/crear-almacen', function () {
        return view('almacen.crearAlmacen');
    })->name('crearAlmacen');

    Route::post('/crear-almacen', [AlmacenController::class, 'crearAlmacen']);

    Route::get('/editar-almacen/{id}', [AlmacenController::class, 'editarAlmacen'])->name('editarAlmacen');

    Route::patch('/actualizar-almacen/{id}', [AlmacenController::class, 'actualizarAlmacen'])->name('actualizarAlmacen');

    Route::delete('/eliminar-almacen/{id}', [AlmacenController::class, 'eliminarAlmacen'])->name('eliminarAlmacen');

    //

    Route::get('/menu-paquete', function () {
        return view('paquete.paquete');
    })->name('vistaPaquete');

    Route::get('/paquetes', [PaqueteController::class, 'mostrarPaquetes'])->name('mostrarPaquete');

    Route::get('/buscar-paquete', function () {
        return view('paquete.formularioBuscar');
    })->name('vistaBuscarPaquete');

    Route::post('/buscar-paquete', [PaqueteController::class, 'buscarPaquete'])->name('buscarPaquete');

    Route::get('/crear-paquete', function () {
        return view('paquete.crearPaquete');
    })->name('crearPaquete');

    Route::post('/crear-paquete', [PaqueteController::class, 'crearPaquete']);

    Route::get('/editar-paquete/{id}', [PaqueteController::class, 'editarPaquete'])->name('editarPaquete');

    Route::patch('/actualizar-paquete/{id}', [PaqueteController::class, 'actualizarPaquete'])->name('actualizarPaquete');

    Route::delete('/eliminar-paquete/{id}', [PaqueteController::class, 'eliminarPaquete'])->name('eliminarPaquete');

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
});