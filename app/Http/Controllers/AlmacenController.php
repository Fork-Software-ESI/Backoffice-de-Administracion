<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AlmacenController extends Controller
{
    public function mostrarAlmacenes()
    {
        $almacen = Almacen::all();
        return view('almacen.mostrarAlmacenes', ['almacen' => $almacen]);
    }
    public function buscarAlmacen(Request $request)
    {
        $id = $request->input('id');
        $almacen = Almacen::find($id);
        if (!$almacen) {
            return redirect()->route('vistaBuscarAlmacen')->with(['mensaje' => 'Almacén no encontrado']);
        }
        return view('almacen.buscarAlmacen', ['almacen' => $almacen]);
    }

    public function crearAlmacen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'direccion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        if (Almacen::where('direccion', $validatedData['direccion'])->exists()) {
            return response()->json(['error' => 'La direccion de el almacen ya está en uso'], 422);
        }

        Almacen::create($validatedData);

        session()->flash('mensaje', 'Almacen creado exitosamente');
        return redirect()->route('crearAlmacen');
    }

    public function editarAlmacen($id)
    {
        $almacen = Almacen::find($id);

        return view('almacen.editarAlmacen', ['almacen' => $almacen]);
    }

    public function actualizarAlmacen(Request $request, $id)
    {
        $almacen = Almacen::find($id)->first();

        $validator = Validator::make($request->all(), [
            'direccion' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarAlmacen', ['id' => $almacen->id])->withErrors($validator)->withInput();
        }

        $data = $request->only(['direccion']);
        
        if (!$almacen->update($data)) {
            return redirect()->route('vistaBuscarAlmacen', ['id' => $almacen->id])
                ->with('mensaje', 'Hubo un problema al actualizar el Almacen');
        }
        return redirect()->route('vistaBuscarAlmacen', ['id' => $almacen->id])
                ->with('mensaje', 'Almacen actualizado exitosamente');
    }

    public function eliminarAlmacen($id)
    {
        $almacen = Almacen::find($id);

        if (!$almacen) {
            return redirect()->route('vistaBuscarAlmacen')->with('mensaje', 'Almacen no encontrado');
        }

        $almacen->deleted_at = now();
        $almacen->save();

        return redirect()->route('vistaBuscarAlmacen')->with('mensaje', 'Almacen eliminado con éxito');
    }
}
