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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Username</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Eliminado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->ci }}</td>
                    <td>{{ $user->nombre }}</td>
                    <td>{{ $user->apellido }}</td>
                    <td>{{ $user->correo }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>{{ $user->rol }}</td>
                    <td>{{ $user->deleted_at }}</td>
                </tr>
            </tbody>
        </table>

        <form method="POST" action="{{ route('eliminarUsuario', ['id' => $user->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar Usuario</button>
        </form>


        <a href="{{ route('editarUsuario', ['username' => $user->username]) }}">Editar Usuario</a>
</body>

</html>
