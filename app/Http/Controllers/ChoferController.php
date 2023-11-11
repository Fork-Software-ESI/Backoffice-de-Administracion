<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chofer;
use App\Models\Persona;
use App\Models\PersonaUsuario;
use App\Models\PersonaTelefono;

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

    public function datosChofer($chofer)
    {
        $personaUsuario = PersonaUsuario::where('ID_Persona', $chofer->ID)->first();
        $user = User::where('ID', $personaUsuario->ID_Usuario)->first();
        $persona = Persona::find($personaUsuario->ID_Persona);
        $telefono = PersonaTelefono::where('ID_Persona', $persona->ID)->first();
        $telefonoA = $telefono ? $telefono->Telefono : 'No tiene';

        $deletedAt = $user->deleted_at;

        return [
            'ci' => $persona->CI,
            'nombre' => $persona->Nombre,
            'apellido' => $persona->Apellido,
            'correo' => $persona->Correo,
            'username' => $user->username,
            'telefono' => $telefonoA,
            'rol' => "Chofer",
            'deleted_at' => $deletedAt,
        ];
    }

}
