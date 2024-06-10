@extends('app')

@section('title', 'Torneos Eliminados')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-8">
            <h1 class="mb-4">Torneos Eliminados</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('torneos.index') }}" class="btn btn-primary">Volver a Lista de Torneos</a>
        </div>
    </div>

    @if($torneos->isEmpty())
    <p>No hay torneos eliminados.</p>
    @else
    <div class="row">
        @foreach($torneos as $torneo)
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if (filter_var($torneo->imagen, FILTER_VALIDATE_URL))
                        <img src="{{ $torneo->imagen }}" class="img-fluid rounded-start" alt="{{ $torneo->nombre }}"
                             style="height: 300px; object-fit: cover;">
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
                                <p class="card-text">Fecha de inicio: {{ $torneo->fechaInicio->format('d-m-Y') }}</p>
                                <p class="card-text">Fecha de fin: {{ $torneo->fechaFin->format('d-m-Y') }}</p>
                            </div>
                            <div>
                                <form action="{{ route('torneos.restore', $torneo->id) }}" method="POST"
                                      style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Restaurar</button>
                                </form>
                                <!-- Mostrar el UUID para depuración -->
                                <p>UUID: {{ $torneo->id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
