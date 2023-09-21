<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;
use App\Models\PersonaUsuario;
use App\Models\Administrador;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $usuario = User::where('username', $request->username)->first();
        $personaUsuario = PersonaUsuario::where('ID_Usuario', $usuario->ID)->first();
        $persona = Persona::where('ID', $personaUsuario->ID_Persona)->first();

        $esAdministrador = Administrador::where('ID_Persona', $persona->ID)->exists();

        $credentials = $request->only('username', 'password');

        if ($esAdministrador && auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('authToken')->accessToken;
            return redirect()->route('home')->with('bienvenida', $persona->Nombre . ' ' . $persona->Apellido);
        } elseif (!$esAdministrador) {
            return redirect()->route('login')->with('error', 'No tiene permisos para acceder');
        }

        return redirect()->route('login')->with('error', 'Credenciales incorrectas');
    }

    public function logout(Request $request)
    {
        $user = auth()->user();

        $user->tokens->each(function ($token) {
            $token->revoke();
        });

        auth()->logout();
        return redirect()->route('login')->with('error', $user->username . ' ha cerrado sesión');
    }

}