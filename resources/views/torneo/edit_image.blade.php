@extends('app')

@section('title', 'Cambiar Imagen del Torneo')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 ">
            <h1 class="mb-4 d-flex justify-content-center">Cambiar Imagen del Torneo</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="d-flex justify-content-center mb-4">
                <div class="col-md-4 d-flex justify-content-center">
                    @if (filter_var($torneo->imagen, FILTER_VALIDATE_URL))
                    <img src="{{ $torneo->imagen }}" class="img-fluid rounded-start"
                         alt="{{ $torneo->nombre }}" style="height: 300px; object-fit: cover;">
                    @else
                    <img src="{{ asset('storage/' . $torneo->imagen) }}" class="img-fluid rounded-start"
                         alt="{{ $torneo->nombre }}" style="height: 300px; object-fit: cover;">
                    @endif
                </div>
            </div>
            <form action="{{ route('torneos.updateImage', $torneo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="imagen">Nueva Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Imagen</button>
                <a href="{{ route('torneos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
@endsection


