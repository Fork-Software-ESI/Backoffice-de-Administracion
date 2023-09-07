<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estanteria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EstanteriaController extends Controller
{
    public function mostrarEstanteria()
    {
        $estanteria = Estanteria::all();
        return view('estanteria.mostrarEstanterias', ['estanteria' => $estanteria]);
    }

    public function buscarEstanteria(Request $request)
    {
        $id = $request->input('id');
        $estanteria = Estanteria::find($id);
        if (!$estanteria) {
            return redirect()->route('vistaBuscarEstanteria')->with(['mensaje' => 'Estanteria no encontrado']);
        }
        return view('estanteria.buscarEstanteria', ['estanteria' => $estanteria]);
    }

    public function crearEstanteria(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'almacen_id' => 'exists:almacenes,id|required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('estanteria.crearEstanteria')->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();

        Estanteria::create($validatedData);

        session()->flash('mensaje', 'Estanteria creado exitosamente');
        return redirect()->route('estanteria.crearEstanteria');
    }


    public function editarEstanteria($id)
    {
        $estanteria = Estanteria::find($id);

        return view('estanteria.editarEstanteria', ['estanteria' => $estanteria]);
    }

    public function actualizarEstanteria(Request $request, $id)
    {
        $estanteria = Estanteria::find($id);

        $validator = Validator::make($request->all(), [
            'almacen_id' => 'exists:almacenes,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('estanteria.editarEstanteria', ['id' => $estanteria->id])->withErrors($validator)->withInput();
        }

        $data = $request->only(['almacen_id']);

        if(!$estanteria->update($data)){
            return redirect()->route('vistaBuscarEstanteria', ['id' => $estanteria->id])
            ->with('mensaje', 'Error al actualizar Estanteria');
        }
        return redirect()->route('vistaBuscarEstanteria', ['id' => $estanteria->id])
            ->with('mensaje', 'Estanteria actualizada exitosamente');
    }

    public function eliminarEstanteria($id)
    {
        $estanteria = Estanteria::find($id);

        $estanteria->deleted_at = now();
        $estanteria->save();

        return redirect()->route('vistaBuscarEstanteria')->with('mensaje', 'Estanteria eliminada con éxito');
    }
}
