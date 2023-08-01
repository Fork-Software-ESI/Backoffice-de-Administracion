<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lote - Buscar Lote</title>
</head>
<body>
    <h1>Bienvenido a Buscar Lote</h1>
    <a href="{{ route('lote.mostrarVistaPrincipalLote') }}">Volver al menú principal</a>
    <form action="{{ route('lote.buscarLote') }}" method="post">
        @csrf
        <label for="id">Ingrese la id de el lote:</label>
        <input type="text" name="id" required>
        <button type="submit">Buscar</button>
    </form>
    <h2>Informacion del lote:</h2>
    @if (isset($lote))
        @if ($lote)
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $lote->id }}</td>
                        <td>{{ $lote->descripcion }}</td>
                    </tr>
                </tbody>
            </table>

            <a href="{{ route('lote.eliminarLote', ['id' => $lote->id]) }}">Eliminar Lote</a> <br>
            <a href="{{ route('lote.editarLote', ['id' => $lote->id]) }}">Editar Lote</a>
        @endif
    @elseif (isset($error))
        <p>{{ $error }}</p>
    @endif
</body>
</html>