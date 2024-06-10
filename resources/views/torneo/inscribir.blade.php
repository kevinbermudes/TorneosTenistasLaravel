@extends('app')

@section('title', 'Inscribir Tenista')

@section('content')
<div class="container">
    <h1 class="mb-4">Inscribir Tenista en {{ $torneo->nombre }}</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('torneos.inscribir', $torneo->id) }}" method="GET" class="d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Buscar tenistas...">
        <button class="btn btn-primary me-2" type="submit">Buscar</button>
    </form>

    @if($tenistas->isEmpty())
    <p>No hay tenistas disponibles.</p>
    @else
    <div class="row">
        @foreach($tenistas as $tenista)
        <div class="col-md-4 mb-3">
            <div class="card h-100" style="background-color: #89a1c0">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $tenista->nombre }} {{ $tenista->apellido }}</h5>
                            <p class="card-text"><strong>Ranking:</strong> {{ $tenista->ranking }}</p>
                            <p class="card-text"><strong>País:</strong> {{ $tenista->pais }}</p>
                            <p class="card-text"><strong>Puntos:</strong> {{ $tenista->puntos }}</p>

                            @if($torneo->tenistas->contains($tenista->id))
                            <button class="btn btn-secondary mt-auto" disabled>Ya inscrito en este torneo</button>
                            @else
                            <form action="{{ route('torneos.inscribirTenista', $torneo->id) }}" method="POST"
                                  class="mt-auto">
                                @csrf
                                <input type="hidden" name="tenista_id" value="{{ $tenista->id }}">
                                <button type="submit" class="btn btn-primary">Inscribir</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if (filter_var($tenista->imagen, FILTER_VALIDATE_URL))
                        <img src="{{ $tenista->imagen }}" alt="{{ $tenista->nombre }}" class="img-fluid rounded-end"
                             style="height: 300px; object-fit: cover;">
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

    <div class="d-flex justify-content-center">
        {{ $tenistas->links('pagination::bootstrap-4') }}
    </div>
    @endif
    <a href="{{ route('torneos.index') }}" class="btn btn-primary mt-3">Volver</a>
</div>
@endsection
