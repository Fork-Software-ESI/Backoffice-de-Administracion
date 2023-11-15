<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Almacen - Mostrar Almacen</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <h2>Lista de Almacenes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($almacen as $almacen)
                <tr>
                    <td>{{ $almacen->ID }}</td>
                    <td>{{ $almacen->Direccion }}</td>
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