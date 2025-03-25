<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Tienda de Juegos')</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <body>
        <nav class="menu-top">
            <div class="container">
                <ul class="navbar-nav justify-content-end flex-row">
                    <li class="list-inline-item phone">
                        <a href="tel:+34640279463">640279463</a>
                    </li>
                    <li class="list-inline-item linkedin">
                        <a href="https://www.linkedin.com/in/ivan-arasco-millan/" target="_blank">LinkedIn</a>
                    </li>

                    @guest
                        <li class="list-inline-item login">
                            <a class="btn btn-secondary" href="{{ route('login') }}" target="_blank">Iniciar sesión</a>
                        </li>
                        <li class="list-inline-item register">
                            <a class="btn btn-primary" href="{{ route('register') }}" target="_blank">¿Nuevo usuario?</a>
                        </li>
                    @endguest

                    @auth
                        <li class="list-inline-item saldo">
                            <span id="saldo-usuario">Saldo: ${{ session('saldo', 0) }}</span>
                        </li>

                        <li class="list-inline-item logout">
                            <a class="btn btn-danger" href="{{ route('logout') }}" target="_blank">Cerrar sesión</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        @yield('header')

        <main class="main-content">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="footer">
            <div class="container">
                <div class="d-flex menu-bot"></div>
            </div>
        </footer>
    </body>
</html>