{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-tarjetas border-primary">
                    <div class="card-body">
                        <!-- Bienvenida -->
                        <div class="text-center mb-5">
                            <div class="display-1 text-primary mb-3">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <h1 class="h2 text-white">Bienvenido a GameNova</h1>
                            <p class="lead text-muted">Hola, {{ Auth::user()->name }}!</p>
                        </div>

                        <!-- Estadísticas -->
                        <div class="row mb-5">
                            <div class="col-md-4 mb-4">
                                <div class="card bg-dark border-primary text-center h-100">
                                    <div class="card-body">
                                        <i class="fas fa-gamepad fa-3x text-primary mb-3"></i>
                                        <h5 class="text-white mb-2">Juegos Disponibles</h5>
                                        <p class="h2 text-white mb-0">
                                            {{ \App\Models\Producto::where('activo', true)->count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="card bg-dark border-primary text-center h-100">
                                    <div class="card-body">
                                        <i class="fas fa-shopping-cart fa-3x text-warning mb-3"></i>
                                        <h5 class="text-white mb-2">En tu Carrito</h5>
                                        <p class="h2 text-white mb-0">
                                            {{ \App\Models\CarritoItem::where('user_id', Auth::id())->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="card bg-dark border-primary text-center h-100">
                                    <div class="card-body">
                                        <i class="fas fa-star fa-3x text-warning mb-3"></i>
                                        <h5 class="text-white mb-2">Destacados</h5>
                                        <p class="h2 text-white mb-0">
                                            {{ \App\Models\Producto::where('destacado', true)->where('activo', true)->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Acciones rápidas -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card bg-dark border-primary h-100">
                                    <div class="card-body">
                                        <h4 class="text-white mb-4">
                                            <i class="fas fa-bolt me-2 text-primary"></i>Acciones Rápidas
                                        </h4>
                                        <div class="list-group list-group-flush">
                                            <a href="{{ route('productos') }}"
                                                class="list-group-item list-group-item-action bg-dark text-white border-bottom border-secondary">
                                                <i class="fas fa-gamepad me-3 text-primary"></i>
                                                <div>
                                                    <div class="fw-bold">Explorar Catálogo</div>
                                                    <small class="text-muted">Descubre nuevos juegos</small>
                                                </div>
                                            </a>
                                            <a href="{{ route('carrito') }}"
                                                class="list-group-item list-group-item-action bg-dark text-white border-bottom border-secondary">
                                                <i class="fas fa-shopping-cart me-3 text-warning"></i>
                                                <div>
                                                    <div class="fw-bold">Ver Carrito</div>
                                                    <small class="text-muted">Gestiona tu compra</small>
                                                </div>
                                            </a>
                                            <a href="{{ route('stats') }}"
                                                class="list-group-item list-group-item-action bg-dark text-white">
                                                <i class="fas fa-user-edit me-3 text-success"></i>
                                                <div>
                                                    <div class="fw-bold">Mi Perfil</div>
                                                    <small class="text-muted">Actualiza tu información</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="card bg-dark border-primary h-100">
                                    <div class="card-body">
                                        <h4 class="text-white mb-4">
                                            <i class="fas fa-fire me-2 text-danger"></i>Juegos Destacados
                                        </h4>
                                        @php
                                            $destacados = \App\Models\Producto::where('destacado', true)
                                                ->where('activo', true)
                                                ->limit(3)
                                                ->get();
                                        @endphp

                                        @if ($destacados->count() > 0)
                                            <div class="list-group list-group-flush">
                                                @foreach ($destacados as $destacado)
                                                    <a href="{{ route('catalogo') }}"
                                                        class="list-group-item list-group-item-action bg-dark text-white border-bottom border-secondary">
                                                        <div class="d-flex align-items-center">
                                                            <div class="me-3">
                                                                <i class="fas fa-gamepad text-primary"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="fw-bold">{{ $destacado->nombre }}</div>
                                                                <small class="text-muted">{{ $destacado->plataforma }} •
                                                                    ${{ $destacado->precio }}</small>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="badge bg-warning text-dark">Destacado</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted text-center py-3">No hay juegos destacados disponibles.
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mensaje final -->
                        <div class="text-center mt-5 pt-4 border-top border-secondary">
                            <p class="text-muted">
                                <i class="fas fa-info-circle me-2"></i>
                                Explora todas las funcionalidades de GameNova desde el menú superior.
                            </p>
                            <a href="{{ route('catalogo') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-rocket me-2"></i>Comenzar a Explorar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Estilos -->
<style>
    .bg-tarjetas {
        background-color: #0f172a !important;
    }

    .card.bg-dark {
        background-color: #0a0e27 !important;
    }

    .border-primary {
        border-color: #7c3aed !important;
    }

    .border-secondary {
        border-color: #2d3748 !important;
    }

    .list-group-item.bg-dark:hover {
        background-color: rgba(124, 58, 237, 0.1) !important;
    }
</style>
