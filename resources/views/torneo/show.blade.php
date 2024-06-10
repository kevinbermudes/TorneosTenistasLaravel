@extends('app')

@section('title', 'Detalles del Torneo')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Torneo</h1>
    <div class="card mb-4" style="height: 288px">
        <div class="row g-0">
            <div class="col-md-4">
                @if (filter_var($torneo->imagen, FILTER_VALIDATE_URL))
                <img src="{{ $torneo->imagen }}" alt="{{ $torneo->nombre }}"
                     class="img-fluid rounded-start" style="height: 288px; object-fit: cover;width: 450px">
                @else
                <img src="{{ asset('storage/' . $torneo->imagen) }}" alt="{{ $torneo->nombre }}"
                     class="img-fluid rounded-start" style="height: 288px; object-fit: cover;width: 450px">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body" style="background-color: #89a1c0">
                    <h5 class="card-title">{{ $torneo->nombre }}</h5>
                    <p class="card-text">Fecha de Inicio: {{ $torneo->fechaInicio->format('d-m-Y') }}</p>
                    <p class="card-text">Fecha de Fin: {{ $torneo->fechaFin->format('d-m-Y') }}</p>
                    <p class="card-text">Superficie: {{ $torneo->superficie }}</p>
                    <p class="card-text">Modalidad: {{ $torneo->modalidad }}</p>
                    <p class="card-text">Categoría: {{ $torneo->categoria }}</p>
                    <p class="card-text">Premios: ${{ number_format($torneo->premios, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4">Tenistas Participantes</h2>
    @if($torneo->tenistas->isEmpty())
    <p>No hay tenistas inscritos en este torneo.</p>
    @else
    <div class="row">
        @foreach($torneo->tenistas as $tenista)
        <div class="col-md-4 mb-3">
            <div class="card h-100" style="background-color: #89a1c0">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $tenista->nombre }} {{ $tenista->apellido }}</h5>
                            <p class="card-text"><strong>Ranking:</strong> {{ $tenista->ranking }}</p>
                            <p class="card-text"><strong>País:</strong> {{ $tenista->pais }}</p>
                            <p class="card-text"><strong>Puntos:</strong> {{ $tenista->puntos }}</p>
                            <a href="{{ route('tenistas.show', $tenista->id) }}" class="btn btn-info mt-auto">Ver
                                Perfil</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if (filter_var($tenista->imagen, FILTER_VALIDATE_URL))
                        <img src="{{ $tenista->imagen }}" alt="{{ $tenista->nombre }}"
                             class="img-fluid rounded-end" style="height: 300px; object-fit: cover;">
                        @else
                        <img src="{{ asset('storage/' . $tenista->imagen) }}" alt="{{ $tenista->nombre }}"
                             class="img-fluid rounded-end" style="height: 300px; object-fit: cover;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    <a href="{{ route('torneos.index') }}" class="btn btn-primary mt-3">Volver</a>
</div>
@endsection
