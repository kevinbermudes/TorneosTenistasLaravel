<!-- resources/views/tenista/create.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Columna izquierda: Formulario de creación de tenista -->
        <div class="col-md-8">
            <h2>Crear Nuevo Tenista</h2>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('tenistas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="pais">País</label>
                    <input type="text" class="form-control" id="pais" name="pais" value="{{ old('pais') }}" required>
                </div>

                <div class="form-group">
                    <label for="FechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="FechaNacimiento" name="FechaNacimiento"
                           value="{{ old('FechaNacimiento') }}" required>
                </div>

                <div class="form-group">
                    <label for="Altura">Altura (cm)</label>
                    <input type="number" class="form-control" id="Altura" name="Altura" value="{{ old('Altura') }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="peso">Peso (kg)</label>
                    <input type="number" class="form-control" id="peso" name="peso" value="{{ old('peso') }}" required>
                </div>

                <div class="form-group">
                    <label for="Mano">Mano</label>
                    <select class="form-control" id="Mano" name="Mano" required>
                        <option value="">Seleccione una opción</option>
                        <option value="derecha" {{ old(
                        'Mano') == 'derecha' ? 'selected' : '' }}>Derecha</option>
                        <option value="izquierda" {{ old(
                        'Mano') == 'izquierda' ? 'selected' : '' }}>Izquierda</option>
                        <option value="ambidiestro" {{ old(
                        'Mano') == 'ambidiestro' ? 'selected' : '' }}>Ambidiestro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="reves">Revés</label>
                    <select class="form-control" id="reves" name="reves" required>
                        <option value="">Seleccione una opción</option>
                        <option value="una mano" {{ old(
                        'reves') == 'una mano' ? 'selected' : '' }}>Una mano</option>
                        <option value="dos manos" {{ old(
                        'reves') == 'dos manos' ? 'selected' : '' }}>Dos manos</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="entrenador">Entrenador</label>
                    <input type="text" class="form-control" id="entrenador" name="entrenador"
                           value="{{ old('entrenador') }}" required>
                </div>

                <div class="form-group">
                    <label for="totalDineroGanado">Total Dinero Ganado</label>
                    <input type="number" class="form-control" id="totalDineroGanado" name="totalDineroGanado"
                           value="{{ old('totalDineroGanado') }}" required>
                </div>

                <div class="form-group">
                    <label for="numeroVictorias">Número de Victorias</label>
                    <input type="number" class="form-control" id="numeroVictorias" name="numeroVictorias"
                           value="{{ old('numeroVictorias') }}" required>
                </div>

                <div class="form-group">
                    <label for="numeroDerrortas">Número de Derrotas</label>
                    <input type="number" class="form-control" id="numeroDerrortas" name="numeroDerrortas"
                           value="{{ old('numeroDerrortas') }}" required>
                </div>

                <div class="form-group">
                    <label for="puntos">Puntos</label>
                    <input type="number" class="form-control" id="puntos" name="puntos" value="{{ old('puntos') }}"
                           required>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">Crear Tenista</button>
            </form>
        </div>

        <!-- Columna derecha: Carrusel y Top 10 tenistas -->
        <div class="col-md-4">

            <h3>Top 3 Tenistas</h3>
            <div id="carouselTopThree" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($topThreeTenistas as $index => $tenista)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        @if (filter_var($tenista->imagen, FILTER_VALIDATE_URL))
                        <img src="{{ $tenista->imagen }}" alt="{{ $tenista->nombre }}"
                             class="img-fluid rounded-start" style="height: 300px; object-fit: cover;">
                        @else
                        <img src="{{ asset('storage/' . $tenista->imagen) }}" alt="{{ $tenista->nombre }}"
                             class="img-fluid rounded-start" style="height: 300px; object-fit: cover;">
                        @endif
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $tenista->nombre }} {{ $tenista->apellido }}</h5>
                            <p>Ranking: {{ $tenista->ranking }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselTopThree" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselTopThree" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- Lista del top 10 tenistas -->
            <h3 class="mt-4">Top 10 Tenistas</h3>
            <ul class="list-group">
                @foreach($topTenTenistas as $tenista)
                <li class="list-group-item">
                    <strong>{{ $tenista->nombre }} {{ $tenista->apellido }}</strong> - Ranking: {{ $tenista->ranking }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
