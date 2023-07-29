<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    public function mostrarVistaPrincipal(){
        return view('users/user');
    }

    public function mostrarVistaCrearUsuario() {
        return view('users/crearUsuario');
    }

    public function mostrarUsuarios()
    {
        $users = User::all();
        return view('users.mostrarUsuarios', ['users' => $users]);
    }

    public function buscarUsuario(Request $request)
    {
        $username = $request->input('username');
        $user = User::where('username', $username)->first();

        return view('users.buscarUsuario', ['user' => $user]);
    }



    public function crearUsuario(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ci' => 'required|string|max:10',
            'nombre' => 'required|string|max:20',
            'apellido' => 'required|string|max:100',
            'correo' => 'required|email',
            'username' => 'required|max:55|min:3|unique:users|regex:/^\S*$/',
            'password' => 'required|min:6|confirmed',
            'telefono' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.crearUsuario')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if (User::where('username', $validatedData['username'])->exists()) {
            return response()->json(['error' => 'El nombre de usuario ya está en uso'], 422);
        }

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        session()->flash('mensaje', 'Usuario creado exitosamente');
        return redirect()->route('user.crearUsuario');
    }

    public function editarUsuario(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'ci' => 'string|max:8',
            'nombre' => 'string|max:20',
            'apellido' => 'string|max:100',
            'correo' => 'email',
            'username' => 'max:55|min:3|unique:users|regex:/^\S*$/',
            'password' => 'string|min:6|confirmed',
            'telefono' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user->update($request->all());
        return response()->json($user);
    }
    public function eliminarUsuario(Request $request)
    {
        $username = $request->input('username');
        $user = User::where('username', $username)->first();

        if (!$user) {
            $mensaje = "Usuario no encontrado";
            
        }

        $user->delete();
        $mensaje = "El usuario con el username: " . $username . " ha sido eliminado exitosamente";

        return view('users.eliminarUsuario', compact('mensaje', 'user'));
    }

}
