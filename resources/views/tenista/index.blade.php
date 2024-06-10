@extends('app')

@section('title', 'Lista de Tenistas')

@section('content')
@php
use App\Models\Tenista;
@endphp

<div class="container">
    <div class="row mb-3">
        <div class="col-md-8">
            <h1 class="mb-4">Lista de Tenistas</h1>
        </div>
        <div class="col-md-4 text-end">
            @can('create', Tenista::class)
            <a href="{{ route('tenistas.create') }}" class="btn btn-success">Crear Tenista</a>
            @endcan
            @can('viewDeleted', Tenista::class)
            <a href="{{ route('tenistas.deleted') }}" class="btn btn-warning">Tenistas Eliminados</a>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div id="topThreeCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($topThreeTenistas as $index => $tenista)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="card mb-3" style="height: 305px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @if (filter_var($tenista->imagen, FILTER_VALIDATE_URL))
                                    <img src="{{ $tenista->imagen }}" alt="{{ $tenista->nombre }}"
                                         class="img-fluid rounded-start" style="height: 300px; object-fit: cover;">
                                    @else
                                    <img src="{{ asset('storage/' . $tenista->imagen) }}" alt="{{ $tenista->nombre }}"
                                         class="img-fluid rounded-start" style="height: 300px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body" style="background-color: #89a1c0">
                                        <h5 class="card-title">{{ $tenista->nombre }} {{ $tenista->apellido }}</h5>
                                        <p class="card-text">Ranking: {{ $tenista->ranking }}</p>
                                        <p class="card-text">Puntos: {{ $tenista->puntos }}</p>
                                        <p class="card-text">País: {{ $tenista->pais }}</p>
                                        <p class="card-text">Altura: {{ $tenista->Altura }} cm</p>
                                        <p class="card-text">Peso: {{ $tenista->peso }} kg</p>
                                        <p class="card-text">Mano: {{ $tenista->Mano }}</p>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#topThreeCarousel"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#topThreeCarousel"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="{{ route('tenistas.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Buscar tenistas..."
                               value="{{ request()->query('search') }}">
                        <button class="btn btn-primary me-2" type="submit">Buscar</button>
                        <a href="{{ route('tenistas.index', ['order_by_ranking' => 1]) }}" class="btn btn-secondary">Filtrar
                            por Ranking</a>
                    </form>
                </div>
            </div>

            @if($tenistas->isEmpty())
            <p>No hay tenistas disponibles.</p>
            @else
            <div class="row">
                @foreach($tenistas as $tenista)
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                @if (filter_var($tenista->imagen, FILTER_VALIDATE_URL))
                                <img src="{{ $tenista->imagen }}" alt="{{ $tenista->nombre }}"
                                     class="img-fluid rounded-start" style="height: 300px; object-fit: cover;">
                                @else
                                <img src="{{ asset('storage/' . $tenista->imagen) }}" alt="{{ $tenista->nombre }}"
                                     class="img-fluid rounded-start" style="height: 300px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="background-color: #89a1c0">
                                    <h5 class="card-title">{{ $tenista->nombre }} {{ $tenista->apellido }}</h5>
                                    <p class="card-text">{{ $tenista->pais }}</p>
                                    <p class="card-text"><small class="text-muted">Ranking: {{ $tenista->ranking
                                            }}</small></p>
                                    <p class="card-text"><small class="text-muted">Puntos: {{ $tenista->puntos
                                            }}</small></p>
                                    <p class="card-text"><small class="text-muted">Altura: {{ $tenista->Altura }}
                                            cm</small></p>
                                    <p class="card-text"><small class="text-muted">Peso: {{ $tenista->peso }} kg</small>
                                    </p>
                                    <p class="card-text"><small class="text-muted">Win Ratio: {{
                                            number_format($tenista->win_ratio, 2) }}%</small></p>

                                    <a href="{{ route('tenistas.show', $tenista->id) }}"
                                       class="btn btn-info btn-sm">Ver</a>
                                    @can('update', $tenista)
                                    <a href="{{ route('tenistas.edit', $tenista->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    @endcan
                                    @can('delete', $tenista)
                                    <form action="{{ route('tenistas.destroy', $tenista->id) }}" method="POST"
                                          style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        @if($tenista->torneos()->count() > 0)
                                        <button type="button" class="btn btn-danger btn-sm" disabled>No se puede
                                            eliminar
                                        </button>
                                        @else
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este tenista?')">
                                            Eliminar
                                        </button>
                                        @endif
                                    </form>
                                    @endcan
                                    @can('update', $tenista)
                                    <a href="{{ route('tenistas.editImage', $tenista->id) }}"
                                       class="btn btn-secondary btn-sm">Editar Imagen</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                {{ $tenistas->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <h2>Top 10 Tenistas</h2>
            <ul class="list-group">
                @foreach($topTenTenistas as $tenista)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $tenista->nombre }} {{ $tenista->apellido }}
                    <span class="badge bg-primary rounded-pill">{{ $tenista->ranking }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
