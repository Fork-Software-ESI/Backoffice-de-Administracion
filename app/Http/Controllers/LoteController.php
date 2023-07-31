<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;
use Illuminate\Support\Facades\Validator;

class LoteController extends Controller
{
    //
    public function mostrarVistaPrincipalLote(){
        return view('lote/lote');
    }
    public function mostrarVistaCrearLote()
    {
        return view('lote/crearLote');
    }
    public function mostrarVistaBuscarLote(){
        return view('lote/buscarLote');
    }

    public function mostrarLotes()
    {
        $lote = Lote::all();
        return view('lote.mostrarLotes', ['lote' => $lote]);
    }

    public function buscarLote(Request $request)
    {
        $descripcion = $request->input('$descripcion');
        $lote = Lote::where('$descripcion', $descripcion)->first();
        if (!$lote) {
            return view('lote.buscarLote', ['error' => 'Lote no encontrado']);
        }
        return view('lote.buscarLote', ['lote' => $lote]);
    }

    public function crearLote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '$descripcion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        if (Lote::where('$descripcion', $validatedData['$descripcion'])->exists()) {
            return response()->json(['error' => 'La $descripcion de el lote ya está en uso'], 422);
        }

        Lote::create([
            '$descripcion' => $validatedData['$descripcion'],
        ]);

        session()->flash('mensaje', 'Lote creado exitosamente');
        return redirect()->route('lote.crearLote');
    }
    public function editarLote(Request $request, $descripcion)
    {
        $lote = Lote::where('descripcion', $descripcion)->first();

        if (!$lote) {
            return response()->json(['error' => 'Almacén no encontrado'], 404);
        }

        if ($request->isMethod('patch')) {
            $validator = Validator::make($request->all(), [
                'descripcion' => 'string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->route('lote.editarLote', ['descripcion' => $lote->descripcion])->withErrors($validator)->withInput();
            }

            $data = $request->only(['descripcion']);

            $lote->update($data);

            return redirect()->route('lote.editarlote', ['descripcion' => $lote->descripcion])
                ->with('success', 'Lote actualizado exitosamente');
        }

        return view('lote.editarLote', ['lote' => $lote]);
    }

    public function eliminarlote(Request $request)
    {
        $descripcion = $request->input('descripcion');
        $lote = Lote::where('descripcion', $descripcion)->first();

        if (!$lote) {
            $mensaje = "Lote no encontrado";
        }
        if($lote){
            $lote->delete();
            $mensaje = "El lote con la descripcion: " . $descripcion . " ha sido eliminada exitosamente";
        }
        
        return view('lote.eliminarLote', compact('mensaje'));
    }
}
