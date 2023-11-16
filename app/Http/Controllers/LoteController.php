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
        $lote = Lote::where('ID', $id)->withTrashed()->first();
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

        Lote::create([
            'Descripcion' => $validatedData['descripcion'],
            'ID_Estado' => 1,
        ]);

        session()->flash('mensaje', 'Lote creado exitosamente');
        return redirect()->route('crearLote');
    }
    public function editarLote($id)
    {
        $lote = Lote::where('ID', $id)->withTrashed()->first();

        if ($lote->deleted_at != null) {
            return redirect()->route('vistaBuscarLote')->with('mensaje', 'No puedes editar un lote ya eliminado');
        }

        return view('lote.editarLote', ['lote' => $lote]);
    }

    public function actualizarLote(Request $request, $id)
    {
        $lote = Lote::where('ID', $id)->withTrashed()->first();

        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarLote', ['id' => $lote->ID])->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $lote->update([
            'Descripcion' => $validatedData['descripcion'],
        ]);

        return redirect()->route('vistaBuscarLote', ['id' => $lote->ID])
            ->with('mensaje', 'Lote actualizado exitosamente');
    }

    public function eliminarlote($id)
    {
        $lote = Lote::where('ID', $id)->withTrashed()->first();

        if ($lote->deleted_at != null) {
            return redirect()->route('vistaBuscarLote')->with('mensaje', 'No puedes eliminar un lote ya eliminado');
        }

        $lote->deleted_at = now();
        $lote->save();

        return redirect()->route('vistaBuscarLote')->with('mensaje', 'Lote eliminado con éxito');
    }
}
