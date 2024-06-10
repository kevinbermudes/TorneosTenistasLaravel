@extends('app')

@section('title', 'Lista de Torneos')

@php
use App\Models\Torneo;
@endphp
@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-8">
            <h1 class="mb-4">Lista de Torneos</h1>
        </div>
        <div class="col-md-4 text-end">
            @can('create', Torneo::class)
            <a href="{{ route('torneos.create') }}" class="btn btn-success">Crear Torneo</a>
            <a href="{{ route('torneos.deleted') }}" class="btn btn-warning">Torneos Eliminados</a>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div id="topThreeCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($topThreeTorneos as $index => $torneo)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="card mb-3" style="height: 300px; background-color: brown">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @if (filter_var($torneo->imagen, FILTER_VALIDATE_URL))
                                    <img src="{{ $torneo->imagen }}" alt="{{ $torneo->nombre }}"
                                         class="img-fluid rounded-start" style="height: 300px; object-fit: cover;">
                                    @else
                                    <img src="{{ asset('storage/' . $torneo->imagen) }}" alt="{{ $torneo->nombre }}"
                                         class="img-fluid rounded-start" style="height: 300px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body d-flex flex-column justify-content-between"
                                         style="background-color: #89a1c0">
                                        <div>
                                            <h5 class="card-title">{{ $torneo->nombre }}</h5>
                                            <p class="card-text">Fecha de inicio: {{
                                                $torneo->fechaInicio->format('d-m-Y') }}</p>
                                            <p class="card-text">Fecha de fin: {{ $torneo->fechaFin->format('d-m-Y')
                                                }}</p>
                                        </div>
                                        <div>
                                            <a href="{{ route('torneos.show', $torneo->id) }}"
                                               class="btn btn-info btn-sm">Ver</a>

                                        </div>
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
                    <form action="{{ route('torneos.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Buscar torneos..."
                               value="{{ request()->query('search') }}">
                        <button class="btn btn-primary me-2" type="submit">Buscar</button>
                    </form>
                </div>
            </div>

            @if($torneos->isEmpty())
            <p>No hay torneos disponibles.</p>
            @else
            <div class="row">
                @foreach($torneos as $torneo)
                <div class="col-md-12">
                    <div class="card mb-3" style="background-color: brown">
                        <div class="row g-0">
                            <div class="col-md-4">
                                @if (filter_var($torneo->imagen, FILTER_VALIDATE_URL))
                                <img src="{{ $torneo->imagen }}" class="img-fluid rounded-start"
                                     alt="{{ $torneo->nombre }}" style="height: 300px; object-fit: cover;">
                                @else
                                <img src="{{ asset('storage/' . $torneo->imagen) }}" class="img-fluid rounded-start"
                                     alt="{{ $torneo->nombre }}" style="height: 300px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column justify-content-between"
                                     style="background-color: #89a1c0">
                                    <div>
                                        <h5 class="card-title">{{ $torneo->nombre }}</h5>
                                        <p class="card-text"><strong>Fecha de inicio:</strong> {{
                                            $torneo->fechaInicio->format('d-m-Y') }}</p>
                                        <p class="card-text"><strong>Fecha de fin:</strong> {{
                                            $torneo->fechaFin->format('d-m-Y') }}</p>
                                    </div>
                                    <div>
                                        <a href="{{ route('torneos.show', $torneo->id) }}" class="btn btn-info btn-sm">Ver</a>
                                        @can('update', $torneo)
                                        <a href="{{ route('torneos.edit', $torneo->id) }}"
                                           class="btn btn-warning btn-sm">Editar</a>
                                        <a href="{{ route('torneos.editImage', $torneo->id) }}"
                                           class="btn btn-secondary btn-sm">Cambiar Imagen</a>
                                        <a href="{{ route('torneos.inscribir', $torneo->id) }}"
                                           class="btn btn-primary btn-sm">Inscribir</a>
                                        @endcan
                                        @can('delete', $torneo)
                                        <form action="{{ route('torneos.finalizar', $torneo->id) }}" method="POST"
                                              style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de que deseas finalizar este torneo?')">
                                                Finalizar Torneo
                                            </button>
                                        </form>
                                        <form action="{{ route('torneos.destroy', $torneo->id) }}" method="POST"
                                              style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este torneo?')">
                                                Eliminar
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                {{ $torneos->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <h2>Top 10 Torneos</h2>
            <ul class="list-group">
                @foreach($topTenTorneos as $torneo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $torneo->nombre }}
                    <span class="badge bg-primary rounded-pill">{{ $torneo->ranking }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
