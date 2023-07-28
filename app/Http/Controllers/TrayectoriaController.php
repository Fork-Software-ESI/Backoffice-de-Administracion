<?php

namespace App\Http\Controllers;

use App\Models\Trayectoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrayectoriaController extends Controller
{
    //
    public function mostrarTrayectorias()
    {
        $trayectorias = Trayectoria::all();
        return response()->json($trayectorias);
    }

    public function crearTrayectoria(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'lote_id' => 'required|numeric',
            'origen' => 'required|string',
            'destino' => 'required|string',
            'estado' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $trayectoria = Trayectoria::createTrayectoria($request->all());
        return response()->json($trayectoria, 201);
    }

    public function editarTrayectoria(Request $request, $id)
    {
        $trayectoria = Trayectoria::find($id);

        if (!$trayectoria) {
            return response()->json(['error' => 'Trayectoria no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'lote_id' => 'required|numeric',
            'origen' => 'required|string',
            'destino' => 'required|string',
            'estado' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $trayectoria->update($request->all());
        return response()->json($trayectoria);
    }

    public function eliminarTrayectoria($id)
    {
        $trayectoria = Trayectoria::find($id);

        if (!$trayectoria) {
            return response()->json(['error' => 'Trayectoria no encontrada'], 404);
        }

        $trayectoria->delete();
        return response()->json(['message' => 'Trayectoria eliminada exitosamente.'], 200);
    }
}
