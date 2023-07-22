<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrayectoriaController extends Controller
{
    //
    public function index()
    {
        // Obtener la lista de trayectorias desde el modelo (simulando la consulta a la base de datos)
        $trayectorias = Trayectoria::getTrayectorias();
        return response()->json($trayectorias);
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario (puedes agregar más validaciones según tus necesidades)
        $request->validate([
            'lote_id' => 'required|numeric',
            'origen' => 'required|string',
            'destino' => 'required|string',
            'estado' => 'required|string',
        ]);

        // Crear una nueva trayectoria en la "base de datos" (en este caso, simulado con una matriz estática)
        $trayectoria = Trayectoria::createTrayectoria($request->all());
        return response()->json($trayectoria, 201);
    }
}
