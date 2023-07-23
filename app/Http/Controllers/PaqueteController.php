<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;

class PaqueteController extends Controller
{
    public function getPaquete()
    {
        $paquetes = Paquete::all();
        return response()->json($paquetes);
    }

    public function crearPaquete()
    {
        return view('paquete.create');
    }
    public function guardarPaquetes(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'description' => 'required',
            'peso_kg' => 'required',
            'lote_id' => 'required|exists:lots,id',
        ]);
        $paquete = Paquete::createPaquete($request->all());
        return response()->json($paquete, 201);
    }

    public function infoPaquete(Paquete $package)
    {
        return view('paquete.infoPaquete', compact('package'));
    }

    public function editarPaquete(Paquete $package)
    {
        return view('paquete.editarPaquete', compact('package'));
    }

    public function actualizarPaquete(Request $request, Paquete $package)
    {
        $request->validate([
            'id' => 'required',
            'description' => 'required',
            'peso_kg' => 'required',
            'lot_id' => 'required|exists:lots,id',
        ]);
        $package->update($request->all());
        return response()->json($package, 201);
    }

    public function eliminarPaquete(Paquete $package)
    {
        $package->delete();
        return response()->json(['message' => 'Paquete eliminado exitosamente.'], 200);
    }
}
