<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Paquete - Buscar Paquete</title>
</head>

<body>
    <a href="{{ route('vistaPaquete') }}">Volver al menú de Paquete</a><br>
    <h2>Bienvenido a Buscar Paquete</h2>
    <h2>Información del paquete:</h2>
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
                <th>Creado</th>
                <th>Actualizado</th>
                <th>Eliminado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paquete as $paq)
                <tr>
                    <td>{{ $paq->ID }}</td>
                    <td>{{ $paq->ID_Cliente }}</td>
                    <td>{{ $paq->Descripcion }}</td>
                    <td>{{ $paq->Peso_Kg }}</td>
                    <td>{{ $paq->ID_Estado }}</td>
                    <td>{{ $paq->Destino }}</td>
                    <td>{{ $paq->Codigo }}</td>
                    <td>{{ $paq->created_at }}</td>
                    <td>{{ $paq->updated_at }}</td>
                    <td>{{ $paq->deleted_at }}</td>
                    <td>
                        <form method="POST" action="{{ route('eliminarPaquete', ['id' => $paq->ID]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar Paquete</button>
                        </form>
                        <a href="{{ route('editarPaquete', ['id' => $paq->ID]) }}">Editar Paquete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
</body>

</html>
