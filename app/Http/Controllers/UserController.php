<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsuarios()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function getUsuarioId($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function CrearUsuario(Request $request)
    {
        // Validar los datos del formulario
        $validar = $request->validate([
            'ci' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'rol' => 'required|string'
        ]);
        $user = User::create($validar);
        return response()->json($user, 201);
    }

    public function ActualizarUsuario(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validar = $request->validate([
            'ci' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|string|min:6',
            'rol' => 'required|string'
        ]);
        $user->update($validar);
        return response()->json($user);
    }
    public function EliminarUsuario($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}