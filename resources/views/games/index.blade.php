@extends('app')

@section('title', 'Enfrentamientos del Torneo')

@section('content')
<div class="container">
    <h1 class="mb-4">Enfrentamientos del Torneo {{ $torneo->nombre }}</h1>

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

    @if($games->isEmpty())
    <p>No hay enfrentamientos disponibles.</p>
    @else
    <div class="row">
        @foreach($games as $game)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ronda {{ $game->ronda }}</h5>
                    <p class="card-text">{{ $game->tenista1->nombre }} vs {{ $game->tenista2->nombre }}</p>
                    <p class="card-text"><strong>Ganador:</strong> {{ $game->ganador->nombre }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <a href="{{ route('torneos.index') }}" class="btn btn-primary mt-3">Volver</a>
</div>
@endsection
