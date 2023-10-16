<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chofer - Mostrar Usuarios</title>
    <link rel="stylesheet" href="/css/mostrarUsuarios.css">
</head>

<body>
    <a href="{{ route('vistaUsuario') }}" style="color: white">Volver al menú Usuario</a>
    <h1>Lista de choferes</h1>
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
            @foreach ($datos as $usuario)
                <tr>
                    <td>{{ $usuario['ci'] }}</td>
                    <td>{{ $usuario['nombre'] }}</td>
                    <td>{{ $usuario['apellido'] }}</td>
                    <td>{{ $usuario['correo'] }}</td>
                    <td>{{ $usuario['username'] }}</td>
                    <td>{{ $usuario['telefono'] }}</td>
                    <td>{{ $usuario['rol'] }}</td>
                    <td>{{ $usuario['deleted_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
