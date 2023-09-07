<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lote - Buscar Lote</title>
</head>
<body>
    <a href="{{ route('vistaLote') }}">Volver al menú principal</a>
    <h1>Bienvenido a Buscar Lote</h1>
    <h2>Informacion del lote:</h2>
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
        <br><br>
        <form method="POST" action="{{ route('eliminarLote', ['id' => $lote->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar Lote</button>
        </form><br>
        <a href="{{ route('editarLote', ['id' => $lote->id]) }}">Editar Lote</a>
</body>
</html>