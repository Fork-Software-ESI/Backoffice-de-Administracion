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
            $datos[] = $this->datosUsuario($user);
        }
        return view('users.mostrarUsuarios', ['datos' => $datos]);
    }

    private function verificarRol($user)
    {
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

        return $rol;
    }

    private function datosUsuario($user)
    {
        $personaUsuario = PersonaUsuario::where('ID_Usuario', $user -> ID) -> first();
        $persona = Persona::where('ID', $personaUsuario->ID_Persona)->firstOrNew();
        $telefono = PersonaTelefono::where('ID_Persona', $persona->ID)->first();
        $rol = $this->verificarRol($user);
        $telefonoA = $telefono ? $telefono->Telefono : 'No tiene';
        $deletedAt = $user->deleted_at;

        return [
            'ci' => $persona->CI,
            'nombre' => $persona->Nombre,
            'apellido' => $persona->Apellido,
            'correo' => $persona->Correo,
            'username' => $user->username,
            'telefono' => $telefonoA,
            'rol' => $rol,
            'deleted_at' => $deletedAt,
        ];
    }

    private function validator($request)
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

        return $validatedData;
    }

    public function buscarUsuario(Request $request)
    {
        $username = $request->input('username');
        $user = User::where('username', $username)->withTrashed()->first();
    
        if (!$user) {
            return redirect()->route('vistaBuscarUsuario')->with('mensaje', 'No existe un usuario con ese nombre de usuario');
        }
    
        $datos = $this->datosUsuario($user);
        
        return view('users.buscarUsuario', ['user' => $user, 'datos' => $datos]);
    }
    
    public function crearUsuario(Request $request)
    {
        $validatedData = $this->validator($request);

        if ($this->usuarioExistente($validatedData['username'])) {
            return response()->json(['error' => 'El nombre de usuario ya está en uso'], 422);
        }

        if ($this->existeUsuarioConMismaCi($validatedData['ci'])) {
            return redirect()->route('crearUsuario')->with('mensaje-error', 'Ya existen 2 usuarios con la misma cédula');
        }

        $user = $this->crearUsuarioBase($validatedData);

        $persona = $this->crearPersona($validatedData);

        $personaUsuario = $this->crearPersonaUsuario($user, $persona);

        $telefono = $this->crearTelefono($persona, $validatedData['telefono']);

        $this->crearRol($validatedData['rol'], $persona);

        session()->flash('mensaje', 'Usuario creado exitosamente');
        return redirect()->route('crearUsuario');
    }

    private function usuarioExistente($username)
    {
        return User::where('username', $username)->exists() && User::where('username', $username)->first()->deleted_at == null;
    }

    private function existeUsuarioConMismaCi($ci)
    {
        $contadorUsuariosConMismaCi = Persona::where('ci', $ci)->count();
        return $contadorUsuariosConMismaCi >= 2;
    }

    private function crearUsuarioBase($validatedData)
    {
        $user = User::create([
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $user->save();

        return $user;
    }

    private function crearPersona($validatedData)
    {
        $persona = Persona::create([
            'CI' => $validatedData['ci'],
            'Nombre' => $validatedData['nombre'],
            'Apellido' => $validatedData['apellido'],
            'Correo' => $validatedData['correo'],
        ]);

        $persona->save();

        return $persona;
    }

    private function crearPersonaUsuario($user, $persona)
    {
        $personaUsuario = PersonaUsuario::create([
            'ID_Usuario' => $user->ID,
            'ID_Persona' => $persona->ID,
        ]);

        $personaUsuario->save();

        return $personaUsuario;
    }

    private function crearTelefono($persona, $telefono)
    {
        $telefono = PersonaTelefono::create([
            'ID_Persona' => $persona->ID,
            'Telefono' => $telefono,
        ]);

        $persona->persona_telefonos()->save($telefono);

        return $telefono;
    }

    private function crearRol($rol, $persona)
    {
        $rolModel = $this->crearRolModel($rol, $persona->ID);
        $rolModel->save();
    }

    private function crearRolModel($rol, $personaId)
    {
        $rolModel = null;

        if ($rol == 'administrador') {
            $rolModel = Administrador::create(['ID' => $personaId]);
        } elseif ($rol == 'chofer') {
            $rolModel = Chofer::create(['ID' => $personaId]);
        } elseif ($rol == 'cliente') {
            $rolModel = Cliente::create(['ID' => $personaId]);
        } elseif ($rol == 'funcionario') {
            $rolModel = FuncionarioAlmacen::create(['ID' => $personaId]);
        } elseif ($rol == 'gerente') {
            $rolModel = GerenteAlmacen::create(['ID_Gerente' => $personaId]);
        }

        return $rolModel;
    }


    public function editarUsuario($username)
    {
        $user = User::where('username', $username)->withTrashed()->first();

        if ($user->deleted_at != null) {
            return redirect()->route('vistaBuscarUsuario')->with('mensaje', 'No puedes modificar un usuario eliminado');
        }

        $datos = $this->datosUsuario($user);

        session() -> put('rol', $datos['rol']);

        return view('users.editarUsuario', ['datos' => $datos]);
    }

    public function validatorActualizar($request, $user)
    {
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

        return $data;
    }

    public function actualizarUsuario(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        $rolAnterior = session('rol');

        $data = $this->validatorActualizar($request, $user);

        $this->actualizarDatosUsuario($user, $data);
        $this->actualizarRol($user, $data['rol'], $rolAnterior);

        return redirect()->route('vistaBuscarUsuario', ['username' => $user->username])
            ->with('mensaje', 'Usuario actualizado exitosamente');
    }

    public function actualizarDatosUsuario($user, $data)
    {
        $persona = Persona::find($user->ID);

        $persona->update([
            'CI' => $data['ci'],
            'Nombre' => $data['nombre'],
            'Apellido' => $data['apellido'],
            'Correo' => $data['correo'],
        ]);

        $personaTelefono = PersonaTelefono::where('ID_Persona', $persona->ID)->first();

        $personaTelefono->update([
            'Telefono' => $data['telefono'],
        ]);
    }

    public function actualizarRol($user, $rol, $rolAnterior)
    {
        if ($rol != $rolAnterior) {
            $this->eliminarRolAnterior($user, $rolAnterior);
            $this->crearNuevoRol($user, $rol);
        }
    }

    public function eliminarRolAnterior($user, $rolAnterior)
    {
        if ($rolAnterior) {
            $eliminarRolAnterior = $rolAnterior::where('ID', $user)->first();
            if($eliminarRolAnterior){
                $eliminarRolAnterior->delete();
            }
        }
    }

    public function crearNuevoRol($user, $rol)
    {
        $crearRol = new $rol([
            'ID' => $user,
        ]);
        $crearRol->save();
    }

    public function eliminarUsuario($username)
    {
        $user = User::where('username', $username)->withTrashed()->first();

        $validacionEliminar = $this->validarEliminacionUsuario($user);

        if ($validacionEliminar !== null) {
            return $validacionEliminar;
        }

        $this->marcarComoEliminado($user);
        $this->marcarComoEliminadoPersona($user);
        $this->marcarComoEliminadoPersonaUsuario($user);
        $this->marcarComoEliminadoRol($user);

        return redirect()->route('vistaBuscarUsuario')->with('mensaje', 'Usuario eliminado con éxito');
    }

    private function validarEliminacionUsuario($user)
    {
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

        return null;
    }

    private function marcarComoEliminado($user)
    {
        $user->deleted_at = now();
        $user->save();
    }

    private function marcarComoEliminadoPersona($user)
    {
        $personaUsuario = PersonaUsuario::find('ID_Usuario', $user->ID);
        $persona = Persona::find($personaUsuario->ID_Persona);
        $persona->deleted_at = now();
        $persona->save();
    }

    private function marcarComoEliminadoPersonaUsuario($user)
    {
        $personaUsuario = PersonaUsuario::where('ID_Usuario', $user->ID)->first();
        $personaUsuario->deleted_at = now();
        $personaUsuario->save();
    }

    private function marcarComoEliminadoRol($user)
    {
        $roles = ['Administrador', 'Chofer', 'Cliente', 'Funcionario', 'Gerente'];

        foreach ($roles as $rol) {
            if ($this->rolExists($rol, $user->ID)) {
                $this->marcarComoEliminadoSegunRol($rol, $user->ID);
            }
        }
    }

    private function rolExists($rol, $user)
    {
        return $rol::where('ID', $user->ID)->exists();
    }

    private function marcarComoEliminadoSegunRol($rol, $user)
    {
        $rolModel = $rol::where('ID', $user->ID)->first();
        $rolModel->deleted_at = now();
        $rolModel->save();
    }
}