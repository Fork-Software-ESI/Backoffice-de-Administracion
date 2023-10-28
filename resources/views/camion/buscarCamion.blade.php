<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar Camion</title>
</head>
<body>
    <a href="{{ route('vistaCamion') }}">Volver al menú de Camión</a>
    <h2>Bienvenido a Buscar Camion</h2>
    <h2>Informacion del camión:</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Matricula</th>
                    <th>Peso Máximo Kg</th>
                    <th>Chofer Asignado</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Eliminado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $camiones['id'] }}</td>
                    <td>{{ $camiones['matricula'] }}</td>
                    <td>{{ $camiones['pesoMaximoKg'] }}</td>
                    <td>{{ $camiones['chofer'] }}</td>
                    <td>{{ $camiones['created_at'] }}</td>
                    <td>{{ $camiones['updated_at'] }}</td>
                    <td>{{ $camiones['deleted_at'] }}</td>
                </tr>
            </tbody>
        </table>
        <br><br>
        
        <form method="POST" action="{{ route('eliminarCamion', ['matricula' => $camiones['matricula']]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar Camión</button>
        </form><br>
        <a href="{{ route('editarCamion', ['matricula' => $camiones['matricula']]) }}">Editar Camión</a> <br>
        <a href="{{ route('contenidoCamion', ['matricula' => $camiones['matricula']]) }}">Ver Contenido</a>
</body>
</html>