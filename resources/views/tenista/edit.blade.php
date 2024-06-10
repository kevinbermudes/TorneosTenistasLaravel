@extends('app')

@section('title', 'Editar Tenista')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Editar Tenista</h1>

            <form action="{{ route('tenistas.update', $tenista->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre', $tenista->nombre) }}" required>
                    @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror"
                           value="{{ old('apellido', $tenista->apellido) }}" required>
                    @error('apellido')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ranking">Ranking</label>
                    <input type="number" name="ranking" class="form-control @error('ranking') is-invalid @enderror"
                           value="{{ old('ranking', $tenista->ranking) }}" required>
                    @error('ranking')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pais">País</label>
                    <input type="text" name="pais" class="form-control @error('pais') is-invalid @enderror"
                           value="{{ old('pais', $tenista->pais) }}" required>
                    @error('pais')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="FechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" name="FechaNacimiento"
                           class="form-control @error('FechaNacimiento') is-invalid @enderror"
                           value="{{ old('FechaNacimiento', $tenista->FechaNacimiento->format('Y-m-d')) }}" required>
                    @error('FechaNacimiento')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Altura">Altura (cm)</label>
                    <input type="number" name="Altura" step="0.01"
                           class="form-control @error('Altura') is-invalid @enderror"
                           value="{{ old('Altura', $tenista->Altura) }}" required>
                    @error('Altura')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="peso">Peso (kg)</label>
                    <input type="number" name="peso" step="0.01"
                           class="form-control @error('peso') is-invalid @enderror"
                           value="{{ old('peso', $tenista->peso) }}" required>
                    @error('peso')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Mano">Mano</label>
                    <select name="Mano" class="form-control @error('Mano') is-invalid @enderror" required>
                        <option value="derecha" {{ old(
                        'Mano', $tenista->Mano) == 'derecha' ? 'selected' : '' }}>Derecha</option>
                        <option value="izquierda" {{ old(
                        'Mano', $tenista->Mano) == 'izquierda' ? 'selected' : '' }}>Izquierda</option>
                        <option value="ambidiestro" {{ old(
                        'Mano', $tenista->Mano) == 'ambidiestro' ? 'selected' : '' }}>Ambidiestro</option>
                    </select>
                    @error('Mano')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reves">Revés</label>
                    <select name="reves" class="form-control @error('reves') is-invalid @enderror" required>
                        <option value="una mano" {{ old(
                        'reves', $tenista->reves) == 'una mano' ? 'selected' : '' }}>Una mano</option>
                        <option value="dos manos" {{ old(
                        'reves', $tenista->reves) == 'dos manos' ? 'selected' : '' }}>Dos manos</option>
                    </select>
                    @error('reves')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="entrenador">Entrenador</label>
                    <input type="text" name="entrenador" class="form-control @error('entrenador') is-invalid @enderror"
                           value="{{ old('entrenador', $tenista->entrenador) }}" required>
                    @error('entrenador')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="totalDineroGanado">Total Dinero Ganado</label>
                    <input type="number" name="totalDineroGanado"
                           class="form-control @error('totalDineroGanado') is-invalid @enderror"
                           value="{{ old('totalDineroGanado', $tenista->totalDineroGanado) }}" required>
                    @error('totalDineroGanado')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="numeroVictorias">Número de Victorias</label>
                    <input type="number" name="numeroVictorias"
                           class="form-control @error('numeroVictorias') is-invalid @enderror"
                           value="{{ old('numeroVictorias', $tenista->numeroVictorias) }}" required>
                    @error('numeroVictorias')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="numeroDerrortas">Número de Derrotas</label>
                    <input type="number" name="numeroDerrortas"
                           class="form-control @error('numeroDerrortas') is-invalid @enderror"
                           value="{{ old('numeroDerrortas', $tenista->numeroDerrortas) }}" required>
                    @error('numeroDerrortas')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="puntos">Puntos</label>
                    <input type="number" name="puntos" class="form-control @error('puntos') is-invalid @enderror"
                           value="{{ old('puntos', $tenista->puntos) }}" required>
                    @error('puntos')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('tenistas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header" style="background-color: #0056b3">
                    <h2>{{ $tenista->nombre }} {{ $tenista->apellido }}</h2>
                </div>
                <div class="card-body" style="background-color: #89a1c0">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            @if (filter_var($tenista->imagen, FILTER_VALIDATE_URL))
                            <img src="{{ $tenista->imagen }}" alt="{{ $tenista->nombre }}"
                                 class="img-fluid rounded-start" style="height: 300px; object-fit: cover;">
                            @else
                            <img src="{{ asset('storage/' . $tenista->imagen) }}" alt="{{ $tenista->nombre }}"
                                 class="img-fluid rounded-start" style="height: 300px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <p><strong>Ranking:</strong> {{ $tenista->ranking }}</p>
                            <p><strong>País:</strong> {{ $tenista->pais }}</p>
                            <p><strong>Fecha de Nacimiento:</strong> {{ $tenista->FechaNacimiento->format('d-m-Y') }}
                            </p>
                            <p><strong>Edad:</strong> {{ $tenista->edad }}</p>
                            <p><strong>Altura:</strong> {{ $tenista->Altura }} cm</p>
                            <p><strong>Peso:</strong> {{ $tenista->peso }} kg</p>
                            <p><strong>Mano:</strong> {{ $tenista->Mano }}</p>
                            <p><strong>Revés:</strong> {{ $tenista->reves }}</p>
                            <p><strong>Entrenador:</strong> {{ $tenista->entrenador }}</p>
                            <p><strong>Total Dinero Ganado:</strong> ${{ number_format($tenista->totalDineroGanado, 2)
                                }}</p>
                            <p><strong>Victorias:</strong> {{ $tenista->numeroVictorias }}</p>
                            <p><strong>Derrotas:</strong> {{ $tenista->numeroDerrortas }}</p>
                            <p><strong>Puntos:</strong> {{ $tenista->puntos }}</p>
                        </div>
                    </div>
                </div>
            </div>

         
            <h2>Top 10 Tenistas</h2>
            <ul class="list-group">
                @foreach($topTenTenistas as $tenista)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $tenista->nombre }} {{ $tenista->apellido }}
                    <span class="badge bg-primary rounded-pill">{{ $tenista->ranking }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
