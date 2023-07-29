<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users - Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <form action="{{ route('users.editarUsuario', ['username' => $user->username]) }}" method="post">
        @csrf
        @method('put')
        <label for="ci">Cédula:</label>
        <input type="text" name="ci" id="ci" value="{{ $user->ci }}" >
        <br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ $user->nombre }}">
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" value="{{ $user->apellido }}">
        <br>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" value="{{ $user->correo }}">
        <br>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="{{ $user->username }}">
        <br>
        <label for="contraseña">Nueva contraseña:</label>
        <input type="contraseña" name="contraseña" id="contraseña" value="{{ $user->password }}">
        <br>
        <label for="confirmar_contraseña">Confirmar nueva contraseña:</label>
        <input type="contraseña" name="confirmar_contraseña" id="confirmar_contraseña">
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" value="{{ $user->telefono }}">
        <br>
        <button type="submit">Actualizar Usuario</button>
    </form>
</body>
</html>