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
        $validatedData = $request->validate([
            'username' => 'required|string|max:55',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::create($validatedData);
        return response()->json($user, 201);
    }

    public function ActualizarUsuario(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'username' => 'required|string|max:55',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user->update($request->all());
        return response()->json($user);
    }
    public function EliminarUsuario($id)
    {
        $user = User::findOrFail($id);
        if (!$user){
            return response()->json(['error' => 'No existe el Usuario'], 404);
        }
        $user->delete();
        return response()->json(null, 204);
    }
}