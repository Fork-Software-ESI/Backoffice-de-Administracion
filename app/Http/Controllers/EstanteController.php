<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estante;
use App\Models\PaqueteEstante;
use App\Models\Almacen;
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
            'ID_Almacen' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('estanteria.crearEstante')->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();

        $almacen = Almacen::find($validatedData['ID_Almacen']);
        if(!$almacen){
            return redirect()->route('estanteria.crearEstante')->withErrors(['ID_Almacen' => 'No existe el almacen'])->withInput();
        }

        Estante::create($validatedData);

        return redirect()->route('crearEstante')->with('mensaje', 'Estante creado exitosamente');
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
            'ID_Almacen' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarEstante', ['id' => $estanteria->ID])->withErrors($validator)->withInput();
        }

        $data = $request->only(['ID_Almacen']);

        $estanteria->update([
            'ID_Almacen' => $data['ID_Almacen'],
        ]);

        return redirect()->route('vistaBuscarEstante')->with('mensaje','Estante actualizada con éxito');
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