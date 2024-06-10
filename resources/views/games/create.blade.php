@extends('app')

@section('title', 'Crear Enfrentamiento')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Enfrentamiento para el Torneo {{ $torneo->nombre }}</h1>
    <form action="{{ route('games.store', $torneo->id) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="tenista1_id">Tenista 1</label>
            <select name="tenista1_id" id="tenista1_id" class="form-control">
                @foreach($tenistas as $tenista)
                <option value="{{ $tenista->id }}">{{ $tenista->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="tenista2_id">Tenista 2</label>
            <select name="tenista2_id" id="tenista2_id" class="form-control">
                @foreach($tenistas as $tenista)
                <option value="{{ $tenista->id }}">{{ $tenista->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="round">Ronda</label>
            <input type="text" name="round" id="round" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Enfrentamiento</button>
        <a href="{{ route('games.index', $torneo->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
