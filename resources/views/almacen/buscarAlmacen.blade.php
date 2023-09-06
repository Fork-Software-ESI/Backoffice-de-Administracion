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
        <br><br>
        
        <form method="POST" action="{{ route('eliminarAlmacen', ['id' => $almacen->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar Almacen</button>
        </form><br>
        <a href="{{ route('editarAlmacen', ['id' => $almacen->id]) }}">Editar Almacen</a>
</body>
</html>