<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class PaqueteController extends Controller
{
    public function mostrarVistaPrincipalPaquete()
    {
        return view('paquete/paquete');
    }
    public function mostrarVistaCrearPaquete()
    {
        return view('paquete/crearPaquete');
    }
    public function mostrarVistaBuscarPaquete()
    {
        return view('paquete/buscarPaquete');
    }
    public function mostrarPaquetes()
    {
        $paquete = Paquete::all();
        return view('paquete.mostrarPaquetes', ['paquete' => $paquete]);
    }
    public function buscarPaquete($id)
    {
        $paquete = Paquete::find($id);
        if (!$paquete) {
            return view('paquete.buscarPaquete', ['error' => 'Paquete no encontrado']);
        }
        return view('paquete.buscarPaquete', ['paquete' => $paquete]);
    }
    public function crearPaquete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string',
            'peso_kg' => 'required',
            'lote_id' => 'nullable|exists:lotes,id',
            'estanteria_id' => 'nullable|exists:estanterias,id',
        ]);
        if ($validator->fails()) {
            return redirect()->route('paquete.crearPaquete')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        Paquete::create($validatedData);

        session()->flash('mensaje', 'Paquete creado exitosamente');
        return redirect()->route('paquete.crearPaquete');
    }

    public function editarPaquete(Request $request, $id)
    {
        $paquete = Paquete::find($id);

        if (!$paquete) {
            return response()->json(['error' => 'Paquete no encontrado'], 404);
        }

        if ($request->isMethod('patch')) {
            $validator = Validator::make($request->all(), [
                'descripcion' => 'string',
                'peso_kg' => 'numeric',
                'lote_id' => 'exists:lotes,id',
            ]);

            if ($validator->fails()) {
                return redirect()->route('paquete.editarPaquete', ['id' => $paquete->id])->withErrors($validator)->withInput();
            }

            $data = $request->only(['descripcion', 'peso_kg', 'lote_id']);

            $paquete->update($data);

            return redirect()->route('paquete.editarPaquete', ['id' => $paquete->id])
                ->with('success', 'Paquete actualizado exitosamente');
        }

        return view('paquete.editarPaquete', ['paquete' => $paquete]);
    }

    public function eliminarPaquete($id)
    {
        $paquete = Paquete::find($id);

        if (!$paquete) {
            $mensaje = "Paquete no encontrado";
        }

        if ($paquete) {
            $paquete->deleted_at = Carbon::now();
            $mensaje = "El paquete con la id: " . $id . " ha sido eliminado exitosamente";
        }

        return view('paquete.eliminarPaquete', compact('mensaje', 'paquete'));
    }
}
