<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paquete - Mostrar Paquetes</title>
</head>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
        color: #000000;
        font-family: monospace;
        font-size: 25px;
        text-align: left;
    }
    th {
        background-color: #000000;
        color: white;
    }
    tr:nth-child(even) {background-color: #f2f2f2}
</style>

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
                <th>Creado</th>
                <th>Actualizado</th>
                <th>Eliminado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paquete as $paquete)
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
            @endforeach
        </tbody>
    </table>
</body>
</html>