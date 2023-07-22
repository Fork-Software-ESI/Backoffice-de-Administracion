<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camion;

class CamionController extends Controller
{
    public function index()
    {
        $camiones = Camion::getCamiones();
        return response()->json($camiones);
    }

    public function store(Request $request)
    {
        $request->validate([                                    // Validar los datos del formulario (puedes agregar más validaciones según tus necesidades)
            'matricula' => 'required|string',
            'modelo' => 'required|string',
            'capacidad_carga' => 'required|numeric',
        ]);

        $camion = Camion::createCamion($request->all());        // Crear un nuevo camión en la "base de datos" (en este caso, simulado con una matriz estática)
        
        if ($camion === null) {
            return response()->json(['error' => 'Ya existe un camión con la misma matrícula'], 400);
        }
        return response()->json($camion, 201);
    }
}
