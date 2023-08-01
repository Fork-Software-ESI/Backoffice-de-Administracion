<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar Estanteria</title>
</head>
<body>
    <h2>Bienvenido a Buscar Estanteria</h2>
    <a href="{{ route('estanteria.mostrarVistaPrincipalEstanteria') }}">Volver al menú principal</a>
    <form action="{{ route('estanteria.buscarEstanteria') }}" method="post">
        @csrf
        <label for="id">Ingrese la id de el estanteria:</label>
        <input type="number" name="id" required>
        <button type="submit">Buscar</button>
    </form>
    <h2>Informacion del estanteria:</h2>
    @if (isset($estanteria))
        @if ($estanteria)
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

            <a href="{{ route('estanteria.eliminarEstanteria', ['id' => $estanteria->id]) }}">Eliminar Estanteria</a> <br>
            <a href="{{ route('estanteria.editarEstanteria', ['id' => $estanteria->id]) }}">Editar Estanteria</a>
        @endif
    @elseif (isset($error))
        <p>{{ $error }}</p>
    @endif
</body>
</html>