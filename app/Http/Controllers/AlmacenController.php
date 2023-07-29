<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class AlmacenController extends Controller
{
    public function mostrarVistaPrincipalAlmacen(){
        return view('almacen/almacen');
    }
    public function mostrarAlmacenes()
    {
        $almacenes= Almacen::all();
        return response()->json($almacenes);
    }

    public function crearAlmacen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
            'direccion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $almacen = Almacen::create($request->all());
        return response()->json($almacen, 201);
    }

    public function editarAlmacen(Request $request, $id)
    {
        $almacen = Almacen::find($id);

        if (!$almacen) {
            return response()->json(['error' => 'Almacén no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
            'direccion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $almacen->update($request->all());
        return response()->json($almacen);
    }

    public function eliminarAlmacen($id)
    {
        $almacen = Almacen::find($id);

        if (!$almacen) {
            return response()->json(['error' => 'Almacén no encontrado'], 404);
        }

        $almacen->delete();
        return response()->json(['message' => 'Almacén eliminado exitosamente.'], 200);
    }
}
