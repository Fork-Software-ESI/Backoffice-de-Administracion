<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario - Buscar Usuario</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>

<body>
    <a href="{{ route('vistaUsuario') }}">Volver al menú principal</a>
    <br><br>
    <h2>Informacion del usuario:</h2>
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
                    <th>Eliminado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $datos['ci'] }}</td>
                    <td>{{ $datos['nombre'] }}</td>
                    <td>{{ $datos['apellido'] }}</td>
                    <td>{{ $datos['correo'] }}</td>
                    <td>{{ $datos['username'] }}</td>
                    <td>{{ $datos['telefono'] }}</td>
                    <td>{{ $datos['rol'] }}</td>
                    <td>{{ $datos['deleted_at'] }}</td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <form method="POST" action="{{ route('eliminarUsuario', ['username' => $datos['username']]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar Usuario</button>
        </form>
        <br>
        <a href="{{ route('editarUsuario', ['username' => $user->username]) }}">Editar Usuario</a>
        <form action="{{ route('auth.logout') }}" method="GET">
            @csrf
            <button id="botonLogout" type="submit">Cerrar sesión</button>
        </form>
</body>

</html>
