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
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Usuario no encontrado');
        }

        if (password_verify($request->password, $user->password)) {
            $personaUsuario = PersonaUsuario::where('ID_Usuario', $user->ID)->first();
            $persona = Persona::where('ID', $personaUsuario->ID_Persona)->first();
            $esAdministrador = Administrador::where('ID', $persona->ID)->exists();
            if ($esAdministrador) {
            $token = $user->createToken('auth_token')->accessToken;
            $user->token = $token;
            auth()->login($user);
            return redirect()->route('home')->with('bienvenida', $user->username);
            }
            return redirect()->route('login')->with('error', 'No tienes permisos para acceder');
        }
            return redirect()->route('login')->with('error', 'Contraseña incorrecta');
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