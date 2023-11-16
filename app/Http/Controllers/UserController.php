<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Persona;
use App\Models\Administrador;
use App\Models\Cliente;
use App\Models\Chofer;
use App\Models\GerenteAlmacen;
use App\Models\FuncionarioAlmacen;
use App\Models\PersonaUsuario;
use App\Models\PersonaTelefono;
use App\Models\ChoferTipoLibretum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function mostrarUsuarios()
    {
        $users = User::whereNull('deleted_at')->get();

        $datos = [];

        foreach ($users as $user) {
            $datos[] = $this->datosUsuario($user);
        }
        return view('users.mostrarUsuarios', ['datos' => $datos]);
    }

    private function verificarRol($user)
    {
        $rol = null;

        if (Administrador::where('ID', $user->ID)->exists()) {
            $rol = 'Administrador';
        } elseif (Chofer::where('ID', $user->ID)->exists()) {
            $rol = 'Chofer';
        } elseif (Cliente::where('ID', $user->ID)->exists()) {
            $rol = 'Cliente';
        } elseif (FuncionarioAlmacen::where('ID', $user->ID)->exists()) {
            $rol = 'Funcionario';
        } elseif (GerenteAlmacen::where('ID_Gerente', $user->ID)->exists()) {
            $rol = 'Gerente';
        }

        return $rol ?? 'Cliente';
    }


    private function datosUsuario($user)
    {
        $personaUsuario = PersonaUsuario::where('ID_Usuario', $user->ID)->withTrashed()->first();
        $persona = Persona::where('ID', $personaUsuario->ID_Persona)->withTrashed()->first();
        $telefono = PersonaTelefono::where('ID_Persona', $persona->ID)->withTrashed()->first();
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
            'id_almacen' => 'required_if:rol,funcionario,gerente|exists:almacen,ID',
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
            return redirect()->route('crearUsuario')->with('mensaje-error', 'Ya existe un usuario con la misma cédula');
        }


        $user = $this->crearUsuarioBase($validatedData);

        $persona = $this->crearPersona($validatedData);

        $id_almacen = $validatedData['id_almacen'];

        $this->crearPersonaUsuario($user, $persona);

        $this->crearTelefono($persona, $validatedData['telefono']);

        if ($validatedData['rol'] == 'funcionario' || $validatedData['rol'] == 'gerente')
            $this->crearRolAlmacen($validatedData['rol'], $persona, $id_almacen);
        else if ($validatedData['rol'] == 'administrador' || $validatedData['rol'] == 'chofer' || $validatedData['rol'] == 'cliente') {
            $this->crearRol($validatedData['rol'], $persona);
        }


        session(['id' => $persona->ID]);

        if ($validatedData['rol'] == 'chofer') {
            return redirect()->route('formularioLibreta');
        }

        session()->flash('mensaje', 'Usuario creado exitosamente');
        return redirect()->route('crearUsuario');
    }

    public function tipoLibreta()
    {
        $id = session('id');
        $tipo_libreta = request('tipo_libreta');

        ChoferTipoLibretum::create([
            'ID' => $id,
            'Tipo' => $tipo_libreta,
        ]);

        return redirect()->route('crearUsuario')->with('mensaje', 'Chofer con libreta creado exitosamente');
    }

    private function usuarioExistente($username)
    {
        return User::where('username', $username)->exists() && User::where('username', $username)->first()->deleted_at == null;
    }

    private function existeUsuarioConMismaCi($ci)
    {
        $contadorUsuariosConMismaCi = Persona::where('ci', $ci)->count();
        return $contadorUsuariosConMismaCi >= 1;
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

    private function crearRolAlmacen($rol, $persona, $ID_Almacen)
    {
        $rolModel = $this->crearRolModelAlmacen($rol, $persona->ID, $ID_Almacen);
        $rolModel->save();
    }

    private function crearRolModelAlmacen($rol, $personaId, $ID_Almacen)
    {
        $rolModel = null;

        if ($rol == 'funcionario') {
            $rolModel = FuncionarioAlmacen::create(['ID' => $personaId, 'ID_Almacen' => $ID_Almacen]);
        } elseif ($rol == 'gerente') {
            $rolModel = GerenteAlmacen::create(['ID_Gerente' => $personaId, 'ID_Almacen' => $ID_Almacen]);
        }

        return $rolModel;
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

        session()->put('rol', $datos['rol']);

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
            $rolClass = 'App\\Models\\' . $rolAnterior;
            $eliminarRolAnterior = $rolClass::where('ID', $user->ID)->first();
            if ($eliminarRolAnterior) {
                $eliminarRolAnterior->delete();
            }
        }
    }

    public function crearNuevoRol($user, $rol)
    {
        $rolClass = 'App\\Models\\' . $rol;
        $crearRol = new $rolClass(['ID' => $user->ID]);
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
        $this->marcarComoEliminadoPersonaUsuario($user);
        $this->marcarComoEliminadoPersona($user);
        $this->marcarComoEliminadoTelefono($user);
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

    private function marcarComoEliminadoPersonaUsuario($user)
    {
        PersonaUsuario::where('ID_Usuario', $user->ID)->first()->delete();
    }

    private function marcarComoEliminadoPersona($user)
    {
        $persona = Persona::find($user->ID);
        $persona->deleted_at = now();
        $persona->save();
    }

    private function marcarComoEliminadoRol($user)
    {
        $roles = ['Administrador', 'Chofer', 'Cliente', 'FuncionarioAlmacen', 'GerenteAlmacen'];

        foreach ($roles as $rol) {
            $existeRol = $this->rolExists($rol, $user->ID);
            if ($existeRol) {
                $this->marcarComoEliminadoSegunRol($rol, $user->ID);
            }
        }
    }

    private function marcarComoEliminadoTelefono($user)
    {
        $persona = Persona::where('ID', $user->ID)->withTrashed()->first();
        $telefono = PersonaTelefono::where('ID_Persona', $persona->ID)->first();
        $telefono->deleted_at = now();
        $telefono->save();
    }

    private function rolExists($rol, $user)
    {
        $rolClass = 'App\\Models\\' . $rol;

        $primaryKey = ($rol === 'GerenteAlmacen') ? 'ID_Gerente' : (new $rolClass)->getKeyName();

        return $rolClass::where($primaryKey, $user)->exists();
    }


    private function marcarComoEliminadoSegunRol($rol, $user)
    {
        $rolClass = 'App\\Models\\' . $rol;

        $instance = new $rolClass;

        $primaryKey = ($rol === 'GerenteAlmacen') ? 'ID_Gerente' : $instance->getKeyName();

        $rolInstance = $rolClass::where($primaryKey, $user)->first();

        if ($rolInstance) {
            $rolInstance->delete();
        }
    }
}
