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
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $paquete->ID }}</td>
                <td>{{ $paquete->ID_Cliente }}</td>
                <td>{{ $paquete->Descripcion }}</td>
                <td>{{ $paquete->Peso_Kg }}</td>
                <td>{{ $paquete->ID_Estado }}</td>
                <td>{{ $paquete->Destino }}</td>
                <td>{{ $paquete->Codigo }}</td>
                <td>{{ $paquete->created_at }}</td>
                <td>{{ $paquete->updated_at }}</td>
                <td>{{ $paquete->deleted_at }}</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <form method="POST" action="{{ route('eliminarPaquete', ['id' => $paquete->ID]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar Paquete</button>
    </form>
    <a href="{{ route('editarPaquete', ['id' => $paquete->ID]) }}">Editar Paquete</a>    

</body>

</html>
