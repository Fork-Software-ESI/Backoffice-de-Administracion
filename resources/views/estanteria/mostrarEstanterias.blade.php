<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <a href="{{ route('vistaEstanteria') }}">Volver al menú de Estanteria</a><br>
    <h1>Mostrar Estanteria</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Almacen Id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estanteria as $estanteria)
                <tr>
                    <td>{{ $estanteria->id }}</td>
                    <td>{{ $estanteria->almacen_id }}</td>
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