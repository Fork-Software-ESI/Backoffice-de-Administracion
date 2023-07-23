<?php

namespace App\Http\Controllers;

use App\Models\Trayectoria;
use Illuminate\Http\Request;

class TrayectoriaController extends Controller
{
    //
    public function index()
    {
        $trayectorias = Trayectoria::getTrayectorias();
        return response()->json($trayectorias);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lote_id' => 'required|numeric',
            'origen' => 'required|string',
            'destino' => 'required|string',
            'estado' => 'required|string',
        ]);
        $trayectoria = Trayectoria::createTrayectoria($request->all());
        return response()->json($trayectoria, 201);
    }
}
