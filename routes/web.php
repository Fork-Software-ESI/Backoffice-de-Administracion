<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\EstanteController;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\PlataformaController;
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

    Route::get('/asignarCamion', function(){
        return view('chofer.asignarCamion');
    })->name('vistaAsignarCamion');

    Route::post('/asignarCamion', [ChoferController::class, 'asignarCamion'])->name('asignarCamion');


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

    //

    Route::get('/menu-lote', function () {
        return view('lote.lote');
    })->name('vistaLote');

    Route::get('/lotes', [LoteController::class, 'mostrarLotes'])->name('mostrarLote');

    Route::get('/buscar-lote', function () {
        return view('lote.formularioBuscar');
    })->name('vistaBuscarLote');

    Route::post('/buscar-lote', [LoteController::class, 'buscarLote'])->name('buscarLote');

    Route::get('/crear-lote', function () {
        return view('lote.crearLote');
    })->name('crearLote');

    Route::post('/crear-lote', [LoteController::class, 'crearLote']);

    Route::get('/editar-lote/{id}', [LoteController::class, 'editarLote'])->name('editarLote');

    Route::patch('/actualizar-lote/{id}', [LoteController::class, 'actualizarLote'])->name('actualizarLote');

    Route::delete('/eliminar-lote/{id}', [LoteController::class, 'eliminarLote'])->name('eliminarLote');
    
    //

    Route::get('/menu-estanteria', function () {
        return view('estanteria.estanteria');
    })->name('vistaEstante');

    Route::get('/estanterias', [EstanteController::class, 'mostrarEstantes'])->name('mostrarEstante');

    Route::get('/buscar-estanteria', function () {
        return view('estanteria.formularioBuscar');
    })->name('vistaBuscarEstante');

    Route::post('/buscar-estanteria', [EstanteController::class, 'buscarEstante'])->name('buscarEstante');

    Route::get('/crear-estanteria', function () {
        return view('estanteria.crearEstante');
    })->name('crearEstante');

    Route::post('/crear-estanteria', [EstanteController::class, 'crearEstante']);

    Route::get('/editar-estanteria/{id}', [EstanteController::class, 'editarEstante'])->name('editarEstante');

    Route::patch('/actualizar-estanteria/{id}', [EstanteController::class, 'actualizarEstante'])->name('actualizarEstante');

    Route::delete('/eliminar-estanteria/{id}', [EstanteController::class, 'eliminarEstante'])->name('eliminarEstante');
    
    //

    Route::get('/menu-camion', function () {
        return view('camion.camion');
    })->name('vistaCamion');

    Route::get('/camiones', [CamionController::class, 'mostrarCamiones'])->name('mostrarCamion');

    Route::get('/buscar-camion', function () {
        return view('camion.formularioBuscar');
    })->name('vistaBuscarCamion');

    Route::post('/buscar-camion', [CamionController::class, 'buscarCamion'])->name('buscarCamion');

    Route::get('/crear-camion', function () {
        return view('camion.crearCamion');
    })->name('crearCamion');

    Route::post('/crear-camion', [CamionController::class, 'crearCamion']);

    Route::get('/editar-camion/{matricula}', [CamionController::class, 'editarCamion'])->name('editarCamion');

    Route::patch('/actualizar-camion/{matricula}', [CamionController::class, 'actualizarCamion'])->name('actualizarCamion');

    Route::get('/marcar-hora', function() {
        return view('camion.formularioHora');
    })->name('formularioHora');

    Route::post('/marcar-hora', [CamionController::class,'marcarHora'])->name('marcarHora');

    Route::get('/asignar-plataforma', function(){
        return view('camion.asignarPlataforma');
    })->name('formularioAsignarPlataforma');
    
    Route::post('/asignar-plataforma', [CamionController::class,'asignarPlataforma'])->name('asignarPlataforma');

    Route::get('/asignarChofer', function(){
        return view('camion.asignarChofer');
    })->name('vistaAsignarChofer');

    Route::post('/asignarChofer', [CamionController::class, 'asignarChofer'])->name('asignarChofer');

    Route::get('/contenido-camion/{matricula}', [CamionController::class, 'contenidoCamion'])->name('contenidoCamion');

    Route::delete('/eliminar-camion/{matricula}', [CamionController::class, 'eliminarCamion'])->name('eliminarCamion');

    //

    Route::get('/menu-plataforma', function () {
        return view('almacen.plataforma.plataforma');
    })->name('vistaPlataforma');

    Route::get('/plataforma', [PlataformaController::class, 'mostrarPlataforma'])->name('mostrarPlataforma');

    Route::get('/buscar-plataforma', function () {
        return view('almacen.plataforma.formularioBuscar');
    })->name('vistaBuscarPlataforma');

    Route::post('/buscar-plataforma', [PlataformaController::class, 'buscarPlataforma'])->name('buscarPlataforma');

    Route::get('/crear-plataforma', function () {
        return view('almacen.plataforma.crearPlataforma');
    })->name('vistaCrearPlataforma');

    Route::post('/crear-plataforma', [PlataformaController::class, 'crearPlataforma'])->name('crearPlataforma');

    Route::delete('/eliminar-plataforma/{numero}', [PlataformaController::class, 'eliminarPlataforma'])->name('eliminarPlataforma');

    //

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});