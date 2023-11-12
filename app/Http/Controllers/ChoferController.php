<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chofer;
use App\Models\Persona;
use App\Models\PersonaUsuario;
use App\Models\PersonaTelefono;
use App\Models\ChoferCamion;
use App\Models\Camion;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ChoferController extends Controller
{
    public function mostrarChoferes()
    {
        $choferes = Chofer::whereNull('deleted_at')->get();
        $data = [];

        foreach ($choferes as $chofer) {
            $data[] = $this->datosChofer($chofer);
        }

        return view('chofer.mostrarChoferes', ['datos' => $data]);
    }

    private function datosChofer($chofer)
    {
        $persona = $this->persona($chofer);
        $telefono = $this->telefono($persona);
        $user = $this->user($persona, $chofer);

        return [
            'ci' => $persona->CI,
            'nombre' => $persona->Nombre,
            'apellido' => $persona->Apellido,
            'correo' => $persona->Correo,
            'username' => $user->username,
            'telefono' => $telefono,
            'rol' => "Chofer",
            'camion' => $camion->matricula,
            'deleted_at' => $deletedAt,
        ];
    }

    private function persona($chofer)
    {
        $personaUsuario = PersonaUsuario::where('ID_Persona', $chofer->ID)->first();
        $persona = Persona::find($personaUsuario->ID_Persona);
        return $persona;
    }

    private function telefono($persona)
    {
        $telefono = PersonaTelefono::where('ID_Persona', $persona->ID)->first();
        $telefonoA = $telefono ? $telefono->Telefono : 'No tiene';
        return $telefonoA;
    }

    private function user($persona, $chofer)
    {
        $user = User::where('ID', $persona->ID_Usuario)->first();
        $choferCamion = ChoferCamion::where('ID_Chofer', $chofer->ID)->first();
        $camion = Camion::where('ID', $choferCamion->ID_Camion)->first();
        $deletedAt = $user->deleted_at;

        return [$user, $chofer, $deletedAt];
    }

    public function asignarCamion(Request $request)
    {
        $data = $this->validatorAsignar($request);

        $camionID = $data['ID_Camion'];
        $choferID = $data['ID_Chofer'];
        $estado = $data['estado'];

        $camion = $this->camion($camionID);
        $chofer = $this->chofer($choferID);
        $choferCamion = $this->crearChoferCamion($camionID, $choferID, $estado);


        session()->flash('mensaje', 'Camion vinculado con Chofer existosamente');
        return redirect()->route('asignarCamion');
    }

    private function crearChoferCamion($camionID, $choferID, $estado)
    {
        $choferCamion = ChoferCamion::create([
            'ID_Camion' => $camionID,
            'ID_Chofer' => $choferID,
            'ID_Estado' => $estado,
            'Fecha_Hora_Inicio' => now(),
        ]);

        $choferCamion->save();
    }

    private function validatorAsignar($request)
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

        return $data;
    }

    private function camion($camionID)
    {
        $camion = Camion::find($camionID);
        if (!$camion) {
            return redirect()->route('vistaAsignarCamion')->with('mensaje', 'Camion no encontrado');
        }
        if ($camion->deleted_at != null) {
            return redirect()->route('vistaAsignarCamion')->with('mensaje', 'No puedes asignar un chofer a un camión eliminado');
        }

        return $camion;
    }

    private function chofer($choferID)
    {
        $chofer = Chofer::find($choferID);
        if (!$chofer) { 
            return redirect()->route('vistaAsignarCamion')->with('mensaje', 'Chofer no encontrado');
        }
        if ($chofer->deleted_at != null) {
            return redirect()->route('vistaAsignarCamion')->with('mensaje', 'No puedes asignar un chofer eliminado');
        }

        return $chofer;
    }
}
