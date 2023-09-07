<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camion - Mostrar Camiones</title>
</head>
<body>
    <h2>Lista de Camiones</h2>
    <table>
        <thead>
            <tr>
                <th>Matricula</th>
                <th>Capacidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($camion as $camion)
                <tr>
                    <td>{{ $camion->matricula }}</td>
                    <td>{{ $camion->pesoMaximoKg }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>