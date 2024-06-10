@extends('app')

@section('title', 'Editar Imagen del Tenista')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Editar Imagen del Tenista</h1>

    <div class="d-flex justify-content-center mb-4">
        <div class="col-md-4">
            @if (filter_var($tenista->imagen, FILTER_VALIDATE_URL))
            <img src="{{ $tenista->imagen }}" alt="{{ $tenista->nombre }}" class="img-fluid rounded"
                 style="height: 312px; object-fit: cover;">
            @else
            <img src="{{ asset('storage/' . $tenista->imagen) }}" alt="{{ $tenista->nombre }}" class="img-fluid rounded"
                 style="height: 312px; object-fit: cover;">
            @endif
        </div>
    </div>

    <form action="{{ route('tenistas.updateImage', $tenista->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="imagen">Nueva Imagen</label>
            <input type="file" name="imagen" class="form-control @error('imagen') is-invalid @enderror" required>
            @error('imagen')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary me-2">Actualizar Imagen</button>
            <a href="{{ route('tenistas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@endsection
