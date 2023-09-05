<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar Almacen</title>
</head>
<body>
    <a href="{{ route('vistaAlmacen') }}">Volver al menú principal</a>
    <h2>Bienvenido a Buscar Almacen</h2>
    <h2>Informacion del almacen:</h2>
    @if (isset($almacen))
        @if ($almacen)
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Direccion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $almacen->id }}</td>
                        <td>{{ $almacen->direccion }}</td>
                    </tr>
                </tbody>
            </table>

            <a href="{{ route('almacen.eliminarAlmacen', ['id' => $almacen->id]) }}">Eliminar Almacen</a> <br>
            <a href="{{ route('editarAlmacen', ['id' => $almacen->id]) }}">Editar Almacen</a>
        @endif
    @elseif (isset($error))
        <p>{{ $error }}</p>
    @endif
</body>
</html>