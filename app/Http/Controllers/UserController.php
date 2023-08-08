<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function mostrarVistaPrincipal()
    {
        return view('users/user');
    }

    public function mostrarVistaCrearUsuario()
    {
        return view('users/crearUsuario');
    }

    public function mostrarVistaBuscarUsuario()
    {
        return view('users/buscarUsuario');
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
        if (!$user) {
            return view('users.buscarUsuario', ['error' => 'Usuario no encontrado']);
        }
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
            'rol' => 'required|in:administrador,chofer,cliente,funcionario,gerente',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.crearUsuario')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if (User::where('username', $validatedData['username'])->exists()) {
            return response()->json(['error' => 'El nombre de usuario ya está en uso'], 422);
        }

        $validatedData['password'] = bcrypt($request->password);

        User::create($validatedData);

        session()->flash('mensaje', 'Usuario creado exitosamente');
        return redirect()->route('user.crearUsuario');
    }

    public function editarUsuario(Request $request, $username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        if ($request->isMethod('patch')) {
            $validator = Validator::make($request->all(), [
                'ci' => 'string|max:8',
                'nombre' => 'string|max:20',
                'apellido' => 'string|max:100',
                'correo' => 'email',
                'password' => 'nullable|string|min:6|confirmed',
                'telefono' => 'numeric',
                'rol' => 'required|in:admin,chofer,cliente,funcionario,gerente',
            ]);

            if ($validator->fails()) {
                //dd($validator->errors()->all());
                return redirect()->route('user.editarUsuario', ['username' => $user->username])->withErrors($validator)->withInput();
            }

            $data = $request->only(['ci', 'nombre', 'apellido', 'correo', 'telefono']);

            if (!empty($request->password)) {
                $data['password'] = bcrypt($request->password);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            return redirect()->route('user.editarUsuario', ['username' => $user->username])
                ->with('success', 'Usuario actualizado exitosamente');
        }

        return view('users.editarUsuario', ['user' => $user]);
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
