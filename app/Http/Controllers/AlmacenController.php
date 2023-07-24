<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    public function index()
    {
        $almacenes= Almacen::getAlmacenes();
        return response()->json($almacenes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id'=> 'required|int',
            'direccion'=> 'required|string',
        ]);

        $almacen = Almacen::create($request->all());
        return response()->json($almacen, 201);
    }

}
