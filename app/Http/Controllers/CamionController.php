<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Camion;

class CamionController extends Controller
{
    public function mostrarCamiones()
    {
        $camion = Camion::all();
        return view('camion.mostrarCamiones', ['camion' => $camion]);
    }
    public function buscarCamion(Request $request)
    {
        $matricula = $request->input('matricula');
        $camion = Camion::find($matricula);
        if (!$camion) {
            return redirect()->route('vistaBuscarCamion')->with(['mensaje' => 'Camión no encontrado']);
        }
        return view('camion.buscarCamion', ['camion' => $camion]);
    }

    public function crearCamion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricula' => 'required|string',
            'pesoMaximoKg' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        if (Camion::where('matricula', $validatedData['matricula'])->exists()) {
            return response()->json(['error' => 'La matricula del almacen ya existe'], 422);
        }

        Camion::create($validatedData);

        session()->flash('mensaje', 'Camion creado exitosamente');
        return redirect()->route('crearCamion');
    }

    public function actualizarCamion(Request $request, $matricula)
    {
        $camion = Camion::find($matricula)->first();

        $validator = Validator::make($request->all(), [
            'matricula' => 'string',
            'pesoMaximoKg' => 'numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarCamion', ['matricula' => $camion->matricula])->withErrors($validator)->withInput();
        }

        return redirect()->route('vistaBuscarCamion', ['matricula' => $camion->matricula])
            ->with('mensaje', 'Camión actualizado exitosamente');
    }

    public function editarAlmacen($matricula)
    {
        $camion = Camion::find($matricula);

        return view('camion.editarCamion', ['camion' => $camion]);
    }

    public function eliminarCamion($matricula)
    {
        $camion = Camion::find($matricula);

        $camion->deleted_at = now();
        $camion->save();

        return redirect()->route('vistaBuscarCamion')->with('mensaje', 'Camion eliminado con éxito');
    }
}