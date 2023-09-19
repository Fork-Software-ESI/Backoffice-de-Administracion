<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paquete - Mostrar Paquetes</title>
</head>
<body>
    <a href="{{ route('vistaPaquete') }}">Volver al menú de Paquete</a><br>
    <h2>Lista de paquetes</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Peso_kg</th>
                <th>Lote_id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paquete as $paquete)
                <tr>
                    <td>{{ $paquete->id }}</td>
                    <td>{{ $paquete->descripcion }}</td>
                    <td>{{ $paquete->peso_kg }}</td>
                    <td>{{ $paquete->lote_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>