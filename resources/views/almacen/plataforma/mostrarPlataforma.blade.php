<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <a href="{{ route('vistaPlataforma') }}">Volver a plataforma</a>
    <h2>Bienvenido a Mostrar Plataforma</h2>
    <br>
    <table>
        <thead>
            <tr>
                <th>Numero</th>
                <th>ID_Almacen</th>
                <th>Camion</th>
                <th>Hora de llegada</th>
                <th>Hora de salida</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $plataformas)
                <tr>
                    <td>{{ $plataformas['Numero'] }}</td>
                    <td>{{ $plataformas['ID_Almacen'] }}</td>
                    <td>{{ $plataformas['Camion'] }}</td>
                    <td>{{ $plataformas['horaLlegada'] }}</td>
                    <td>{{ $plataformas['horaSalida'] }}</td>
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