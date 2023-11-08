<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lote - Mostrar Lotes</title>
</head>
<body>
    <h2>Lista de lotes</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Peso_Kg</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lote as $lote)
                <tr>
                    <td>{{ $lote->ID }}</td>
                    <td>{{ $lote->Descripcion }}</td>
                    <td>{{ $lote->Peso_Kg }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</body>
</html>