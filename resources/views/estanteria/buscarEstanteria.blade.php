<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar Estanteria</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>

<body>
    <a href="{{ route('vistaEstante') }}">Volver al menú de Estanteria</a><br>
    <h2>Bienvenido a Buscar Estanteria</h2>
    <h2>Informacion del estanteria:</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Almacen</th>
                <th>ID Paquete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $datos['ID'] }}</td>
                <td>{{ $datos['ID_Almacen'] }}</td>
                <td>{{ $datos['ID_Paquete'] }}</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <form method="POST"
    action="{{ route('eliminarEstante', ['id' => $datos['ID'], 'almacen' => $datos['ID_Almacen']]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar Estanteria</button>
    </form><br>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>

</html>
