<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camion - Mostrar Camiones</title>
    <style>
        table,th,td {
            border: 1px solid;
        }
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
<a href="{{ route('vistaCamion') }}">Volver al menú de Camión</a>
    <h2>Lista de Camiones</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Matricula</th>
                <th>Peso Maximo en Kg</th>
                <th>Chofer Asignado</th>
                <th>Almacen</th>
                <th>Plataforma</th>
                <th>Lote Asignado</th>
                <th>Fecha hora llegada</th>
                <th>Fecha hora salida</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $camiones)
                <tr>
                    <td>{{ $camiones['id'] }}</td>
                    <td>{{ $camiones['matricula'] }}</td>
                    <td>{{ $camiones['pesoMaximoKg'] }}</td>
                    <td>{{ $camiones['chofer'] }}</td>
                    <td>{{ $camiones['almacen'] }}</td>
                    <td>{{ $camiones['plataforma'] }}</td>
                    <td>{{ $camiones['lote'] }}</td>
                    <td>{{ $camiones['horaLlegada'] }}</td>
                    <td>{{ $camiones['horaSalida'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>