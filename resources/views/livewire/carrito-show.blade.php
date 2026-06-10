{{-- resources/views/livewire/carrito-show.blade.php --}}
@section('title', 'Carrito')

<div>
    <div class="min-vh-100 bg-dark position-relative">
        <div class="container py-5">
            <!-- Título -->
            <div class="mb-5">
                <h1 class="display-5 fw-bold text-white mb-3">Carrito de Compras</h1>
                <p class="lead text-muted">Revisa y gestiona tu pedido</p>
            </div>

            @if ($cartItems && $cartItems->count() > 0)
                <div class="row">
                    <!-- Lista de productos -->
                    <div class="col-lg-8">
                        @foreach ($cartItems as $item)
                            <div class="card bg-tarjetas border-primary mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <!-- Imagen del producto -->
                                        <div class="col-md-3 mb-3 mb-md-0">
                                            @if ($item->producto)
                                                @php
                                                    // EXTRAE solo el nombre base SIN extensión
                                                    $imageName = $item->producto->imagen_principal;
                                                    $baseName = pathinfo($imageName, PATHINFO_FILENAME);

                                                    // Buscar el archivo CON hash en build/assets/
                                                    $imagePath = public_path('public/build/assets/');
                                                    $matchingFiles = glob($imagePath . '/' . $baseName . '-*.jpg');

                                                    if (!empty($matchingFiles)) {
                                                        // Tomar el primer archivo que coincida
                                                        $actualFile = basename($matchingFiles[0]);
                                                        $imageUrl = asset('public/build/assets/' . $actualFile);
                                                    } else {
                                                        // Fallback: usar placeholder
                                                        $imageUrl = null;
                                                    }
                                                @endphp

                                                @if ($imageUrl)
                                                    <!-- Mostrar imagen REAL -->
                                                    <img src="{{ $imageUrl }}" alt="{{ $item->producto->nombre }}"
                                                        class="img-fluid rounded border border-primary"
                                                        style="height: 120px; width: 100%; object-fit: cover;"
                                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                                    <!-- Fallback (oculto por defecto) -->
                                                    <div class="rounded bg-dark border border-primary d-flex flex-column align-items-center justify-content-center p-3"
                                                        style="height: 120px; width: 100%; display: none;">
                                                        <i class="fas fa-gamepad fa-2x text-primary mb-2"></i>
                                                        <span class="text-white small text-center">
                                                            {{ Str::limit($item->producto->nombre, 15) }}
                                                        </span>
                                                    </div>
                                                @else
                                                    <!-- Placeholder atractivo -->
                                                    <div class="rounded bg-gradient-dark d-flex flex-column align-items-center justify-content-center p-3"
                                                        style="height: 120px; width: 100%; background: linear-gradient(135deg, #0f172a, #1e293b); border: 2px solid #7c3aed;">
                                                        <i class="fas fa-gamepad fa-2x mb-2 text-primary"></i>
                                                        <span class="text-white small text-center fw-bold">
                                                            {{ Str::limit($item->producto->nombre, 15) }}
                                                        </span>
                                                        <span class="text-success small mt-1">
                                                            {{ number_format($item->producto->precio ?? 0, 2) }} €
                                                        </span>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>

                                        <!-- Información del producto -->
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <h5 class="card-title text-white mb-2">
                                                {{ $item->producto->nombre ?? 'Producto no disponible' }}
                                            </h5>

                                            @if ($item->producto)
                                                <p class="text-muted small mb-2">
                                                    {{ $item->producto->categoria->nombre ?? 'Sin categoría' }}
                                                </p>

                                                <!-- MÉTODO DE ENTREGA -->
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                                        @if ($item->metodo_entrega_carrito === 'digital')
                                                            <span
                                                                class="badge bg-success d-inline-flex align-items-center px-3 py-2">
                                                                <i class="fas fa-key me-2"></i> Clave Digital
                                                            </span>
                                                            <small class="text-muted">
                                                                <i class="fas fa-envelope me-1"></i> Recibirás la clave
                                                                por email
                                                            </small>
                                                        @elseif($item->metodo_entrega_carrito === 'recogida')
                                                            <span
                                                                class="badge bg-warning text-dark d-inline-flex align-items-center px-3 py-2">
                                                                <i class="fas fa-store me-2"></i> Recoger en tienda
                                                            </span>
                                                            <small class="text-muted">
                                                                @if ($item->tiendaRecogida)
                                                                    <i class="fas fa-map-marker-alt me-1"></i>
                                                                    {{ $item->tiendaRecogida->nombre ?? 'Tienda' }}
                                                                @else
                                                                    <i class="fas fa-map-marker-alt me-1"></i>
                                                                    Disponible hoy
                                                                @endif
                                                            </small>
                                                        @else
                                                            <span
                                                                class="badge bg-primary d-inline-flex align-items-center px-3 py-2">
                                                                <i class="fas fa-truck me-2"></i> Envío a domicilio
                                                            </span>
                                                            <small class="text-muted">
                                                                <i class="fas fa-calendar-alt me-1"></i> 3-5 días
                                                                laborables
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Controles y precio_carrito -->
                                        <div class="col-md-3">
                                            <div class="text-end">
                                                <!-- precio_carrito unitario -->
                                                <div class="mb-3">
                                                    <span class="h5 text-success fw-bold">
                                                        {{ number_format($item->producto->precio ?? 0, 2) }} €
                                                    </span>
                                                    <div class="text-muted small">cada uno</div>
                                                </div>

                                                <!-- Controles de cantidad -->
                                                <div class="d-flex align-items-center justify-content-end mb-3">
                                                    <div class="input-group input-group-sm" style="width: 120px;">
                                                        <button wire:click="decrementQuantity({{ $item->id }})"
                                                            class="btn btn-outline-secondary"
                                                            {{ $item->cantidad <= 1 ? 'disabled' : '' }}>
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <input type="text"
                                                            class="form-control text-center bg-dark text-white border-secondary"
                                                            value="{{ $item->cantidad }}" readonly>
                                                        <button wire:click="incrementQuantity({{ $item->id }})"
                                                            class="btn btn-outline-secondary">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Subtotal y eliminar -->
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="text-muted small">Subtotal:</div>
                                                        <div class="h6 text-white fw-bold">
                                                            {{ number_format(($item->producto->precio ?? 0) * $item->cantidad, 2) }}
                                                            €
                                                        </div>
                                                    </div>
                                                    <button wire:click="removeItem({{ $item->id }})"
                                                        class="btn btn-sm btn-link text-danger-soft">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Resumen del pedido - FIXED -->
                    <div class="col-lg-4">
                        <div class="sticky-summary">
                            <div class="card bg-tarjetas border-primary">
                                <div class="card-body">
                                    <h3 class="card-title text-white mb-4">
                                        <i class="fas fa-receipt me-2 text-primary"></i>Resumen del Pedido
                                    </h3>

                                    <!-- Detalles del resumen -->
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Subtotal:</span>
                                            <span class="text-white fw-bold">{{ number_format($total, 2) }} €</span>
                                        </div>

                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Envío:</span>
                                            <span class="text-white fw-bold">
                                                @if ($total > 50)
                                                    <span class="text-success">GRATIS</span>
                                                @else
                                                    2.99 €
                                                @endif
                                            </span>
                                        </div>

                                        @if ($total > 100)
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="text-muted">Descuento (10%):</span>
                                                <span class="text-success fw-bold">
                                                    -{{ number_format($total * 0.1, 2) }} €
                                                </span>
                                            </div>
                                        @endif

                                        <hr class="border-secondary my-3">

                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h5 mb-0 text-white">Total:</span>
                                            <span class="h3 mb-0 text-white fw-bold">
                                                @php
                                                    $envio = $total > 50 ? 0 : 2.99;
                                                    $descuento = $total > 100 ? $total * 0.1 : 0;
                                                    $totalFinal = $total + $envio - $descuento;
                                                @endphp
                                                {{ number_format($totalFinal, 2) }} €
                                            </span>
                                        </div>

                                        <div class="small text-muted mt-2">
                                            @if ($totalFinal < 50)
                                                <i class="fas fa-info-circle me-1 text-warning"></i>
                                                Añade {{ number_format(50 - $totalFinal, 2) }} € más para envío gratis
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Botones de acción -->
                                    <div class="d-grid gap-3">
                                        <button wire:click="irAPagar" class="btn btn-primary btn-lg py-3">
                                            <i class="fas fa-lock me-2"></i>Proceder al Pago
                                        </button>

                                        <a href="{{ route('catalogo') }}" class="btn btn-outline-light btn-lg py-3">
                                            <i class="fas fa-shopping-bag me-2"></i>Seguir Comprando
                                        </a>

                                        <button wire:click="clearCart" class="btn btn-outline-danger-soft btn-lg py-3">
                                            <i class="fas fa-trash-alt me-2"></i>Vaciar Carrito
                                        </button>
                                    </div>

                                    <!-- Información de seguridad -->
                                    <div class="mt-4 pt-4 border-top border-secondary">
                                        <div class="d-flex align-items-center text-muted small">
                                            <div class="me-3">
                                                <i class="fas fa-shield-alt fa-lg text-success"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-white">Compra 100% segura</div>
                                                <div class="small">Pago cifrado • Garantía de devolución • Soporte
                                                    24/7
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Carrito vacío -->
                <div class="card bg-tarjetas border-primary">
                    <div class="card-body py-5">
                        <div class="text-center py-5">
                            <div class="display-1 text-primary mb-4">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h3 class="h2 text-white mb-3">Tu carrito está vacío</h3>
                            <p class="text-muted lead mb-5">
                                Parece que aún no has añadido ningún juego a tu carrito.<br>
                                ¡Explora nuestro catálogo y descubre los mejores videojuegos!
                            </p>
                            <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                                <a href="{{ route('catalogo') }}" class="btn btn-primary btn-lg px-5 py-3">
                                    <i class="fas fa-gamepad me-2"></i>Explorar Videojuegos
                                </a>
                                <a href="{{ route('catalogo') }}?categoria=1"
                                    class="btn btn-outline-light btn-lg px-5 py-3">
                                    <i class="fas fa-fire me-2"></i>Ver Ofertas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Productos recomendados (opcional) -->
            @if ($cartItems && $cartItems->count() > 0)
                <div class="mt-5 pt-5 border-top border-secondary">
                    <h4 class="text-white mb-4">
                        <i class="fas fa-star me-2 text-warning"></i>Quizás te interese
                    </h4>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                        <!-- Producto recomendado 1 -->
                        <div class="col">
                            <div class="card bg-tarjetas border-secondary h-100">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-gamepad fa-3x text-primary"></i>
                                    </div>
                                    <h6 class="card-title text-white">Cyber Odyssey</h6>
                                    <p class="text-muted small">Acción futurista</p>
                                    <div class="h5 text-success mb-3">$49.99</div>
                                    <button class="btn btn-sm btn-primary w-100">
                                        <i class="fas fa-cart-plus me-1"></i>Añadir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Estilos adicionales -->
    <style>
        .bg-tarjetas {
            background-color: #0f172a !important;
        }

        .btn-outline-danger-soft {
            color: #ef4444;
            border-color: #ef4444;
        }

        .btn-outline-danger-soft:hover {
            background-color: #ef4444;
            color: white;
        }

        .card.border-primary {
            border-color: #7c3aed !important;
        }

        .badge.bg-info {
            background-color: rgba(124, 58, 237, 0.2) !important;
            color: #7c3aed !important;
            border: 1px solid rgba(124, 58, 237, 0.3);
        }

        .badge.bg-dark {
            background-color: rgba(15, 23, 42, 0.8) !important;
            color: #94a3b8 !important;
            border: 1px solid #2d3748;
        }

        .input-group .form-control.bg-dark {
            background-color: #0a0e27 !important;
            color: white !important;
        }

        .input-group .btn-outline-secondary {
            border-color: #2d3748;
            color: #94a3b8;
        }

        .input-group .btn-outline-secondary:hover {
            border-color: #7c3aed;
            background-color: rgba(124, 58, 237, 0.1);
            color: #7c3aed;
        }

        /* FIX PARA STICKY RESUMEN */
        .sticky-summary {
            position: sticky;
            top: calc(20px + 56px);
            z-index: 1035;
        }

        @media (max-width: 992px) {
            .sticky-summary {
                position: static;
                margin-top: 2rem;
            }
        }

        /* Mejoras visuales */
        .card {
            transition: all 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6d28d9, #db2777);
            transform: translateY(-1px);
        }
    </style>
</div>
