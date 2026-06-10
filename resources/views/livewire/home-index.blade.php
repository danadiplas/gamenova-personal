{{-- resources/views/livewire/home-index.blade.php --}}
@section('title', 'Home')

<div>
    <div class="min-vh-100 bg-dark text-white">
        <!-- ============================== -->
        <!-- HERO SECTION -->
        <!-- ============================== -->
        <div class="hero-section border-bottom border-primary"
            style="background: linear-gradient(135deg, rgba(124, 58, 237, 0.15), rgba(236, 72, 153, 0.08));">
            <div class="container py-6">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold text-white mb-4">
                            Los <span class="text-primary">mejores juegos</span><br>
                            a un clic de distancia
                        </h1>
                        <p class="lead text-muted mb-4">
                            Descubre ofertas exclusivas, ediciones especiales y los lanzamientos más esperados del año.
                            Todo en un solo lugar.
                        </p>
                        <div class="d-flex flex-wrap gap-3 mb-5">
                            <a href="{{ route('productos') }}" class="btn btn-primary btn-lg px-4 py-3">
                                <i class="fas fa-gamepad me-2"></i>Explorar Catálogo
                            </a>
                            <a href="#ofertas" class="btn btn-outline-light btn-lg px-4 py-3">
                                <i class="fas fa-fire me-2"></i>Ver Ofertas
                            </a>
                        </div>

                        <!-- Estadísticas rápidas -->
                        <div class="row g-4">
                            <div class="col-4">
                                <div class="text-center">
                                    <h3 class="text-white mb-0">
                                        {{ \App\Models\Producto::where('activo', true)->count() }}+</h3>
                                    <p class="text-muted small mb-0">Juegos</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <h3 class="text-success mb-0">-70%</h3>
                                    <p class="text-muted small mb-0">Descuento máx.</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <h3 class="text-warning mb-0">24/7</h3>
                                    <p class="text-muted small mb-0">Soporte</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="position-relative">
                            <div class="rounded-4 overflow-hidden shadow-lg"
                                style="height: 280px; background: linear-gradient(45deg, #7c3aed 0%, #ec4899 100%);">
                                <div
                                    class="h-100 d-flex flex-column align-items-center justify-content-center text-white p-4">
                                    <i class="fas fa-gamepad fa-5x mb-3 opacity-75"></i>
                                    <h4 class="mb-2">OFERTA ESPECIAL</h4>
                                    <p class="mb-0 text-center">Hasta 50% de descuento en juegos seleccionados</p>
                                </div>
                            </div>
                            <!-- Badge flotante -->
                            <div class="position-absolute top-0 end-0 translate-middle-y me-4">
                                <span class="badge bg-warning text-dark p-2 fs-6">
                                    <i class="fas fa-bolt me-1"></i>FLASH
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================== -->
        <!-- CATEGORÍAS DESTACADAS -->
        <!-- ============================== -->
        <div class="container py-5" id="categorias">
            <h2 class="h1 text-white text-center mb-5">
                <i class="fas fa-layer-group me-2 text-primary"></i>Explora por Género
            </h2>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
                @php
                    $categoriasDestacadas = $categorias->take(6); // Mostrar 6 categorías
                @endphp
                @foreach ($categoriasDestacadas as $cat)
                    <div class="col">
                        <a href="{{ route('productos') }}?categoria={{ $cat->id }}"
                            class="text-decoration-none category-card">
                            <div class="card bg-tarjetas border-secondary h-100 hover-lift">
                                <div class="card-body text-center py-4 px-2">
                                    <div class="display-5 mb-3">
                                        @php
                                            $icono = match (strtolower($cat->nombre)) {
                                                'acción', 'accion' => '🎮',
                                                'rpg', 'rol' => '⚔️',
                                                'deportes', 'sports' => '⚽',
                                                'estrategia' => '♟️',
                                                'carreras', 'racing' => '🏎️',
                                                'aventura' => '🗺️',
                                                'shooter' => '🔫',
                                                'indie' => '🎨',
                                                'simulación', 'simulacion' => '✈️',
                                                default => '🎯',
                                            };
                                        @endphp
                                        {{ $icono }}
                                    </div>
                                    <h6 class="text-white mb-0">{{ $cat->nombre }}</h6>
                                    <small class="text-muted">
                                        @php
                                            $count = \App\Models\Producto::where('categoria_id', $cat->id)
                                                ->where('activo', true)
                                                ->count();
                                        @endphp
                                        {{ $count }} juegos
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('productos') }}" class="btn btn-outline-primary btn-lg px-5">
                    Ver catálogo completo <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <!-- ============================== -->
        <!-- ÚLTIMOS LANZAMIENTOS -->
        <!-- ============================== -->
        @php
            $ultimosLanzamientos = \App\Models\Producto::where('activo', true)
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
        @endphp

        @if ($ultimosLanzamientos->count() > 0)
            <div class="bg-tarjetas py-5 border-top border-bottom border-secondary">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="h2 text-white">
                                <i class="fas fa-rocket me-2 text-primary"></i>Últimos Lanzamientos
                            </h2>
                            <p class="text-muted mb-0">Los juegos más recientes en nuestro catálogo</p>
                        </div>
                        <a href="{{ route('productos') }}?sort=nuevos"
                            class="btn btn-link text-primary text-decoration-none">
                            Ver todos <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                        @foreach ($ultimosLanzamientos as $juego)
                            <div class="col">
                                <div class="card bg-dark border-secondary h-100 product-card-sm">
                                    <!-- Imagen -->
                                    <div class="position-relative" style="height: 150px; overflow: hidden;">
                                        @if ($juego->imagen_principal)
                                            <img src="{{ Vite::asset('resources/images/games/' . $juego->imagen_principal) }}"
                                                class="card-img-top h-100 w-100" alt="{{ $juego->nombre }}"
                                                style="object-fit: cover;">
                                        @else
                                            <div
                                                class="h-100 d-flex align-items-center justify-content-center bg-primary bg-opacity-10">
                                                <i class="fas fa-gamepad fa-2x text-primary"></i>
                                            </div>
                                        @endif
                                        <!-- Badge "Nuevo" -->
                                        <span class="position-absolute top-0 start-0 m-2 badge bg-primary">
                                            <i class="fas fa-star me-1"></i>Nuevo
                                        </span>
                                    </div>

                                    <!-- Info -->
                                    <div class="card-body">
                                        <h6 class="card-title text-white text-truncate">{{ $juego->nombre }}</h6>
                                        <p class="card-text small text-muted text-truncate mb-2">
                                            {{ $juego->plataforma }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span
                                                class="badge bg-info">{{ $juego->categoria->nombre ?? 'General' }}</span>
                                            <span
                                                class="h6 text-white mb-0">${{ number_format($juego->precio, 2) }}</span>
                                        </div>
                                        <button wire:click="agregarAlCarrito({{ $juego->id }})"
                                            class="btn btn-sm btn-primary w-100 mt-3">
                                            <i class="fas fa-cart-plus me-1"></i>Añadir al carrito
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- ============================== -->
        <!-- OFERTAS FLASH -->
        <!-- ============================== -->
        @php
            $ofertasFlash = \App\Models\Producto::where('activo', true)
                ->whereNotNull('precio_rebajado')
                ->whereColumn('precio_rebajado', '<', 'precio')
                ->orderByRaw('(precio - precio_rebajado) DESC')
                ->take(4)
                ->get();
        @endphp

        @if ($ofertasFlash->count() > 0)
            <div class="container py-5" id="ofertas">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="h2 text-white">
                            <i class="fas fa-bolt me-2 text-warning"></i>Ofertas Flash
                        </h2>
                        <p class="text-muted mb-0">Descuentos por tiempo limitado</p>
                    </div>
                    <div class="text-end">
                        <div class="d-flex align-items-center text-warning">
                            <i class="fas fa-clock me-2"></i>
                            <div class="text-center">
                                <div class="fs-4 fw-bold" id="countdown-hours">24</div>
                                <div class="small">horas</div>
                            </div>
                            <div class="mx-2">:</div>
                            <div class="text-center">
                                <div class="fs-4 fw-bold" id="countdown-minutes">59</div>
                                <div class="small">minutos</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    @foreach ($ofertasFlash as $oferta)
                        <div class="col">
                            <div class="card bg-dark border-warning h-100 product-card-sm offer-card">
                                <!-- Ribbon de descuento -->
                                <div class="position-absolute top-0 end-0">
                                    @php
                                        $descuento = round(
                                            (($oferta->precio - $oferta->precio_rebajado) / $oferta->precio) * 100,
                                        );
                                    @endphp
                                    <span class="badge bg-danger p-2 rounded-start-0">
                                        -{{ $descuento }}%
                                    </span>
                                </div>

                                <!-- Imagen -->
                                <div class="position-relative" style="height: 150px; overflow: hidden;">
                                    @if ($oferta->imagen_principal)
                                        <img src="{{ Vite::asset('resources/images/games/' . $oferta->imagen_principal) }}"
                                            class="card-img-top h-100 w-100" alt="{{ $oferta->nombre }}"
                                            style="object-fit: cover;">
                                    @else
                                        <div
                                            class="h-100 d-flex align-items-center justify-content-center bg-warning bg-opacity-10">
                                            <i class="fas fa-fire fa-2x text-warning"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Info -->
                                <div class="card-body">
                                    <h6 class="card-title text-white text-truncate">{{ $oferta->nombre }}</h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="text-decoration-line-through text-muted me-2">
                                            ${{ number_format($oferta->precio, 2) }}
                                        </span>
                                        <span class="h5 text-success mb-0">
                                            ${{ number_format($oferta->precio_rebajado, 2) }}
                                        </span>
                                    </div>
                                    <button wire:click="agregarAlCarrito({{ $oferta->id }})"
                                        class="btn btn-sm btn-warning text-dark w-100">
                                        <i class="fas fa-cart-plus me-1"></i>Aprovechar Oferta
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Botón para ver más ofertas -->
                <div class="text-center mt-5">
                    <a href="{{ route('productos') }}?sort=descuento" class="btn btn-outline-warning btn-lg">
                        Ver todas las ofertas <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        @endif

        <!-- ============================== -->
        <!-- LLAMADA A LA ACCIÓN FINAL -->
        <!-- ============================== -->
        <div class="bg-tarjetas py-5 border-top border-primary">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="h1 text-white mb-3">¿Listo para empezar?</h2>
                        <p class="lead text-muted mb-4">
                            Explora nuestro catálogo completo con más de
                            {{ \App\Models\Producto::where('activo', true)->count() }} juegos,
                            filtros avanzados y las mejores ofertas.
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('productos') }}" class="btn btn-primary btn-lg px-5 py-3">
                            <i class="fas fa-gamepad me-2"></i>Ir al Catálogo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================== -->
    <!-- ESTILOS ADICIONALES -->
    <!-- ============================== -->
    <style>
        /* Estilos existentes */
        .bg-tarjetas {
            background-color: #0f172a !important;
        }

        .text-danger-soft {
            color: #ef4444 !important;
        }

        .product-card-sm {
            transition: all 0.3s ease;
            border: 1px solid #2d3748 !important;
        }

        .product-card-sm:hover {
            border-color: #7c3aed !important;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.2) !important;
        }

        .category-card .card {
            transition: all 0.3s ease;
            border: 1px solid #2d3748;
        }

        .category-card .card:hover {
            border-color: #7c3aed;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.2);
        }

        .hover-lift {
            transition: transform 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        .offer-card {
            border: 1px solid #f59e0b !important;
        }

        .offer-card:hover {
            border-color: #fbbf24 !important;
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3) !important;
        }

        .hero-section {
            position: relative;
            overflow: hidden;
        }
    </style>

    <!-- ============================== -->
    <!-- SCRIPT PARA CONTADOR DE OFERTAS -->
    <!-- ============================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Contador para ofertas flash (24 horas desde ahora)
            function updateCountdown() {
                const now = new Date();
                const endTime = new Date(now.getTime() + 24 * 60 * 60 * 1000); // 24 horas desde ahora

                const timeRemaining = endTime - now;

                if (timeRemaining <= 0) {
                    document.getElementById('countdown-hours').textContent = '00';
                    document.getElementById('countdown-minutes').textContent = '00';
                    return;
                }

                const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));

                document.getElementById('countdown-hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('countdown-minutes').textContent = minutes.toString().padStart(2, '0');
            }

            // Actualizar cada minuto
            updateCountdown();
            setInterval(updateCountdown, 60000);
        });
    </script>
</div>
