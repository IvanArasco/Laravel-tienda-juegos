<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            @yield('title', 'Tienda de Juegos')
        </title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/filtergenres.js') }}"></script>
    </head>
    
    <body>
        <nav class="menu-top">
            <div class="container">
                <ul class="navbar-nav align-items-center justify-content-end flex-row">
                    <li class="list-inline-item linkedin">
                        <a class="btn btn-primary" href="https://www.linkedin.com/in/ivan-arasco-millan/" target="_blank">LinkedIn</a>
                    </li>

                    @guest
                        <li class="list-inline-item login">
                            <a class="btn btn-success" href="{{ route('login') }}">Iniciar sesión</a>
                        </li>
                        <li class="list-inline-item register">
                            <a class="btn btn-primary" href="{{ route('register') }}">¿Nuevo usuario?</a>
                        </li>
                    @endguest

                    @auth
                      
                        <li class="list-inline-item logout">
                            <a class="btn btn-danger" href="{{ route('logout') }}">Cerrar sesión</a>
                        </li>

                        <li class="ms-3 list-inline-item balance">
                            <span id="user-balance">Saldo: {{ auth()->user()->balance }} € </span>
                        </li>

                        <li class="ms-3 list-inline-item cart">
                            <a href="{{ route('cart.show') }}" class="btn btn-primary" id="cart">Ver Carrito</a>
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