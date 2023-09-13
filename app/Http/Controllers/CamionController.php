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
        $id = $request->input('id');
        $camion = Camion::find($id);
        if (!$camion) {
            return redirect()->route('vistaBuscarCamion')->with(['mensaje' => 'Camión no encontrado']);
        }
        return view('camion.buscarCamion', ['camion' => $camion]);
    }

    public function crearCamion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricula' => 'required|string|unique:camiones|regex:/^[A-Za-z]{3}[0-9]{4}$/',
            'pesoMaximoKg' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('crearCamion')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if (Camion::where('matricula', $validatedData['matricula'])->exists()) {
            return redirect()->route('crearCamion')->with('mensaje', 'La matricula del camión ya existe');
        }

        Camion::create($validatedData);

        session()->flash('mensaje', 'Camion creado exitosamente');
        return redirect()->route('crearCamion');
    }

    public function actualizarCamion(Request $request, $matricula)
    {
        $camion = Camion::where('matricula', $matricula)->first();


        $validator = Validator::make($request->all(), [
            'matricula' => 'string|unique:camiones|regex:/^[A-Za-z]{3}[0-9]{4}$/',
            'pesoMaximoKg' => 'numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarCamion', ['id' => $camion->id])->withErrors($validator)->withInput();
        }

        return redirect()->route('vistaBuscarCamion', ['id' => $camion->id])
            ->with('mensaje', 'Camión actualizado exitosamente');
    }

    public function editarCamion($matricula)
    {
        $camion = Camion::where('matricula', $matricula)->first();

        if ($camion->deleted_at != null) {
            return redirect()->route('vistaBuscarCamion')->with('mensaje', 'No puedes modificar un camión eliminado');
        }

        return view('camion.editarCamion', ['camion' => $camion]);
    }

    public function eliminarCamion($id)
    {
        $camion = Camion::find($id);

        $camion->deleted_at = now();
        $camion->save();

        return redirect()->route('vistaBuscarCamion')->with('mensaje', 'Camion eliminado con éxito');
    }
}