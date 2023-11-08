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
use App\Models\PersonaUsuario;
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

        $persona -> save();

        $persona_usuario = PersonaUsuario::create([
            'ID_Usuario' => $user -> ID,
            'ID_Persona' => $persona -> ID,
        ]);

        $persona_usuario -> save();

        $telefono = PersonaTelefono::create([
            'ID_Persona' => $persona -> ID,
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
        $user = User::where('username', $username)->withTrashed()->first();

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

        session() -> put('rol', $rol);

        return view('users.editarUsuario', ['datos' => $datos]);
    }

    public function actualizarUsuario(Request $request, $username)
    {
        $user = User::where('username', $username)->first();

        $rolAnterior = session('rol');

        $validator = Validator::make($request->all(), [
            'ci' => 'string|max:8',
            'nombre' => 'string|max:20',
            'apellido' => 'string|max:100',
            'correo' => 'email',
            'password' => 'nullable|string|min:6|confirmed',
            'telefono' => 'string|max:20',
            'rol' => 'required|in:Administrador,Chofer,Cliente,Funcionario,Gerente',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editarUsuario', ['username' => $user->username])->withErrors($validator)->withInput();
        }

        $data = $request->only(['ci', 'nombre', 'apellido', 'correo', 'telefono', 'rol']);

        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $persona = Persona::find($user->ID);
        $persona -> update([
            'CI' => $data['ci'],
            'Nombre' => $data['nombre'],
            'Apellido' => $data['apellido'],
            'Correo' => $data['correo'],
        ]);

        $personaTelefono = PersonaTelefono::where('ID_Persona', $persona->ID)->first();
        $personaTelefono -> update([
            'Telefono' => $data['telefono'],
        ]);


        $rol = $data['rol'];

        if($rol != $rolAnterior){
            if ($rol == 'administrador') {
                $rol = Administrador::create([
                    'ID' => $persona->ID,
                ]);
                $rol -> save();
            } 
            if ($rol == 'chofer') {
                $rol = Chofer::create([
                    'ID' => $persona->ID,
                ]);
                $rol -> save();
            } 
            if ($rol == 'cliente') {
                $rol = Cliente::create([
                    'ID' => $persona->ID,
                ]);
                $rol -> save();
            } 
            if ($rol == 'funcionario') {
                $rol = FuncionarioAlmacen::create([
                    'ID' => $persona->ID,
                ]);
                $rol -> save();
            } 
            if ($rol == 'gerente') {
                $rol = GerenteAlmacen::create([
                    'ID_Gerente' => $persona->ID,
                ]);
                $rol -> save();
            }
            if ($rolAnterior == 'Administrador') {
                $rol = Administrador::where('ID', $persona->ID)->first();
                $rol->delete();
            }
            if ($rolAnterior == 'Chofer') {
                $rol = Chofer::where('ID', $persona->ID)->first();
                $rol->delete();
            }
            if ($rolAnterior == 'Cliente') {
                $rol = Cliente::where('ID', $persona->ID)->first();
                $rol->delete();
            }
            if ($rolAnterior == 'Funcionario') {
                $rol = FuncionarioAlmacen::where('ID', $persona->ID)->first();
                $rol->delete();
            }
            if ($rolAnterior == 'Gerente') {
                $rol = GerenteAlmacen::where('ID_Gerente', $persona->ID)->first();
                $rol->delete();
            }
        }

        return redirect()->route('vistaBuscarUsuario', ['username' => $user->username])
            ->with('mensaje', 'Usuario actualizado exitosamente');
    }

    public function eliminarUsuario($username)
    {
        $user = User::where('username', $username)->withTrashed()->first();

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

        $persona = Persona::find($user->ID);
        $persona->deleted_at = now();
        $persona->save();

        $personaUsuario = PersonaUsuario::where('ID_Usuario', $user->ID)->first();
        $personaUsuario->deleted_at = now();
        $personaUsuario->save();

        if (Administrador::where('ID', $user->ID)->exists()) {
            $rol = Administrador::where('ID', $user->ID)->first();
            $rol->deleted_at = now();
            $rol->save();
        }
        if (Chofer::where('ID', $user->ID)->exists()) {
            $rol = Chofer::where('ID', $user->ID)->first();
            $rol->deleted_at = now();
            $rol->save();
        }
        if (Cliente::where('ID', $user->ID)->exists()) {
            $rol = Cliente::where('ID', $user->ID)->first();
            $rol->deleted_at = now();
            $rol->save();
        }
        if (FuncionarioAlmacen::where('ID', $user->ID)->exists()) {
            $rol = FuncionarioAlmacen::where('ID', $user->ID)->first();
            $rol->deleted_at = now();
            $rol->save();
        }
        if (GerenteAlmacen::where('ID_Gerente', $user->ID)->exists()) {
            $rol = GerenteAlmacen::where('ID_Gerente', $user->ID)->first();
            $rol->deleted_at = now();
            $rol->save();
        }

        //deleted_at persona telefono base de datos

        return redirect()->route('vistaBuscarUsuario')->with('mensaje', 'Usuario eliminado con éxito');
    }
}