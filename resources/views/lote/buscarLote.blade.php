<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lote - Buscar Lote</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>

<body>
    <a href="{{ route('vistaLote') }}">Volver al menú principal</a>
    <h1>Bienvenido a Buscar Lote</h1>
    <h2>Informacion del lote:</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Actualizado</th>
                <th>Eliminado</th>
            </tr>
        </thead>
        <tbody>
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
                <td>{{ $lote->created_at }}</td>
                <td>{{ $lote->updated_at }}</td>
                <td>{{ $lote->deleted_at }}</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <form method="POST" action="{{ route('eliminarLote', ['id' => $lote->ID]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar Lote</button>
    </form><br>
    <a href="{{ route('editarLote', ['id' => $lote->ID]) }}">Editar Lote</a>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>

</html>
