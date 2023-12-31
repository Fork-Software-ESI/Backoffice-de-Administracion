<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lote - Mostrar Lotes</title>
    <style>
        table,
        th,
        td {
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
    <h2>Lista de lotes</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lote as $lote)
                <tr>
                    <td>{{ $lote->ID }}</td>
                    <td>{{ $lote->Descripcion }}</td>
                    @if ($lote->ID_Estado == 1)
                        <td>Pendiente</td>
                    @elseif ($lote->ID_Estado == 2)
                        <td>Cargado</td>
                    @elseif ($lote->ID_Estado == 3)
                        <td>Entregado</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</body>

</html>
