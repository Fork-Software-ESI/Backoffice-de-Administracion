<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use Illuminate\Support\Facades\Validator;

class PaqueteController extends Controller
{
    public function mostrarVistaPrincipalPaquete(){
        return view('paquete/paquete');
    }
    public function mostrarPaquetes()
    {
        $paquete = Paquete::all();
        return response()->json($paquete);
    }

    public function crearPaquete(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'peso_kg' => 'required',
            'lote_id' => 'exists:lotes,id',
        ]);
        $paquete = Paquete::create($request->all());
        return response()->json($paquete, 201);
    }


    public function infoPaquete(Request $request, $id)
    {
        $paquete = Paquete::find($id);

        if (!$paquete) {
            return response()->json(['error' => 'Paquete no encontrado'], 404);
        }

        return response()->json($paquete);
    }

    public function editarPaquete(Request $request, $id)
    {
        $paquete = Paquete::find($id);

        if (!$paquete) {
            return response()->json(['error' => 'Paquete no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'peso_kg' => 'required|numeric|min:0',
            'descripcion' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $paquete->update([
            'peso_kg' => $request->input('peso_kg'),
            'descripcion' => $request->input('descripcion'),
        ]);

        return response()->json($paquete);
    }

    public function eliminarPaquete($id)
    {
        $paquete = Paquete::find($id);

        if (!$paquete) {
            return response()->json(['error' => 'Paquete no encontrado'], 404);
        }

        $paquete->delete();

        return response()->json(['message' => 'Paquete eliminado exitosamente.'], 200);
    }
}
