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
            </tr>
        </thead>
        <tbody>
            @foreach ($chofer as $chofer)
                <tr>
                    <td>{{ $chofer->ci }}</td>
                    <td>{{ $chofer->nombre }}</td>
                    <td>{{ $chofer->apellido }}</td>
                    <td>{{ $chofer->correo }}</td>
                    <td>{{ $chofer->username }}</td>
                    <td>{{ $chofer->telefono }}</td>
                    <td>{{ $chofer->rol }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>