<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lote;

class LoteController extends Controller
{
    //
    public function index()
    {
        // Obtener la lista de lotes desde el modelo (simulando la consulta a la base de datos)
        $lotes = Lote::getLotes();
        return response()->json($lotes);
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario (puedes agregar más validaciones según tus necesidades)
        $request->validate([
            'id' => 'required|int',
            'descripcion' => 'required|string',
        ]);

        // Crear un nuevo lote en la "base de datos" (en este caso, simulado con una matriz estática)
        $lote = Lote::createLote($request->all());
        return response()->json($lote, 201);
    }
}
