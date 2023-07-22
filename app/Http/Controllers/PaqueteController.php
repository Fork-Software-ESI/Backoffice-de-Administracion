<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;

class PaqueteController extends Controller
{
    public function getPaquete()
    {
        $paquetes = Paquete::all();
        return view('paquete.getPaquete', compact('package'));
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
            'lot_id' => 'required|exists:lots,id',
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
        // Aquí puedes pasar información adicional al formulario, si es necesario
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
        return redirect()->route('paquete.getPaquete')->with('success', 'Paquete eliminado exitosamente.');
    }
}
