<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Tenista</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #007BFF; /* Azul de Bootstrap */
            color: white;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            margin: 5px 0;
            color: white; /* Texto en blanco */
        }

        .image {
            width: 200px;
            text-align: center;
        }

        .image img {
            width: 200px;
            height: 300px;
            object-fit: cover;
            background-color: #f2f2f2;
            padding: 10px;
        }

        table {
            width: 100%;
            page-break-inside: avoid;
            background-color: #0056b3; /* Azul más oscuro para la tabla */
            color: white;
            padding: 20px;
            border-radius: 8px;
        }

        td {
            vertical-align: top;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Detalles del Tenista</h1>
</div>
<table>
    <tr>
        <td class="details">
            <p><strong>Nombre:</strong> {{ $tenista->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $tenista->apellido }}</p>
            <p><strong>Ranking:</strong> {{ $tenista->ranking }}</p>
            <p><strong>País:</strong> {{ $tenista->pais }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $tenista->FechaNacimiento->format('d-m-Y') }}</p>
            <p><strong>Edad:</strong> {{ $tenista->edad }}</p>
            <p><strong>Altura:</strong> {{ $tenista->Altura }} cm</p>
            <p><strong>Peso:</strong> {{ $tenista->peso }} kg</p>
            <p><strong>Mano:</strong> {{ $tenista->Mano }}</p>
            <p><strong>Revés:</strong> {{ $tenista->reves }}</p>
            <p><strong>Entrenador:</strong> {{ $tenista->entrenador }}</p>
            <p><strong>Total Dinero Ganado:</strong> ${{ number_format($tenista->totalDineroGanado, 2) }}</p>
            <p><strong>Victorias:</strong> {{ $tenista->numeroVictorias }}</p>
            <p><strong>Derrotas:</strong> {{ $tenista->numeroDerrortas }}</p>
            <p><strong>Puntos:</strong> {{ $tenista->puntos }}</p>
        </td>
        <td class="image">
            @if (filter_var($tenista->imagen, FILTER_VALIDATE_URL))
            <img src="{{ $tenista->imagen }}" alt="{{ $tenista->nombre }}">
            @else
            <img src="{{ asset('storage/' . $tenista->imagen) }}" alt="{{ $tenista->nombre }}">
            @endif
        </td>
    </tr>
</table>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
