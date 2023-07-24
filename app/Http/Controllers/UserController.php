<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function mostrarUsuarios()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function getUsuarioId($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return response()->json([$user]);
    }



    public function CrearUsuario(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ci' => 'required|string|max:10',
            'nombre' => 'required|string|max:20',
            'apellido' => 'required|string|max:100',
            'correo' => 'required|email',
            'username' => 'required|max:55|min:3|unique:users|regex:/^\S*$/',
            'password' => 'required|string|min:6|confirmed',
            'telefono' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        

        $validatedData = $validator->validated();

        // Verificar si el nombre de usuario ya existe en la base de datos
        if (User::where('username', $validatedData['username'])->exists()) {
            return response()->json(['error' => 'El nombre de usuario ya está en uso'], 422);
        }

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }

    public function editarUsuario(User $user)
    {
        return view('editar_usuario', compact('user'));
    }

    public function ActualizarUsuario(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'username' => 'required|string|max:55|regex:/^\S*$/',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user->update($request->all());
        return response()->json($user);
    }
    public function EliminarUsuario($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            return response()->json(['error' => 'No existe el Usuario'], 404);
        }
        $user->delete();
        return response()->json(null, 204);
    }
}
