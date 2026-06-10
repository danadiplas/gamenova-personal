{{-- resources/views/components/navigation.blade.php --}}
@php
    $cartCount = auth()->check() ? \App\Models\CarritoItem::where('user_id', auth()->id())->count() : 0;
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-primary sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('catalogo') }}">
            <!-- Logo directo del build -->
            <img src="{{ Vite::asset('resources/images/logo/icon.png') }}" alt="GameNova Logo" height="35" width="35"
                class="me-2">

            <!-- Texto -->
            <div class="d-flex flex-column">
                <span class="fw-bold fs-4 lh-1">
                    <span class="text-primary">GAME</span><span class="text-danger">NOVA</span>
                </span>
                <small class="text-muted" style="font-size: 0.7rem; margin-top: -2px;">Video Games</small>
            </div>
        </a>

        <!-- Botón móvil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú -->
        <div class="collapse navbar-collapse" id="navbarNav">
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
                            <a class="dropdown-item text-white hover-rosa" href="{{ route('productos') }}?sort=nuevos">
                                <i class="fas fa-rocket me-2"></i>Nuevos Lanzamientos
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-white hover-rosa" href="{{ route('productos') }}?sort=ofertas">
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
            <form action="{{ route('productos') }}" method="GET" class="d-flex me-3">
                <div class="input-group" style="min-width: 250px;">
                    <input type="text" name="search"
                        class="form-control form-control-sm bg-tarjetas text-white border-secondary"
                        placeholder="Buscar juegos..." value="{{ request('search') }}" aria-label="Buscar juegos">
                    <button class="btn btn-primary btn-sm" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    @if (request('search'))
                        <a href="{{ route('productos') }}" class="btn btn-outline-secondary btn-sm"
                            title="Limpiar búsqueda">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>

            <!-- Usuario / Login -->
            @auth
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown">
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
                        @if (Auth::user()->rol == 'admin')
                            <li>
                                <a class="dropdown-item text-white hover-rosa"
                                    href="{{ filament()->getPanel('admin')->getUrl() }}">
                                    <i class="fa fa-table" aria-hidden="true"></i>
                                    Panel de administración
                                </a>
                            </li>
                        @endif

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

<style>
    .bg-tarjetas {
        background-color: #0f172a !important;
    }

    .hover-rosa:hover {
        background-color: rgba(236, 72, 153, 0.1) !important;
        color: #ec4899 !important;
    }

    .hover-rojo:hover {
        background-color: rgba(239, 68, 68, 0.1) !important;
        color: #ef4444 !important;
    }

    .dropdown-menu.bg-dark {
        background-color: #0f172a !important;
    }

    .dropdown-item.text-white {
        color: #ffffff !important;
    }

    .dropdown-item:hover {
        background-color: rgba(124, 58, 237, 0.1) !important;
    }
</style>
