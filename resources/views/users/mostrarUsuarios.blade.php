<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario - Mostrar Usuarios</title>
    <link rel="stylesheet" href="/css/mostrarUsuarios.css">
</head>

<body>
    <a href="{{ route('vistaUsuario') }}" style="color: white">Volver al menú Usuario</a>
    <h1>Lista de usuarios</h1>
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
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->ci }}</td>
                    <td>{{ $user->nombre }}</td>
                    <td>{{ $user->apellido }}</td>
                    <td>{{ $user->correo }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>{{ $user->rol }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
