<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;

class LoteController extends Controller
{
    //
    public function index()
    {
        $lotes = Lote::all();
        return response()->json($lotes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|int',
            'descripcion' => 'required|string',
        ]);

        $lote = Lote::createLote($request->all());
        return response()->json($lote, 201);
    }
}
