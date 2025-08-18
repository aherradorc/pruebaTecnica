<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            Prueba Técnica
        </a>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <span class="nav-link">Hola, {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Cerrar sesión</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
