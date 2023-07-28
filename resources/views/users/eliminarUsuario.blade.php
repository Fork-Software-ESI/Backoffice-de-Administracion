<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users - Eliminar Usuario</title>
</head>
<body>
    <h1>Bienvenido a Eliminar Usuario</h1>
    <form action="{{ route('users.eliminarUsuario') }}" method="post">
        @csrf
        @method('delete')
        <label for="username">Ingrese el username del usuario:</label>
        <input type="text" name="username" id="username" required>
        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar Usuario</button>
    </form>
    @if(isset($mensaje))
        <p>{{ $mensaje }}</p>
    @endif
</body>
</html>