<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario - Crear Usuario</title>
    <link rel="stylesheet" href="/css/crearUsuario.css">
</head>

<body>
    @if (session('mensaje'))
        <div class="mensaje-exito">
            {{ session('mensaje') }}
        </div>
    @endif
    @if (session('mensaje-error'))
        <div class="mensaje-error">
            {{ session('mensaje-error') }}
        </div>
    @endif
    <a href="{{ route('vistaUsuario') }}" style="color: white">Volver al menú Usuario</a>
    <h1>Crear usuario</h1>
    <form action="" method="post">
        @csrf
        <label for="ci">Cedula de identidad <input value="{{ old('ci') }}" type="text" name="ci" required>
            @error('ci')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label>
        <label>Con digito verificador, sin puntos ni guiones</label><br><br>
        <label for="nombre">Nombre <input value="{{ old('nombre') }}" type="text" name="nombre" required>
            @error('nombre')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="apellido">Apellido <input value="{{ old('apellido') }}" type="text" name="apellido" required>
            @error('apellido')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="correo">Correo <input value="{{ old('correo') }}" type="email" name="correo" required>
            @error('correo')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="telefono">Telefono <input value="{{ old('telefono') }}" type="text" name="telefono" required>
            @error('telefono')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="username">Nombre de usuario <input value="{{ old('username') }}" type="text" name="username" required>
            @error('username')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="password">Contraseña <input type="password" name="password" required>
            @error('password')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="password">Confirmar contraseña <input type="password" name="password_confirmation" required>
            @error('password_confirmation')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="rol">Seleccione su rol
        <select name="rol" id="rol">
            <option value="administrador">Administrador</option>
            <option value="gerente">Gerente</option>
            <option value="cliente">Cliente</option>
            <option value="chofer">Chofer</option>
            <option value="funcionario">Funcionario</option>
        </select>
            @error('rol')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Crear</button>
    </form>
</body>

</html>
