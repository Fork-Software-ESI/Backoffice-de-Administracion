<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario - Editar Usuario</title>
</head>

<body>
    <h1>Editar Usuario</h1>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <form action="{{ route('editarUsuario', ['username' => $user->username]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="ci">Cedula de identidad <input value="{{ $user->ci }}" type="text" name="ci">
            <label>Con digito verificador, sin puntos ni guiones</label>
            @error('ci')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="nombre">Nombre <input value="{{ $user->nombre }}" type="text" name="nombre">
            @error('nombre')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="apellido">Apellido <input value="{{ $user->apellido }}" type="text" name="apellido">
            @error('apellido')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="correo">Correo <input value="{{ $user->correo }}" type="email" name="correo">
            @error('correo')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="telefono">Telefono <input value="{{ $user->telefono }}" type="text" name="telefono">
            @error('telefono')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="password">Contraseña <input type="password" name="password">
            @error('password')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="password">Confirmar contraseña <input type="password" name="password_confirmation">
            @error('password_confirmation')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="roles"> Seleccione su rol
            <select name="rol" id="rol">
                <option value="administrador">Administrador</option>
                <option value="cliente">Cliente</option>
                <option value="gerente">Gerente</option>
                <option value="funcionario">Funcionario</option>
                <option value="chofer">Chofer</option>
            </select>
        </label><br><br>
        <button type="submit">Actualizar Usuario</button>
    </form>
</body>

</html>
