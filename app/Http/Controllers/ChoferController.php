<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chofer;
use App\Models\Persona;
use App\Models\PersonaTelefono;
use App\Models\ChoferCamion;
use App\Models\Camion;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ChoferController extends Controller
{
    public function mostrarChoferes()
    {
        $choferes = Chofer::all();
        $data = [];

        foreach ($choferes as $chofer) {
            $user = User::find($chofer->ID);
            $persona = Persona::find($user->ID);
            $telefono = PersonaTelefono::where('ID_Persona', $persona->ID)->first();
            $telefonoA = $telefono ? $telefono->Telefono : 'No tiene';
            
            $choferCamion = ChoferCamion::where('ID_Chofer', $chofer->ID)->first();
            $camion = $choferCamion ? Camion::find($choferCamion->ID_Camion)->Matricula : 'No tiene';

            $deletedAt = $user->deleted_at;

            $datos = [
                'ci' => $persona->CI,
                'nombre' => $persona->Nombre,
                'apellido' => $persona->Apellido,
                'correo' => $persona->Correo,
                'username' => $user->username,
                'telefono' => $telefonoA,
                'rol' => "Chofer",
                'camion' => $camion,
                'deleted_at' => $deletedAt,
            ];

            $data[] = $datos;
        }

        return view('chofer.mostrarChoferes', ['datos' => $data]);
    }
    public function asignarCamion(Request $request)
    {
        $validator = Validator::make($request -> all(),[
            'ID_Camion' => 'required', 'numeric',
            'ID_Chofer' => 'required', 'numeric',
            'estado' => 'required', 'numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('vistaAsignarCamion')->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $camionID = $data['ID_Camion'];
        $choferID = $data['ID_Chofer'];
        $estado = $data['estado'];

        $camion = Camion::find($camionID);
        if (!$camion) {
            return redirect()->route('vistaAsignarCamion')->with('mensaje', 'Camion no encontrado');
        }
        if ($camion->deleted_at != null) {
            return redirect()->route('vistaAsignarCamion')->with('mensaje', 'No puedes asignar un chofer a un camión eliminado');
        }

        $chofer = Chofer::find($choferID);
        if (!$chofer) {
            return redirect()->route('vistaAsignarCamion')->with('mensaje', 'Chofer no encontrado');
        }
        if ($chofer->deleted_at != null) {
            return redirect()->route('vistaAsignarCamion')->with('mensaje', 'No puedes asignar un chofer eliminado');
        }

        $choferCamion = ChoferCamion::create([
            'ID_Camion' => $camionID,
            'ID_Chofer' => $choferID,
            'ID_Estado' => $estado,
            'Fecha_Hora_Inicio' => now(),
        ]);

        $choferCamion->save();

        session()->flash('mensaje', 'Camion vinculado con Chofer existosamente');
        return redirect()->route('asignarCamion');
    }
}
