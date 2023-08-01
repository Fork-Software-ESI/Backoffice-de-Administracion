<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Bienvenido a Buscar Usuario</h2>
    <a href="{{ route('paquete.mostrarVistaPrincipalPaquete') }}">Volver al menú principal</a>
    <form action="{{ route('paquete.buscarPaquete') }}" method="post">
        @csrf
        <label for="id">Ingrese la id del paquete:</label>
        <input type="text" name="id" id="id" required>
        <button type="submit">Buscar</button>
    </form>
    <h2>Informacion del usuario:</h2>
    @if (isset($paquete))
        @if ($paquete)
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

            <a href="{{ route('paquete.eliminarPaquete', ['id' => $paquete->id]) }}">Eliminar Paquete</a> <br>
            <a href="{{ route('paquete.editarPaquete', ['id' => $paquete->id]) }}">Editar Paquete</a>
        @endif
    @elseif (isset($error))
        <p>{{ $error }}</p>
    @endif
</body>
</html>