{{-- resources/views/tenista/deleted.blade.php --}}
@extends('app')

@section('title', 'Tenistas Eliminados')

@section('content')
<div class="container">
    <h1 class="mb-4">Tenistas Eliminados</h1>
    <a href="{{ route('tenistas.index') }}" class="btn btn-secondary mb-4">Volver a la Lista</a>

    @if($tenistas->isEmpty())
    <p>No hay tenistas eliminados.</p>
    @else
    <div class="row">
        @foreach($tenistas as $tenista)
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if (filter_var($tenista->imagen, FILTER_VALIDATE_URL))
                        <img src="{{ $tenista->imagen }}" alt="{{ $tenista->nombre }}"
                             class="img-fluid rounded-start" style="height: 294px; object-fit: cover;">
                        @else
                        <img src="{{ asset('storage/' . $tenista->imagen) }}" alt="{{ $tenista->nombre }}"
                             class="img-fluid rounded-start" style="height: 294px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body" style="background-color: #89a1c0">
                            <h5 class="card-title">{{ $tenista->nombre }} {{ $tenista->apellido }}</h5>
                            <p class="card-text">{{ $tenista->pais }}</p>
                            <p class="card-text"><small class="text-muted">Ranking: {{ $tenista->ranking }}</small></p>
                            <p class="card-text"><small class="text-muted">Puntos: {{ $tenista->puntos }}</small></p>
                            <p class="card-text"><small class="text-muted">Altura: {{ $tenista->Altura }} cm</small></p>
                            <p class="card-text"><small class="text-muted">Peso: {{ $tenista->peso }} kg</small></p>
                            <form action="{{ route('tenistas.restore', $tenista->id) }}" method="POST"
                                  style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary btn-sm">Recuperar</button>
                            </form>
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
