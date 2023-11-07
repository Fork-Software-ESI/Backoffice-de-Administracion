<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estante;
use App\Models\PaqueteEstante;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EstanteController extends Controller
{
    public function mostrarEstantes()
    {
        $estanteria = Estante::all();

        $datos = [];

        foreach($estanteria as $estante){
            $paquete = PaqueteEstante::where('ID_Estante', $estante->ID)->first();
            $datos[] = [
                'ID' => $estante->ID,
                'ID_Almacen' => $estante->ID_Almacen,
                'ID_Paquete' => $paquete ? $paquete->ID_Paquete : 'No tiene',
            ];
        }
        
        return view('estanteria.mostrarEstantes', ['datos' => $datos]);
    }

    public function buscarEstante(Request $request)
    {
        $id = $request->input('ID');
        $estanteria = Estante::find($id);
        if (!$estanteria) {
            return redirect()->route('vistaBuscarEstante')->with('mensaje', 'Estante no encontrado');
        }
        $paquete = PaqueteEstante::where('ID_Estante', $estanteria->ID)->first();

        $datos = [
            'ID' => $estanteria->ID,
            'ID_Almacen' => $estanteria->ID_Almacen,
            'ID_Paquete' => $paquete ? $paquete->ID_Paquete : 'No tiene',
        ];

        return view('estanteria.buscarEstanteria', ['datos' => $datos]);
    }

    public function crearEstante(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'almacen_id' => 'exists:almacenes,id|required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('estanteria.crearEstante')->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();

        Estante::create($validatedData);

        session()->flash('mensaje', 'Estante creado exitosamente');
        return redirect()->route('estanteria.crearEstante');
    }


    public function editarEstante($id)
    {
        $estanteria = Estante::find($id);

        return view('estanteria.editarEstanteria', ['estanteria' => $estanteria]);
    }

    public function actualizarEstante(Request $request, $id)
    {
        $estanteria = Estante::find($id);

        $validator = Validator::make($request->all(), [
            'almacen_id' => 'exists:almacenes,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('estanteria.editarEstante', ['id' => $estanteria->id])->withErrors($validator)->withInput();
        }

        $data = $request->only(['almacen_id']);

        if(!$estanteria->update($data)){
            return redirect()->route('vistaBuscarEstante', ['id' => $estanteria->id])
            ->with('mensaje', 'Error al actualizar Estante');
        }
        return redirect()->route('vistaBuscarEstante', ['id' => $estanteria->id])
            ->with('mensaje', 'Estante actualizada exitosamente');
    }

    public function eliminarEstante($id)
    {
        $estanteria = Estante::find($id);

        if($estanteria->deleted_at != null){
            return redirect()->route('vistaBuscarEstante')->with('mensaje', 'Estante ya eliminada');
        }

        $estanteria->deleted_at = now();
        $estanteria->save();

        return redirect()->route('vistaBuscarEstante')->with('mensaje', 'Estante eliminada con éxito');
    }
}
