<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario - Buscar Usuario</title>
</head>

<body>
    <a href="{{ route('vistaUsuario') }}">Volver al menú principal</a>
    <br><br>
    <h2>Informacion del usuario:</h2>
    @if(isset($error))
        <p>{{ $error }}</p>
    @elseif(isset($user))
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

        <a href="{{ route('eliminarUsuario', ['username' => $user->username]) }}">Eliminar Usuario</a> <br>
        <a href="{{ route('editarUsuario', ['username' => $user->username]) }}">Editar Usuario</a>
    @endif
</body>

</html>
