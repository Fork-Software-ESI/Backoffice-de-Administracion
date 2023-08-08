<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario - Buscar Usuario</title>
</head>

<body>
    <h2>Bienvenido a Buscar Usuario</h2>
    <a href="{{ route('user.mostrarVistaPrincipal') }}">Volver al menú principal</a>
    <form action="{{ route('user.buscarUsuario') }}" method="post">
        @csrf
        <label for="username">Ingrese el username del usuario:</label>
        <input type="text" name="username" id="username" required>
        <button type="submit">Buscar</button>
    </form>
    <h2>Informacion del usuario:</h2>
    @if (isset($user))
        @if ($user)
            <table>
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Username</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->ci }}</td>
                        <td>{{ $user->nombre }}</td>
                        <td>{{ $user->apellido }}</td>
                        <td>{{ $user->correo }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->telefono }}</td>
                        <td>{{ $user->rol }}</td>
                    </tr>
                </tbody>
            </table>

            <a href="{{ route('user.eliminarUsuario', ['username' => $user->username]) }}">Eliminar Usuario</a> <br>
            <a href="{{ route('user.editarUsuario', ['username' => $user->username]) }}">Editar Usuario</a>
        @endif
    @elseif (isset($error))
        <p>{{ $error }}</p>
    @endif
</body>

</html>
