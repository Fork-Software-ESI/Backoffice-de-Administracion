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
    public function mostrarVistaCrearAlmacen()
    {
        return view('almacen/crearAlmacen');
    }
    public function mostrarVistaBuscarAlmacen(){
        return view('almacen/buscarAlmacen');
    }
    
    public function mostrarAlmacenes()
    {
        $almacen= Almacen::all();
        return view('almacen.mostrarAlmacenes', ['almacen' => $almacen]);
    }
    public function buscarAlmacen($id)
    {
        $almacen = Almacen::find($id);
        if (!$almacen) {
            return view('almacen.buscarAlmacen', ['error' => 'Almacen no encontrado']);
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
        $almacen = Almacen::find($id);

        if (!$almacen) {
            return response()->json(['error' => 'Almacén no encontrado'], 404);
        }

        if ($request->isMethod('patch')) {
            $validator = Validator::make($request->all(), [
                'direccion' => 'string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->route('almacen.editarAlmacen', ['direccion' => $almacen->direccion])->withErrors($validator)->withInput();
            }

            $data = $request->only(['direccion']);

            $almacen->update($data);

            return redirect()->route('almacen.editarAlmacen', ['id' => $almacen->id])
                ->with('success', 'Almacén actualizado exitosamente');
        }

        return view('almacen.editarAlmacen', ['almacen' => $almacen]);
    }

    public function eliminarAlmacen($id)
    {
        $almacen = Almacen::find($id);

        if (!$almacen) {
            $mensaje = "Almacen no encontrado";
        }
        if($almacen){
            $almacen->delete();
            $mensaje = "El almacen con el id: " . $id . " ha sido eliminado exitosamente";
        }
        
        return view('almacen.eliminarAlmacen', compact('mensaje'));
    }
}
