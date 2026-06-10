<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=key_vertical" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=store" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <title>Gamenova - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="body-aplicacion">

    @php
        $cartCount = auth()->check() ? \App\Models\CarritoItem::where('user_id', auth()->id())->count() : 0;
    @endphp

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-primary sticky-top px-4">
        <div class="container mx-5 px-5">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('catalogo') }}">
                <!-- Logo directo del build -->
                <img src="{{ Vite::asset('resources/images/logo/icon.png') }}" alt="GameNova Logo" height="35"
                    width="35" class="me-2">

                <!-- Texto -->
                <div class="d-flex flex-column">
                    <span class="fw-bold fs-4 lh-1">
                        <span class="text-primary">GAME</span><span class="text-danger">NOVA</span>
                    </span>
                    <small class="text-muted" style="font-size: 0.7rem; margin-top: -2px;">Video Games</small>
                </div>
            </a>

            <!-- Menú -->
            <div class=" navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('catalogo') ? 'active' : '' }}"
                            href="{{ route('catalogo') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('carrito') ? 'active' : '' }}"
                                href="{{ route('carrito') }}">
                                <i class="fas fa-shopping-cart me-1"></i> Carrito
                                @if ($cartCount > 0)
                                    <span class="badge bg-danger ms-1">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>
                    @endauth

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-fire me-1"></i> Destacados
                        </a>
                        <ul class="dropdown-menu bg-dark border-primary">
                            <li>
                                <a class="dropdown-item text-white hover-rosa"
                                    href="{{ route('productos') }}?sort=nuevos">
                                    <i class="fas fa-rocket me-2"></i>Nuevos Lanzamientos
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white hover-rosa"
                                    href="{{ route('productos') }}?sort=ofertas">
                                    <i class="fas fa-percentage me-2"></i>Ofertas
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white hover-rosa"
                                    href="{{ route('productos') }}?sort=mas-vendidos">
                                    <i class="fas fa-chart-line me-2"></i>Más Vendidos
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider bg-secondary">
                            </li>
                            <li>
                                <a class="dropdown-item text-white hover-rosa" href="#ofertas">
                                    <i class="fas fa-bolt me-2 text-warning"></i>Ofertas Flash
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Buscador -->
                <form action="{{ route('productos') }}" method="GET" class="d-flex me-3 mt-2">
                    <div class="input-group" style="min-width: 260px;">
                        <input type="text" name="search"
                            class="form-control form-control-sm bg-tarjetas text-white border-secondary rounded-start h-25"
                            placeholder="Buscar juegos..." value="{{ request('search') }}" aria-label="Buscar juegos">
                        <button class="btn btn-primary btn-sm" type="submit" style="height: 35px">
                            <i class="fas fa-search"></i>
                        </button>
                        @if (request('search'))
                            <a href="{{ route('productos') }}" class="btn btn-outline-secondary btn-sm h-25"
                                title="Limpiar búsqueda">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Usuario / Login -->
                @auth
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#"
                            role="button" data-bs-toggle="dropdown">
                            <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px;">
                                <span class="text-white fw-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-primary">
                            <li>
                                <a class="dropdown-item text-white hover-rosa" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user me-2"></i>Mi Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white hover-rosa" href="{{ route('dashboard') }}">
                                    <i class="fas fa-chart-bar me-2"></i>Dashboard
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider bg-secondary">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger-soft hover-rojo">
                                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm hover-rosa">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-plus me-1"></i> Registro
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        @yield('titulo-pagina')
    </div>

    <div class="container rounded-4 m-5 p-4" id="aplicacion">
        @yield('content')
    </div>

    <div class="alert alert-danger alert-dismissible d-flex fadein d-none" role="alert" id="mensaje_error">
        <img src="{{ Vite::asset('resources/images/warning_20dp_842029_FILL1_wght400_GRAD0_opsz20.svg') }}"
            class="me-1">
        <span id="error-text"></span>
        <button type="button" class="btn-close" aria-label="Close" id="alert-button"></button>
    </div>

    <footer class="bg-dark text-white py-4 mt-5 border-top border-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>GameNova</h5>
                    <p class="small text-muted">Tu tienda de videojuegos favorita. Todos los derechos reservados © 2024
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
