<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paquete - Buscar Paquete</title>
</head>
<body>
    <a href="{{ route('vistaPaquete') }}">Volver al menú de Paquete</a><br>
    <h2>Bienvenido a Buscar Paquete</h2>
    <h2>Informacion del paquete:</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descripcion</th>
                    <th>Peso_Kg</th>
                    <th>Lote_Id</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $paquete->id }}</td>
                    <td>{{ $paquete->descripcion }}</td>
                    <td>{{ $paquete->peso_kg }}</td>
                    <td>{{ $paquete->lote_id }}</td>
                </tr>
            </tbody>
        </table>
        <br><br>
        
        <form method="POST" action="{{ route('eliminarPaquete', ['id' => $paquete->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar Paquete</button>
        </form><br>
        <a href="{{ route('editarPaquete', ['id' => $paquete->id]) }}">Editar Paquete</a>
</body>
</html>