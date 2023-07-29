<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;

class LoteController extends Controller
{
    //
    public function mostrarVistaPrincipalLote(){
        return view('lote/lote');
    }
    public function mostrarLotes()
    {
        $lotes = Lote::all();
        return response()->json($lotes);
    }

    public function crearLote(Request $request)
    {
        $request->validate([
            'id' => 'required|int',
            'descripcion' => 'required|string',
        ]);

        $lote = Lote::createLote($request->all());
        return response()->json($lote, 201);
    }
}
