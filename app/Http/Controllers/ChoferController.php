<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chofer;
use App\Models\Persona;
use App\Models\PersonaTelefono;

class ChoferController extends Controller
{
    public function mostrarChoferes()
    {
        $choferes = Chofer::all();
        $data = [];

        foreach ($choferes as $chofer) {
            $user = User::find($chofer->ID);
            $persona = Persona::find($user->ID);
            $telefono = PersonaTelefono::where('ID', $persona->ID)->first();
            $telefonoA = $telefono ? $telefono->Telefono : 'No tiene';

            $deletedAt = $user->deleted_at;

            $datos = [
                'ci' => $persona->CI,
                'nombre' => $persona->Nombre,
                'apellido' => $persona->Apellido,
                'correo' => $persona->Correo,
                'username' => $user->username,
                'telefono' => $telefonoA,
                'rol' => "Chofer",
                'deleted_at' => $deletedAt,
            ];

            $data[] = $datos;
        }

        return view('chofer.mostrarChoferes', ['datos' => $data]);
    }

}
