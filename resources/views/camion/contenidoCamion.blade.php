<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('vistaBuscarCamion') }}">Volver al menú de Camión</a>
    <h2>Contenido Camion</h2>
    <table>
        <thead>
            <tr>
                {{-- <th>Id</th>
                <th>Matricula</th>
                <th>Peso Maximo en Kg</th>
                <th>Chofer Asignado</th> --}}
                <th>ID_Lote</th>
                <th>Descripcion</th>
                <th>Peso</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                {{-- <td>{{ $datosLote['id'] }}</td>
                <td>{{ $datosLote['matricula'] }}</td>
                <td>{{ $datosLote['pesoMaximoKg'] }}</td>
                <td>{{ $datosLote['chofer'] }}</td> --}}
                <td>{{ $datosLote['lote'] }}</td>
                <td>{{ $datosLote['descripcionLote'] }}</td>
                <td>{{ $datosLote['pesoLote'] }}</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>ID_Paquete</th>
                <th>Descripcion</th>
                <th>Peso</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $datosPaquete['paquete'] }}</td>
                <td>{{ $datosPaquete['descripcionPaquete'] }}</td>
                <td>{{ $datosPaquete['pesoPaquete'] }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>