<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar Estanteria</title>
</head>
<body>
    <a href="{{ route('vistaEstante') }}">Volver al menú de Estanteria</a><br>
    <h2>Bienvenido a Buscar Estanteria</h2>
    <h2>Informacion del estanteria:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Id de almacen</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $estanteria->id }}</td>
                        <td>{{ $estanteria->almacen_id }}</td>
                    </tr>
                </tbody>
            </table>

            <form method="POST" action="{{ route('eliminarEstante', ['id' => $estanteria->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar Estanteria</button>
            </form><br>
            <a href="{{ route('editarEstante', ['id' => $estanteria->id]) }}">Editar Estanteria</a>
</body>
</html>