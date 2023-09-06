<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class PaqueteController extends Controller
{
    public function mostrarPaquetes()
    {
        $paquete = Paquete::all();
        return view('paquete.mostrarPaquetes', ['paquete' => $paquete]);
    }
    public function buscarPaquete(Request $request)
    {
        $id = $request->input('id');
        $paquete = Paquete::find($id);
        if (!$paquete) {
            return redirect()->route('vistaBuscarPaquete')->with(['mensaje' => 'Almacén no encontrado']);
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
            return redirect()->route('crearPaquete')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        Paquete::create($validatedData);

        session()->flash('mensaje', 'Paquete creado exitosamente');
        return redirect()->route('crearPaquete');
    }

    public function editarPaquete($id)
    {
        $paquete = Paquete::find($id);

        return view('paquete.editarPaquete', ['paquete' => $paquete]);
    }


    public function actualizarPaquete(Request $request, $id)
    {
        $paquete = Paquete::find($id);

        $validator = Validator::make($request->all(), [
            'descripcion' => 'string',
            'peso_kg' => 'numeric',
            'lote_id' => 'exists:lotes,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarPaquete', ['id' => $paquete->id])->withErrors($validator)->withInput();
        }

        $data = $request->only(['descripcion', 'peso_kg']);

        if (!$paquete->update($data)) {
            return redirect()->route('vistaBuscarAlmacen', ['id' => $paquete->id])
                ->with('mensaje', 'Hubo un problema al actualizar el Almacen');
        }
        return redirect()->route('vistaBuscarPaquete', ['id' => $paquete->id])
        ->with('mensaje', 'Paquete actualizado exitosamente');
    }
    

    public function eliminarPaquete($id)
    {
        $paquete = Paquete::find($id);

        $paquete->deleted_at = now();
        $paquete->save();

        return redirect()->route('vistaBuscarPaquete')->with('mensaje', 'Paquete eliminado con éxito');
    }
}
