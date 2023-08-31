<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estanteria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EstanteriaController extends Controller
{
    public function mostrarVistaPrincipalEstanteria()
    {
        return view('estanteria/estanteria');
    }

    public function mostrarVistaCrearEstanteria()
    {
        return view('estanteria/crearEstanteria');
    }

    public function mostrarVistaBuscarEstanteria()
    {
        return view('estanteria/buscarEstanteria');
    }

    public function mostrarEstanteria()
    {
        $estanteria = Estanteria::all();
        return view('estanteria.mostrarEstanterias', ['estanteria' => $estanteria]);
    }

    public function buscarEstanteria($id)
    {
        $estanteria = Estanteria::find($id);
        if (!$estanteria) {
            return view('estanteria.buscarEstanteria', ['error' => 'Estanteria  no encontrada']);
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


    public function editarEstanteria(Request $request, $id)
    {
        $estanteria = Estanteria::find($id)->first();

        if (!$estanteria) {
            return response()->json(['error' => 'Estanteria no encontrada'], 404);
        }

        if ($request->isMethod('patch')) {
            $validator = Validator::make($request->all(), [
                'almacen_id' => 'exists:almacenes,id',
            ]);

            if ($validator->fails()) {
                return redirect()->route('estanteria.editarEstanteria', ['id' => $estanteria->id])->withErrors($validator)->withInput();
            }

            $data = $request->only(['almacen_id']);

            $estanteria->update($data);

            return redirect()->route('estanteria.editarPaquete', ['id' => $estanteria->id])
                ->with('success', 'Estanteria actualizada exitosamente');
        }

        return view('estanteria.editarEstanteria', ['estanteria' => $estanteria]);
    }

    public function eliminarEstanteria(Request $request, $id)
    {
        $estanteria = Estanteria::find($id)->first();

        if (!$estanteria) {
            $mensaje = "Estanteria no encontrada";
        }

        if ($estanteria) {
            $estanteria->deleted_at = Carbon::now();
            $mensaje = "La estanteria con la id: " . $id . " ha sido eliminada exitosamente";
        }

        return view('estanteria.eliminarEstanteria', compact('mensaje', 'estanteria'));
    }
}
