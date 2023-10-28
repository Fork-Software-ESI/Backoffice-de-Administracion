<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('vistaPlataforma') }}">Volver a plataforma</a>
    <h2>Bienvenido a Mostrar Plataforma</h2>
    <br>
    <table>
        <thead>
            <tr>
                <th>Numero</th>
                <th>ID_Almacen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $plataformas)
                <tr>
                    <td>{{ $plataformas['Numero'] }}</td>
                    <td>{{ $plataformas['ID_Almacen'] }}</td>
                    <td>{{ $plataformas['Camion'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>