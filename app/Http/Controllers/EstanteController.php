<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estante;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EstanteController extends Controller
{
    public function mostrarEstantes()
    {
        $estanteria = Estante::all();
        return view('estanteria.mostrarEstantes', ['estanteria' => $estanteria]);
    }

    public function buscarEstante(Request $request)
    {
        $id = $request->input('id');
        $estanteria = Estante::find($id);
        if (!$estanteria) {
            return redirect()->route('vistaBuscarEstante')->with(['mensaje' => 'Estante no encontrado']);
        }
        return view('estanteria.buscarEstante', ['estanteria' => $estanteria]);
    }

    public function crearEstante(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'almacen_id' => 'exists:almacenes,id|required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('estanteria.crearEstante')->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();

        Estante::create($validatedData);

        session()->flash('mensaje', 'Estante creado exitosamente');
        return redirect()->route('estanteria.crearEstante');
    }


    public function editarEstante($id)
    {
        $estanteria = Estante::find($id);

        return view('estanteria.editarEstante', ['estanteria' => $estanteria]);
    }

    public function actualizarEstante(Request $request, $id)
    {
        $estanteria = Estante::find($id);

        $validator = Validator::make($request->all(), [
            'almacen_id' => 'exists:almacenes,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('estanteria.editarEstante', ['id' => $estanteria->id])->withErrors($validator)->withInput();
        }

        $data = $request->only(['almacen_id']);

        if(!$estanteria->update($data)){
            return redirect()->route('vistaBuscarEstante', ['id' => $estanteria->id])
            ->with('mensaje', 'Error al actualizar Estante');
        }
        return redirect()->route('vistaBuscarEstante', ['id' => $estanteria->id])
            ->with('mensaje', 'Estante actualizada exitosamente');
    }

    public function eliminarEstante($id)
    {
        $estanteria = Estante::find($id);

        $estanteria->deleted_at = now();
        $estanteria->save();

        return redirect()->route('vistaBuscarEstante')->with('mensaje', 'Estante eliminada con éxito');
    }
}
