@extends('app')

@section('title', 'Editar Torneo')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Editar Torneo</h1>

            <form id="torneoForm" action="{{ route('torneos.update', $torneo->id) }}" method="POST"
                  enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                           value="{{ old('nombre', $torneo->nombre) }}" required>
                    <div class="invalid-feedback">El nombre del torneo es obligatorio.</div>
                </div>

                <div class="form-group mb-3">
                    <label for="modalidad">Modalidad</label>
                    <select name="modalidad" id="modalidad" class="form-control" required>
                        <option value="">Seleccione una modalidad</option>
                        <option value="individual" {{ old(
                        'modalidad', $torneo->modalidad) == 'individual' ? 'selected' : '' }}>Individual</option>
                        <option value="dobles" {{ old(
                        'modalidad', $torneo->modalidad) == 'dobles' ? 'selected' : '' }}>Dobles</option>
                        <option value="mixto" {{ old(
                        'modalidad', $torneo->modalidad) == 'mixto' ? 'selected' : '' }}>Mixto</option>
                    </select>
                    <div class="invalid-feedback">La modalidad del torneo es obligatoria.</div>
                </div>

                <div class="form-group mb-3">
                    <label for="superficie">Superficie</label>
                    <select name="superficie" id="superficie" class="form-control" required>
                        <option value="">Seleccione una superficie</option>
                        <option value="dura" {{ old(
                        'superficie', $torneo->superficie) == 'dura' ? 'selected' : '' }}>Dura</option>
                        <option value="arcilla" {{ old(
                        'superficie', $torneo->superficie) == 'arcilla' ? 'selected' : '' }}>Arcilla</option>
                        <option value="hierba" {{ old(
                        'superficie', $torneo->superficie) == 'hierba' ? 'selected' : '' }}>Hierba</option>
                    </select>
                    <div class="invalid-feedback">La superficie del torneo es obligatoria.</div>
                </div>

                <div class="form-group mb-3">
                    <label for="vacantes">Vacantes</label>
                    <input type="number" name="vacantes" id="vacantes" class="form-control"
                           value="{{ old('vacantes', $torneo->vacantes) }}" required>
                    <div class="invalid-feedback">Las vacantes del torneo son obligatorias y deben ser un número
                        positivo.
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="categoria">Categoría</label>
                    <select name="categoria" id="categoria" class="form-control" required>
                        <option value="">Seleccione una categoría</option>
                        <option value="atp 250" {{ old(
                        'categoria', $torneo->categoria) == 'atp 250' ? 'selected' : '' }}>ATP 250</option>
                        <option value="atp 500" {{ old(
                        'categoria', $torneo->categoria) == 'atp 500' ? 'selected' : '' }}>ATP 500</option>
                        <option value="atp 1000" {{ old(
                        'categoria', $torneo->categoria) == 'atp 1000' ? 'selected' : '' }}>ATP 1000</option>
                    </select>
                    <div class="invalid-feedback">La categoría del torneo es obligatoria.</div>
                </div>

                <div class="form-group mb-3">
                    <label for="premios">Premios</label>
                    <input type="number" name="premios" id="premios" class="form-control"
                           value="{{ old('premios', $torneo->premios) }}" required>
                    <div class="invalid-feedback">El campo premios es obligatorio y debe ser al menos 1.</div>
                </div>

                <div class="form-group mb-3">
                    <label for="fechaInicio">Fecha de inicio</label>
                    <input type="date" name="fechaInicio" id="fechaInicio" class="form-control"
                           value="{{ old('fechaInicio', $torneo->fechaInicio ? $torneo->fechaInicio->format('Y-m-d') : '') }}"
                           required>
                    <div class="invalid-feedback">La fecha de inicio es obligatoria y debe ser posterior o igual a
                        hoy.
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="fechaFin">Fecha de fin</label>
                    <input type="date" name="fechaFin" id="fechaFin" class="form-control"
                           value="{{ old('fechaFin', $torneo->fechaFin ? $torneo->fechaFin->format('Y-m-d') : '') }}"
                           required>
                    <div class="invalid-feedback">La fecha de fin es obligatoria y debe ser posterior o igual a la fecha
                        de inicio.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('torneos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
            <hr>
           
        </div>
    </div>
</div>

<script>
    (function () {
        'use strict';
        var form = document.getElementById('torneoForm');
        form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    })();
</script>
@endsection
