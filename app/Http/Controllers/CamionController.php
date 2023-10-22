<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Camion;
use App\Models\ChoferCamion;
use App\Models\Chofer;
use App\Models\Persona;

class CamionController extends Controller
{
    public function mostrarCamiones()
    {
        $camion = Camion::all();
        
        $data = [];
        foreach ($camion as $camiones) {

            $choferCamion = ChoferCamion::where('ID_Camion', $camiones->ID)->first();
            $nombre = $choferCamion ? Persona::find($choferCamion->ID_Chofer)->Nombre : 'No tiene';
            
            $data[] = [
                'id' => $camiones->ID,
                'matricula' => $camiones->Matricula,
                'pesoMaximoKg' => $camiones->PesoMaximoKg,
                'chofer' => $nombre,
                'created_at' => $camiones->created_at,
                'updated_at' => $camiones->updated_at,
                'deleted_at' => $camiones->deleted_at,
            ];
        }
        
        return view('camion.mostrarCamiones', ['datos' => $data] , ['camion' => $camion]);
    }
    public function buscarCamion(Request $request)
    {
        $matricula = $request->input('matricula');
        $camion = Camion::where('Matricula', $matricula)->first();
        if (!$camion) {
            return redirect()->route('vistaBuscarCamion')->with(['mensaje' => 'Camión no encontrado']);
        }
        return view('camion.buscarCamion', ['camion' => $camion]);
    }

    public function crearCamion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricula' => 'required|string|unique:camion|regex:/^[A-Za-z]{3}[0-9]{4}$/',
            'pesoMaximoKg' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('crearCamion')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if (Camion::where('matricula', $validatedData['matricula'])->exists()) {
            return redirect()->route('crearCamion')->with('mensaje', 'La matricula del camión ya existe');
        }

        $camion = Camion::create([
            'Matricula' => $validatedData['matricula'],
            'PesoMaximoKg' => $validatedData['pesoMaximoKg'],
        ]);
        $camion -> save();
        session()->flash('mensaje', 'Camion creado exitosamente');
        return redirect()->route('crearCamion');
    }
    
    public function editarCamion($matricula)
    {
        $camion = Camion::where('matricula', $matricula)->first();

        if ($camion->deleted_at != null) {
            return redirect()->route('vistaBuscarCamion')->with('mensaje', 'No puedes modificar un camión eliminado');
        }

        return view('camion.editarCamion', ['camion' => $camion]);
    }

    public function actualizarCamion(Request $request, $matricula)
    {
        $camion = Camion::where('matricula', $matricula)->first();

        $validator = Validator::make($request->all(), [
            'matricula' => 'string|regex:/^[A-Za-z]{3}[0-9]{4}$/',
            'pesoMaximoKg' => 'numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarCamion', ['matricula' => $camion->Matricula])->withErrors($validator)->withInput();
        }

        $data = $request->only(['matricula', 'pesoMaximoKg']);

        if ($data['matricula'] != $camion->Matricula) {
            if (Camion::where('matricula', $data['matricula'])->exists()) {
                return redirect()->route('editarCamion', ['matricula' => $camion->Matricula])->with('mensaje', 'La matricula del camión ya existe');
            }
        }

        $camion -> update([
            'Matricula' => $data['matricula'],
            'PesoMaximoKg' => $data['pesoMaximoKg'],
        ]);

        return redirect()->route('vistaBuscarCamion', ['matricula' => $camion->Matricula])
            ->with('mensaje', 'Camión actualizado exitosamente');
    }
    public function eliminarCamion($matricula)
    {
        $camion = Camion::where('Matricula', $matricula)->first();
        if($camion -> deleted_at != null){
            return redirect()->route('vistaBuscarCamion')->with('mensaje', 'No puedes eliminar un camión eliminado');
        }

        $camion->deleted_at = now();
        $camion->save();

        return redirect()->route('vistaBuscarCamion')->with('mensaje', 'Camion eliminado con éxito');
    }
}