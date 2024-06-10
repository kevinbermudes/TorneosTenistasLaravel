{{-- resources/views/includes/header.blade.php --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img
                src="https://static.vecteezy.com/system/resources/previews/023/154/090/original/atp-logo-symbol-blue-tournament-open-men-tennis-association-design-abstract-illustration-free-vector.jpg"
                alt="ATP" width="30" height="30" class="d-inline-block align-top">
            ATP
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tenistas.index') }}">Tenistas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('torneos.index') }}">Torneos</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                </li>
            </ul>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
            </li>
            @endif
            </ul>
        </div>
    </div>
</nav>
