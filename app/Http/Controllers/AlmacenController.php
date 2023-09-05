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
    public function buscarAlmacen($id)
    {
        $almacen = Almacen::find($id)->first();
        if (!$almacen) {
            return redirect()->route('vistaBuscarAlmacen')->with(['error' => 'Almacén no encontrado']);
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

        Almacen::create([
            'direccion' => $validatedData['direccion'],
        ]);

        session()->flash('mensaje', 'Almacen creado exitosamente');
        return redirect()->route('almacen.crearAlmacen');
    }

    public function editarAlmacen(Request $request, $id)
    {
        $almacen = Almacen::find($id)->first();

        return view('almacen.editarAlmacen', ['almacen' => $almacen]);
    }

    public function actualizarAlmacen(Request $request, $id)
    {
        $almacen = Almacen::find($id)->first();

        $validator = Validator::make($request->all(), [
            'direccion' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarAlmacen', ['direccion' => $almacen->direccion])->withErrors($validator)->withInput();
        }

        $data = $request->only(['direccion']);
        
        if ($almacen->update($data)) {
            return redirect()->route('editarAlmacen', ['direccion' => $almacen->direccion])
                ->with('success', 'Almacen actualizado exitosamente');
        } else {
            return redirect()->route('editarAlmacen', ['direccion' => $almacen->direccion])
                ->with('error', 'Hubo un problema al actualizar el Almacen');
        }
    }

    public function eliminarAlmacen($id)
    {
        $almacen = Almacen::find($id);

        if (!$almacen) {
            $mensaje = "Almacen no encontrado";
        }

        if ($almacen) {
            $almacen->deleted_at = Carbon::now();
            $mensaje = "El almacen con el id: " . $id . " ha sido eliminado exitosamente";
        }

        return view('almacen.eliminarAlmacen', compact('mensaje'));
    }
}
