@extends('app')

@section('title', 'Actualizar Imagen del Torneo')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Actualizar Imagen del Torneo</h1>

            <form action="{{ route('torneos.updateImage', $torneo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Imagen</button>
                <a href="{{ route('torneos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>

        </div>
    </div>
</div>

@endsection

