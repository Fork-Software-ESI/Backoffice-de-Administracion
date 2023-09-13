<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camion - Mostrar Camiones</title>
</head>
<body>
<a href="{{ route('vistaCamion') }}">Volver al menú de Camión</a>
    <h2>Lista de Camiones</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Matricula</th>
                <th>Capacidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($camion as $camiones)
                <tr>
                    <td>{{ $camiones->id }}</td>
                    <td>{{ $camiones->matricula }}</td>
                    <td>{{ $camiones->pesoMaximoKg }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>