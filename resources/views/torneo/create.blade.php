@extends('app')

@section('title', 'Crear Torneo')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">Crear Torneo</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('torneos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}"
                           required>
                </div>

                <div class="form-group mb-3">
                    <label for="modalidad">Modalidad</label>
                    <select name="modalidad" id="modalidad" class="form-control" required>
                        <option value="">Seleccione una modalidad</option>
                        <option value="individual" {{ old(
                        'modalidad') == 'individual' ? 'selected' : '' }}>Individual</option>
                        <option value="dobles" {{ old(
                        'modalidad') == 'dobles' ? 'selected' : '' }}>Dobles</option>
                        <option value="mixto" {{ old(
                        'modalidad') == 'mixto' ? 'selected' : '' }}>Mixto</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="superficie">Superficie</label>
                    <select name="superficie" id="superficie" class="form-control" required>
                        <option value="">Seleccione una superficie</option>
                        <option value="dura" {{ old(
                        'superficie') == 'dura' ? 'selected' : '' }}>Dura</option>
                        <option value="arcilla" {{ old(
                        'superficie') == 'arcilla' ? 'selected' : '' }}>Arcilla</option>
                        <option value="hierba" {{ old(
                        'superficie') == 'hierba' ? 'selected' : '' }}>Hierba</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="categoria">Categoría</label>
                    <select name="categoria" id="categoria" class="form-control" required>
                        <option value="">Seleccione una categoría</option>
                        <option value="atp 250" {{ old(
                        'categoria') == 'atp 250' ? 'selected' : '' }}>ATP 250</option>
                        <option value="atp 500" {{ old(
                        'categoria') == 'atp 500' ? 'selected' : '' }}>ATP 500</option>
                        <option value="atp 1000" {{ old(
                        'categoria') == 'atp 1000' ? 'selected' : '' }}>ATP 1000</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="vacantes">Vacantes</label>
                    <input type="number" name="vacantes" id="vacantes" class="form-control"
                           value="{{ old('vacantes') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="premios">Premios</label>
                    <input type="number" name="premios" id="premios" class="form-control" value="{{ old('premios') }}"
                           required>
                </div>

                <div class="form-group mb-3">
                    <label for="fechaInicio">Fecha de inicio</label>
                    <input type="date" name="fechaInicio" id="fechaInicio" class="form-control"
                           value="{{ old('fechaInicio') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="fechaFin">Fecha de fin</label>
                    <input type="date" name="fechaFin" id="fechaFin" class="form-control" value="{{ old('fechaFin') }}"
                           required>
                </div>


                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('torneos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
