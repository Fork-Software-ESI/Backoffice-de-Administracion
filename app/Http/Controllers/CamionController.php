<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plataforma;
use App\Models\CamionPlataforma;
use App\Models\CamionPlataformaSalida;
use App\Models\Camion;
use App\Models\ChoferCamion;

class CamionController extends Controller
{
    public function mostrarCamiones()
    {
        $camion = Camion::all();
        return view('camion.mostrarCamiones', ['camion' => $camion]);
    }
    public function buscarCamion(Request $request)
    {
        $id = $request->input('id');
        $camion = Camion::find($id);
        if (!$camion) {
            return redirect()->route('vistaBuscarCamion')->with(['mensaje' => 'Camión no encontrado']);
        }
        return view('camion.buscarCamion', ['camion' => $camion]);
    }

    public function crearCamion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricula' => 'required|string|unique:camiones|regex:/^[A-Za-z]{3}[0-9]{4}$/',
            'pesoMaximoKg' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('crearCamion')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if (Camion::where('matricula', $validatedData['matricula'])->exists()) {
            return redirect()->route('crearCamion')->with('mensaje', 'La matricula del camión ya existe');
        }

        Camion::create($validatedData);

        session()->flash('mensaje', 'Camion creado exitosamente');
        return redirect()->route('crearCamion');
    }

    public function actualizarCamion(Request $request, $matricula)
    {
        $camion = Camion::where('matricula', $matricula)->first();


        $validator = Validator::make($request->all(), [
            'matricula' => 'string|unique:camiones|regex:/^[A-Za-z]{3}[0-9]{4}$/',
            'pesoMaximoKg' => 'numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarCamion', ['id' => $camion->id])->withErrors($validator)->withInput();
        }

        return redirect()->route('vistaBuscarCamion', ['id' => $camion->id])
            ->with('mensaje', 'Camión actualizado exitosamente');
    }

    public function editarCamion($matricula)
    {
        $camion = Camion::where('matricula', $matricula)->first();

        if ($camion->deleted_at != null) {
            return redirect()->route('vistaBuscarCamion')->with('mensaje', 'No puedes modificar un camión eliminado');
        }

        return view('camion.editarCamion', ['camion' => $camion]);
    }

    public function marcarHora(Request $request)
    {
        $matricula = $request->input('matricula');
        $hora = $request->input('hora');

        $camion = Camion::where('Matricula', $matricula)->first();
        if (!$camion) {
            return redirect()->route('formularioHora')->with('mensaje', 'Camión no encontrado');
        }

        $camionPlataforma = CamionPlataforma::where('ID_Camion', $camion->ID)->first();

        if (!$camionPlataforma) {
            return redirect()->route('formularioHora')->with('mensaje', 'El camión no tiene una plataforma asignada');
        }

        $camionPlataformaSalida = CamionPlataformaSalida::where('ID_Camion', $camion->ID)->first();

        if($hora == 'llegada'){
            if ($camionPlataforma->Fecha_Hora_Llegada !== null) {
                return redirect()->route('formularioHora')->with('mensaje', 'El camión ya ha llegado');
            }

            CamionPlataforma::where('ID_Camion', $camion->ID)->update(['Fecha_Hora_Llegada' => now()]);

            $estadoc = ChoferCamion::where('ID_Camion', $camion->ID)->first();
            $estadoc ->update([
                'ID_Estado' => 2,
            ]);

            return redirect()->route('formularioHora')->with('mensaje','Se ha marcado la hora exitosamente');
        }
        
        if($camionPlataformaSalida->Fecha_Hora_Salida != null){
            return redirect()->route('formularioHora')->with('mensaje', 'El camión ya ha salido');
        }
        CamionPlataformaSalida::where('ID_Camion', $camion->ID)->update(['Fecha_Hora_Llegada' => now()]);

        $estadoc = ChoferCamion::where('ID_Camion', $camion->ID)->first();
        $estadoc ->update([
            'ID_Estado' => 4,
        ]);
        
        return redirect()->route('formularioHora')->with('mensaje','Se a marcado la hora exitosamente');
    }

    public function asignarPlataforma(Request $request)
    {
        $matricula = $request->input('matricula');
        $numero = $request->input('numero_plataforma');

        $camion = Camion::where('matricula', $matricula)->first();
        if (!$camion) {
            return redirect()->route('formularioAsignarPlataforma')->with('mensaje', 'Camión no encontrado');
        }

        $plataforma = Plataforma::where('Numero', $numero)->first();
        if (!$plataforma) {
            return redirect()->route('formularioAsignarPlataforma')->with('mensaje', 'Plataforma no encontrada');
        }
        
        $camionPlataforma = CamionPlataforma::where('ID_Camion', $camion->ID)->first();
        if ($camionPlataforma != null) {
            return redirect()->route('formularioAsignarPlataforma')->with('mensaje', 'El camión ya tiene una plataforma asignada');
        }
        $camionPlataforma = CamionPlataforma::where('Numero_Plataforma', $plataforma->Numero)->first();
        if ($camionPlataforma != null) {
            return redirect()->route('formularioAsignarPlataforma')->with('mensaje', 'La plataforma ya tiene un camión asignado');
        }

        $asignarPlataforma = CamionPlataforma::create([
            'ID_Camion' => $camion->ID,
            'ID_Almacen' => $plataforma->ID_Almacen,
            'Numero_Plataforma' => $plataforma->Numero,
        ]);

        $asignarPlataforma->save();

        $plataformaSalida = CamionPlataformaSalida::create([
            'ID_Camion' => $camion->ID,
            'ID_Almacen' => $plataforma->ID_Almacen,
            'Numero_Plataforma' => $plataforma->Numero,
        ]);

        $plataformaSalida->save();

        $choferCamion = ChoferCamion::where('ID_Camion', $camion->ID)->first();

        $choferCamion ->update([
            'ID_Estado' => 2,
        ]);

        $choferCamion->save();

        return redirect()->route('formularioAsignarPlataforma')->with('mensaje', 'Plataforma asignada exitosamente');
    }
    public function eliminarCamion($id)
    {
        $camion = Camion::find($id);

        $camion->deleted_at = now();
        $camion->save();

        return redirect()->route('vistaBuscarCamion')->with('mensaje', 'Camion eliminado con éxito');
    }
}