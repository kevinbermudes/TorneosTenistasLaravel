<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Torneos</title>
</head>
<body>
<h1>Lista de Torneos</h1>
<table border="1">
    <thead>
    <tr>
        <th>ID Secundario</th>
        <th>Nombre</th>
        <th>Tenistas</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($torneos as $torneo)
    <tr>
        <td>{{ $torneo->idsecundario }}</td>
        <td>{{ $torneo->nombre }}</td>
        <td>
            <ul>
                @foreach ($torneo->tenistas as $tenista)
                <li>{{ $tenista->nombre }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
