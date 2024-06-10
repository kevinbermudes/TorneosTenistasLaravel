<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenistas en el Primer Torneo</title>
</head>
<body>
<h1>Tenistas en el Primer Torneo</h1>
@if($tenistas->isEmpty())
<p>No hay tenistas inscritos en este torneo.</p>
@else
<ul>
    @foreach ($tenistas as $tenista)
    <li>
        {{ $tenista->id }} {{ $tenista->nombre }} {{ $tenista->apellido }} - Ranking: {{ $tenista->ranking }}
        @if($tenista->torneos->isNotEmpty())
        - Torneos:
        @foreach ($tenista->torneos as $torneo)
        {{ $torneo->idsecundario }},
        @endforeach
        @endif
    </li>
    @endforeach
</ul>
@endif
</body>
</html>

