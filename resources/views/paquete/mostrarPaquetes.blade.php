<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paquete - Mostrar Paquetes</title>
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
    <a href="{{ route('vistaPaquete') }}">Volver al menú de Paquete</a><br>
    <h2>Lista de paquetes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID_Cliente</th>
                <th>Descripcion</th>
                <th>Peso_Kg</th>
                <th>ID_Estado</th>
                <th>Destino</th>
                <th>Codigo</th>
                <th>ID Lote</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $paquete)
                <tr>
                    <td>{{ $paquete['ID'] }}</td>
                    <td>{{ $paquete['ID_Cliente'] }}</td>
                    <td>{{ $paquete['Descripcion'] }}</td>
                    <td>{{ $paquete['Peso_Kg'] }}</td>
                    <td>{{ $paquete['ID_Estado'] }}</td>
                    <td>{{ $paquete['Destino'] }}</td>
                    <td>{{ $paquete['Codigo'] }}</td>
                    <td>{{ $paquete['ID_Lote'] }}</td>
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
