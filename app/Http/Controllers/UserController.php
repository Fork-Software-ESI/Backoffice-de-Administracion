<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Persona;
use App\Models\Administrador;
use App\Models\Cliente;
use App\Models\Chofer;
use App\Models\GerenteAlmacen;
use App\Models\FuncionarioAlmacen;
use App\Models\PersonaTelefono;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function mostrarUsuarios()
    {
        $users = User::whereNull('deleted_at')->get();

        $datos = [];

        foreach ($users as $user){
            $persona = Persona::where('ID', $user->ID)->firstOrNew();
            
            $telefono = PersonaTelefono::where('ID', $persona->ID)->first();
            
            $rol = '';

            if(Administrador::where('ID', $user->ID)->exists()){
                $rol = 'Administrador';
            }
            if(Chofer::where('ID', $user->ID)->exists()){
                $rol = 'Chofer';
            }
            if(Cliente::where('ID', $user->ID)->exists()){
                $rol = 'Cliente';
            }
            if(FuncionarioAlmacen::where('ID', $user->ID)->exists()){
                $rol = 'Funcionario';
            }
            if(GerenteAlmacen::where('ID_Gerente', $user->ID)->exists()){
                $rol = 'Gerente';
            }

            $telefonoA = $telefono ? $telefono->Telefono : 'No tiene';

            $datos[] = [
                'ci' => $persona->CI,
                'nombre' => $persona->Nombre,
                'apellido' => $persona->Apellido,
                'correo' => $persona->Correo,
                'username' => $user->username,
                'telefono' => $telefonoA,
                'rol' => $rol,
            ];
        }
        return view('users.mostrarUsuarios', ['datos' => $datos]);
    }


    public function buscarUsuario(Request $request)
    {
        $username = $request->input('username');
        $user = User::where('username', $username)->withTrashed()->first();
    
        if (!$user) {
            return redirect()->route('vistaBuscarUsuario')->with('mensaje', 'No existe un usuario con ese nombre de usuario');
        }
    
        $persona = Persona::find($user->ID);
        $telefono = PersonaTelefono::where('ID', $persona->ID)->first();
        $rol = '';
    
        if (Administrador::where('ID', $user->ID)->exists()) {
            $rol = 'Administrador';
        } 
        if (Chofer::where('ID', $user->ID)->exists()) {
            $rol = 'Chofer';
        } 
        if (Cliente::where('ID', $user->ID)->exists()) {
            $rol = 'Cliente';
        } 
        if (FuncionarioAlmacen::where('ID', $user->ID)->exists()) {
            $rol = 'Funcionario';
        } 
        if (GerenteAlmacen::where('ID_Gerente', $user->ID)->exists()) {
            $rol = 'Gerente';
        }
        
        $deletedAt = $user->deleted_at;

        $datos = [
            'id' => $user->ID,
            'ci' => $persona->CI,
            'nombre' => $persona->Nombre,
            'apellido' => $persona->Apellido,
            'correo' => $persona->Correo,
            'username' => $user->username,
            'telefono' => $telefono ? $telefono->Telefono : 'No tiene',
            'rol' => $rol,
            'deleted_at' => $deletedAt,
        ];
        
        return view('users.buscarUsuario', ['user' => $user, 'datos' => $datos]);
    }
    public function crearUsuario(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ci' => 'required|string|max:10',
            'nombre' => 'required|alpha|max:20',
            'apellido' => 'required|alpha|max:100',
            'correo' => 'required|email',
            'username' => 'required|max:55|min:3|unique:users|regex:/^\S*$/',
            'password' => 'required|min:6|confirmed',
            'telefono' => 'required|string',
            'rol' => 'required|in:administrador,chofer,cliente,funcionario,gerente',
        ]);

        if ($validator->fails()) {
            return redirect()->route('crearUsuario')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if (User::where('username', $validatedData['username'])->exists() && User::where('username', $validatedData['username'])->first()->deleted_at == null) {
            return response()->json(['error' => 'El nombre de usuario ya está en uso'], 422);
        }

        $contadorUsuariosConMismaCi = Persona::where('ci', $validatedData['ci'])->count();
        if ($contadorUsuariosConMismaCi >= 2)
            return redirect()->route('crearUsuario')->with('mensaje-error', 'Ya existen 2 usuarios con la misma cédula');
        $validatedData['password'] = bcrypt($request->password);

        $userConMismaCedula = Persona::where('ci', $validatedData['ci'])->first();

        if ($contadorUsuariosConMismaCi == 1 && $userConMismaCedula->rol == 'cliente' && $validatedData['rol'] == 'cliente') {
            return redirect()->route('crearUsuario')->with('mensaje-error', 'Ya existe un cliente con la misma cédula');
        }

        if ($contadorUsuariosConMismaCi == 1 && $userConMismaCedula->rol != 'cliete' && $validatedData['rol'] != 'cliente') {
            return redirect()->route('crearUsuario')->with('mensaje-error', 'Una misma persona no puede ocupar dos cargos distintos');
        }

        $user = User::create([
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
        ]);

        $user -> save();

        $persona = Persona::create([
            'CI' => $validatedData['ci'],
            'Nombre' => $validatedData['nombre'],
            'Apellido' => $validatedData['apellido'],
            'Correo' => $validatedData['correo'],
        ]);

        $telefono = new PersonaTelefono([
            'Telefono' => $validatedData['telefono'],
        ]);

        $persona -> persona_telefonos() -> save($telefono);

        if ($validatedData['rol'] == 'administrador') {
            $rol = Administrador::create([
                'ID' => $persona->ID,
            ]);
            $rol -> save();
        } 
        if ($validatedData['rol'] == 'chofer') {
            $rol = Chofer::create([
                'ID' => $persona->ID,
            ]);
            $rol -> save();
        } 
        if ($validatedData['rol'] == 'cliente') {
            $rol = Cliente::create([
                'ID' => $persona->ID,
            ]);
            $rol -> save();
        } 
        if ($validatedData['rol'] == 'funcionario') {
            $rol = FuncionarioAlmacen::create([
                'ID' => $persona->ID,
            ]);
            $rol -> save();
        } 
        if ($validatedData['rol'] == 'gerente') {
            $rol = GerenteAlmacen::create([
                'ID_Gerente' => $persona->ID,
            ]);
            $rol -> save();
        }

        session()->flash('mensaje', 'Usuario creado exitosamente');
        return redirect()->route('crearUsuario');
    }

    public function editarUsuario($username)
    {
        $user = User::where('username', $username)->first();

        if ($user->deleted_at != null) {
            return redirect()->route('vistaBuscarUsuario')->with('mensaje', 'No puedes modificar un usuario eliminado');
        }

        $persona = Persona::find($user->ID);
        $telefono = PersonaTelefono::where('ID', $persona->ID)->first();
        $rol = '';

        if (Administrador::where('ID', $user->ID)->exists()) {
            $rol = 'Administrador';
        } 
        if (Chofer::where('ID', $user->ID)->exists()) {
            $rol = 'Chofer';
        } 
        if (Cliente::where('ID', $user->ID)->exists()) {
            $rol = 'Cliente';
        } 
        if (FuncionarioAlmacen::where('ID', $user->ID)->exists()) {
            $rol = 'Funcionario';
        } 
        if (GerenteAlmacen::where('ID_Gerente', $user->ID)->exists()) {
            $rol = 'Gerente';
        }

        $datos = [
            'ci' => $persona->CI,
            'nombre' => $persona->Nombre,
            'apellido' => $persona->Apellido,
            'correo' => $persona->Correo,
            'username' => $user->username,
            'telefono' => $telefono ? $telefono->Telefono : 'No tiene',
            'rol' => $rol,
        ];

        return view('users.editarUsuario', ['datos' => $datos]);
    }

    public function actualizarUsuario(Request $request, $username)
    {
        $user = User::where('username', $username)->first();

        $validator = Validator::make($request->all(), [
            'ci' => 'string|max:8',
            'nombre' => 'string|max:20',
            'apellido' => 'string|max:100',
            'correo' => 'email',
            'password' => 'nullable|string|min:6|confirmed',
            'telefono' => 'numeric',
            'rol' => 'required|in:administrador,chofer,cliente,funcionario,gerente',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarUsuario', ['username' => $user->username])->withErrors($validator)->withInput();
        }

        $data = $request->only(['ci', 'nombre', 'apellido', 'correo', 'telefono']);

        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        if (!$user->update($data)) {
            return redirect()->route('vistaBuscarUsuario', ['username' => $user->username])
                ->with('mensaje', 'Hubo un problema al actualizar el usuario');
        }
        return redirect()->route('vistaBuscarUsuario', ['username' => $user->username])
            ->with('mensaje', 'Usuario actualizado exitosamente');
    }

    public function eliminarUsuario($id)
    {
        $user = User::find($id);

        if ($user->deleted_at != null) {
            return redirect()->route('vistaBuscarUsuario')->with('mensaje', 'No puedes eliminar un usuario ya eliminado');
        }

        $actual = auth()->user();

        if ($user->username == "superadmin") {
            return redirect()->route('vistaBuscarUsuario')->with('mensaje', 'No puedes eliminar al superadmin');
        }
        if ($user->username == $actual->username) {
            return redirect()->route('vistaBuscarUsuario')->with('mensaje', 'No puedes eliminarte a ti mismo');
        }
        $user->deleted_at = now();
        $user->save();

        return redirect()->route('vistaBuscarUsuario')->with('mensaje', 'Usuario eliminado con éxito');
    }
}