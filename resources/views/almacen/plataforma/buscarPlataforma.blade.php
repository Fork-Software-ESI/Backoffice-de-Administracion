<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar Plataforma</title>
</head>
<body>
    <a href="{{ route('vistaPlataforma') }}">Volver al menú de Plataforma</a>
    <h2>Bienvenido a Buscar Plataforma</h2>
    <h2>Informacion del Plataforma:</h2>
        <table>
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>ID Almacen</th>
                    <th>Camion</th>
                    <th>Hora llegada</th>
                    <th>Hora Salida</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>deleted_at</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $datos['Numero'] }}</td>
                    <td>{{ $datos['ID_Almacen'] }}</td>
                    <td>{{ $datos['Camion'] }}</td>
                    <td>{{ $datos['horaLlegada'] }}</td>
                    <td>{{ $datos['horaSalida'] }}</td>
                    <td>{{ $datos['created_at'] }}</td>
                    <td>{{ $datos['updated_at'] }}</td>
                    <td>{{ $datos['deleted_at'] }}</td>
                </tr>
            </tbody>
        </table>
        <br><br>
        
        <form method="POST" action="{{ route('eliminarPlataforma', ['numero' => $datos['Numero']]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar Plataforma</button>
        </form><br>
</body>
</html>