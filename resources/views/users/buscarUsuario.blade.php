<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users - Buscar Usuario</title>
</head>
<body>
    <h1>Bienvenido a Buscar Usuario</h1>
    <form action="" method="post"> 
        @csrf
        <label for="username">Ingrese el username del usuario:</label>
        <input type="text" name="username" id="username" required>
        <button type="submit">Buscar</button>
    </form>
    <h2>Informacion del usuario:</h2>
    @if(isset($user))
        @if($user)
            <h2>Informacion del usuario:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Username</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->ci }}</td>
                        <td>{{ $user->nombre }}</td>
                        <td>{{ $user->apellido }}</td>
                        <td>{{ $user->correo }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->telefono }}</td>
                    </tr>
                </tbody>
            </table>

        @else
            <p>Usuario no encontrado</p>
        @endif
    @endif
</body>
</html>