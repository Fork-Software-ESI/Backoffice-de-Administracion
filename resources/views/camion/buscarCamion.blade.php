<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar Camion</title>
</head>
<body>
    <a href="{{ route('vistaCamion') }}">Volver al menú principal</a>
    <h2>Bienvenido a Buscar Camion</h2>
    <h2>Informacion del camión:</h2>
        <table>
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Peso Máximo Kg</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $camion->matricula }}</td>
                    <td>{{ $camion->pesoMaximoKg }}</td>
                </tr>
            </tbody>
        </table>
        <br><br>
        
        <form method="POST" action="{{ route('eliminarCamion', ['matricula' => $camion->matricula]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar Camión</button>
        </form><br>
        <a href="{{ route('editarCamion', ['matricula' => $camion->matricula]) }}">Editar Camión</a>
</body>
</html>