@extends('app')

@section('title', 'Detalles del Tenista')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Tenista</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4" style="background-color: #0056b3">
                <div class="card-header">
                    <h2>{{ $tenista->nombre }} {{ $tenista->apellido }}</h2>
                </div>
                <div class="card-body" style="background-color: #89a1c0">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            @if (filter_var($tenista->imagen, FILTER_VALIDATE_URL))
                            <img src="{{ $tenista->imagen }}" alt="{{ $tenista->nombre }}" class="img-thumbnail">
                            @else
                            <img src="{{ asset('storage/' . $tenista->imagen) }}" alt="{{ $tenista->nombre }}"
                                 class="img-thumbnail">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <p><strong>Ranking:</strong> {{ $tenista->ranking }}</p>
                            <p><strong>País:</strong> {{ $tenista->pais }}</p>
                            <p><strong>Fecha de Nacimiento:</strong> {{ $tenista->FechaNacimiento->format('d-m-Y') }}
                            </p>
                            <p><strong>Edad:</strong> {{ $tenista->edad }}</p>
                            <p><strong>Altura:</strong> {{ $tenista->Altura }} cm</p>
                            <p><strong>Peso:</strong> {{ $tenista->peso }} kg</p>
                            <p><strong>Mano:</strong> {{ $tenista->Mano }}</p>
                            <p><strong>Revés:</strong> {{ $tenista->reves }}</p>
                            <p><strong>Entrenador:</strong> {{ $tenista->entrenador }}</p>
                            <p><strong>Total Dinero Ganado:</strong> ${{ number_format($tenista->totalDineroGanado, 2)
                                }}</p>
                            <p><strong>Victorias:</strong> {{ $tenista->numeroVictorias }}</p>
                            <p><strong>Derrotas:</strong> {{ $tenista->numeroDerrortas }}</p>
                            <p><strong>Puntos:</strong> {{ $tenista->puntos }}</p>
                            <p class="card-text"><strong>Win Ratio:</strong> {{ number_format($tenista->win_ratio, 2)
                                }}%</p>

                        </div>
                    </div>
                    <a href="{{ route('tenistas.index') }}" class="btn btn-secondary">Volver a la lista</a>
                    <a href="{{ route('tenista.pdf', $tenista->id) }}" class="btn btn-primary">Generar PDF</a>

                </div>
            </div>

            <h3 class="mb-3">Torneos en los que participa</h3>
            <div class="row">
                @foreach($torneos as $torneo)
                <div class="col-md-4 mb-3">
                    <a href="{{ route('torneos.show', $torneo->id) }}" class="text-decoration-none text-dark">
                        <div class="card">
                            <img src="{{ $torneo->imagen }}" class="card-img-top" alt="{{ $torneo->nombre }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $torneo->nombre }}</h5>
                                <p class="card-text">Fecha de Inicio: {{ $torneo->fechaInicio->format('d-m-Y') }}</p>
                                <p class="card-text">Fecha de Fin: {{ $torneo->fechaFin->format('d-m-Y') }}</p>
                                <p class="card-text">Superficie: {{ $torneo->superficie }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-4">
            <h3 class="mb-3">Carrusel de Tenistas</h3>
            <div id="tenistaCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($carouselTenistas as $index => $carouselTenista)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="d-flex justify-content-center align-items-center bg-secondary"
                             style="height: 300px;">
                            @if (filter_var($carouselTenista->imagen, FILTER_VALIDATE_URL))
                            <img src="{{ $carouselTenista->imagen }}" alt="{{ $carouselTenista->nombre }}"
                                 class="img-fluid rounded" style="height: 100%; object-fit: cover;">
                            @else
                            <img src="{{ asset('storage/' . $carouselTenista->imagen) }}"
                                 alt="{{ $carouselTenista->nombre }}"
                                 class="img-fluid rounded" style="height: 100%; object-fit: cover;">
                            @endif
                        </div>
                        <div class="carousel-caption d-none d-md-block" style="color: black;">
                            <h5>{{ $carouselTenista->nombre }} {{ $carouselTenista->apellido }}</h5>
                            <p>Ranking: {{ $carouselTenista->ranking }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#tenistaCarousel"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#tenistaCarousel"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <h3 class="mb-3">Top 10 Tenistas</h3>
            <ul class="list-group">
                @foreach($topTenTenistas as $topTenista)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $topTenista->nombre }} {{ $topTenista->apellido }}
                    <span class="badge bg-primary rounded-pill">{{ $topTenista->ranking }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
