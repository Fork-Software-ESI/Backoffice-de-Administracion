<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camion;


class CamionController extends Controller
{
    public function mostrarCamiones()
    {
        $camiones = Camion::all();
        return response()->json($camiones);
    }

    public function crearCamion(Request $request)
    {
        $request->validate([
            'matricula' => 'required|string',
            'capacidad_carga' => 'required|numeric',
        ]);

        $camion = Camion::createCamion($request->all());
        
        if ($camion === null) {
            return response()->json(['error' => 'Ya existe un camión con la misma matrícula'], 400);
        }
        return response()->json($camion, 201);
    }
}
