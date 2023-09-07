<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class LoteController extends Controller
{
    public function mostrarLotes()
    {
        $lote = Lote::all();
        return view('lote.mostrarLotes', ['lote' => $lote]);
    }

    public function buscarLote(Request $request)
    {
        $id = $request->input('id');
        $lote = Lote::find($id);
        if (!$lote) {
            return redirect()->route('vistaBuscarLote')->with(['mensaje' => 'Lote no encontrado']);
        }
        return view('lote.buscarLote', ['lote' => $lote]);
    }

    public function crearLote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        if (Lote::where('descripcion', $validatedData['descripcion'])->exists()) {
            return response()->json(['error' => 'La descripcion de el lote ya está en uso'], 422);
        }

        Lote::create($validatedData);

        session()->flash('mensaje', 'Lote creado exitosamente');
        return redirect()->route('crearLote');
    }
    public function editarLote($id)
    {
        $lote = Lote::find($id);

        return view('lote.editarLote', ['lote' => $lote]);
    }

    public function actualizarLote(Request $request, $id)
    {
        $lote = Lote::find($id);

        $validator = Validator::make($request->all(), [
            'descripcion' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarLote', ['id' => $lote->id])->withErrors($validator)->withInput();
        }

        $data = $request->only(['descripcion']);

        if(!$lote->update($data)){
            return redirect()->route('vistaBuscarLote', ['id' => $lote->id])
            ->with('mensaje', 'Error al actualizar Lote');
        }
        return redirect()->route('vistaBuscarLote', ['id' => $lote->id])
            ->with('mensaje', 'Lote actualizado exitosamente');
    }

    public function eliminarlote($id)
    {
        $lote = Lote::find($id);

        $lote->deleted_at = now();
        $lote->save();

        return redirect()->route('vistaBuscarLote')->with('mensaje', 'Lote eliminado con éxito');
    }
}
