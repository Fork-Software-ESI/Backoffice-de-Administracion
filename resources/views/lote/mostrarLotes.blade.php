<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mostrar Lotes</title>
</head>
<body>
    <h2>Lista de lotes</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lote as $lote)
                <tr>
                    <td>{{ $lote->id }}</td>
                    <td>{{ $lote->descripcion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</body>
</html>