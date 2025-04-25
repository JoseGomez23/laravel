<header>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <nav class="navbar">
        @if (Auth::check())
            <a href="{{ url('/') }}" class="userName">
                Benvingut, {{ Auth::user()->nomusuari }}
            </a>
        @else 
            <a href="{{ url('/') }}" class="userName">
                Cap sessio en actiu.
            </a>
        @endif
        </div>
        <ul class="llista">
            @if (Auth::check())
                <li><a class="llistaBotons" href="{{ url('../insert') }}">Inserir</a></li>
                <li><a class="llistaBotons" href="{{ url('/api') }}">Consultar l'api</a></li>
            @endif
            @if (Auth::check() && Auth::user()->admin)
                <li><a class="llistaBotons" href="{{ url('../bdUsers') }}">Usuaris</a></li>
            @endif
        </ul>
        <div>
            @if (Auth::check())
                <div class="navbar-user-photo">
                    <img src="{{ 'data:image/png;base64,' . base64_encode(Auth::user()->photo) }}" class="user-photo">
                    <div class="dropdown-menu">
                        <a href="{{ url('../userProfile') }}">Editar perfil</a>
                        <a href="{{ url('../logout') }}">Tancar sessió</a>
                    </div>
                </div>
            @else
                <div class="navbar-auth-buttons">
                    <a href="{{ url('/recuperar') }}" class="navbar-buttonLogin">Recuperar PWD</a>
                    <a href="{{ url('/login') }}" class="navbar-buttonLogin">Login</a>
                    <a href="{{ url('/register') }}" class="navbar-buttonRegister">Register</a>
                </div>
            @endif
        </div>
    </nav>
</header>
