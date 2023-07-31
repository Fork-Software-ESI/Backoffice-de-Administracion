<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Lista de Almacenes</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($almacen as $almacen)
                <tr>
                    <td>{{ $almacen->id }}</td>
                    <td>{{ $almacen->direccion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>