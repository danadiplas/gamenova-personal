{{-- @section('title', 'Método de Entrega') --}}

<div>
    <div class="min-vh-100" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);">
        <div class="container py-5">
            <!-- Breadcrumb -->
            <nav class="mb-4" aria-label="breadcrumb">
                <ol class="breadcrumb bg-dark border border-purple-500 rounded p-3"
                    style="border-color: #7c3aed !important;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('catalogo') }}" class="text-muted text-decoration-none">
                            <i class="fas fa-home me-1"></i> Inicio
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('catalogo') }}" class="text-muted text-decoration-none">
                            <i class="fas fa-gamepad me-1"></i> Catálogo
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white">
                        <i class="fas fa-shipping-fast me-1"></i> Método de entrega
                    </li>
                </ol>
            </nav>

            <!-- Título principal -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-white mb-3">
                    <i class="fas fa-shipping-fast me-3" style="color: #7c3aed;"></i>
                    ¿Cómo quieres recibir tu producto?
                </h1>
                <p class="lead text-white-50">Selecciona el método de entrega que prefieras</p>
            </div>

            <div class="row g-4">
                <!-- Columna izquierda - Producto -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg sticky-top"
                        style="top: 20px; background: rgba(15, 23, 42, 0.9); border-radius: 20px;">
                        <div class="card-body p-4">
                            <!-- Imagen del producto -->
                            <div class="text-center mb-4">
                                @if ($producto->imagen_principal)
                                    <img src="{{ Vite::asset('resources/images/games/' . $producto->imagen_principal) }}"
                                        alt="{{ $producto->nombre }}" class="img-fluid rounded-3 shadow"
                                        style="max-height: 250px; object-fit: cover;">
                                @else
                                    <div class="bg-gradient p-5 rounded-3"
                                        style="background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);">
                                        <i class="fas fa-gamepad fa-5x text-white"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Info del producto -->
                            <h4 class="text-white mb-3">{{ $producto->nombre }}</h4>

                            @if ($producto->categoria)
                                <span class="badge px-3 py-2 mb-3"
                                    style="background: rgba(124, 58, 237, 0.2); color: #a78bfa; border: 1px solid #7c3aed;">
                                    <i class="fas fa-tag me-1"></i>
                                    {{ $producto->categoria->nombre }}
                                </span>
                            @endif

                            <!-- Precio -->
                            <div class="d-flex align-items-center justify-content-between mb-4 p-3 rounded"
                                style="background: rgba(16, 185, 129, 0.1); border: 2px solid rgba(16, 185, 129, 0.3);">
                                <span class="text-white-50">Precio:</span>
                                <span class="h3 mb-0 fw-bold" style="color: #10b981;">
                                    {{ number_format($producto->precio, 2) }}€
                                </span>
                            </div>

                            <!-- Selector de cantidad -->
                            <div class="mb-4">
                                <label class="text-white mb-3 fw-semibold">
                                    <i class="fas fa-cubes me-2"></i>Cantidad:
                                </label>
                                <div class="d-flex align-items-center justify-content-center">
                                    <button wire:click="decrement" class="btn btn-lg text-white px-4"
                                        style="background: rgba(124, 58, 237, 0.2); border: 2px solid #7c3aed;"
                                        {{ $cantidad <= 1 ? 'disabled' : '' }}>
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" value="{{ $cantidad }}" readonly
                                        class="form-control form-control-lg text-center text-white fw-bold fs-3 mx-3"
                                        style="width: 100px; background: rgba(15, 23, 42, 0.8); border: 2px solid #7c3aed;">
                                    <button wire:click="increment" class="btn btn-lg text-white px-4"
                                        style="background: rgba(124, 58, 237, 0.2); border: 2px solid #7c3aed;">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="p-4 rounded text-center"
                                style="background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);">
                                <div class="text-white-50 mb-1">Total:</div>
                                <div class="h2 fw-bold text-white mb-0">
                                    {{ number_format($producto->precio * $cantidad, 2) }}€
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna derecha - Métodos de entrega -->
                <div class="col-lg-8">
                    @if (session()->has('error'))
                        <div class="alert alert-danger mb-4"
                            style="background: rgba(239, 68, 68, 0.1); border: 2px solid #ef4444; color: #fca5a5;">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success mb-4"
                            style="background: rgba(16, 185, 129, 0.1); border: 2px solid #10b981; color: #6ee7b7;">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row g-4 mb-4">
                        <!-- Opción Digital - SIEMPRE VISIBLE -->
                        <div class="col-12">
                            <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden"
                                style="background: rgba(15, 23, 42, 0.9); border-radius: 20px; cursor: pointer; transition: all 0.3s; border: 3px solid {{ $metodoSeleccionado === 'digital' ? '#10b981' : 'transparent' }} !important;"
                                wire:click="seleccionarMetodo('digital')"
                                onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px rgba(16, 185, 129, 0.3)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.5)'">

                                @if ($metodoSeleccionado === 'digital')
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                    </div>
                                @endif

                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="rounded-3 d-flex align-items-center justify-content-center p-4"
                                                style="width: 100px; height: 100px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                                <i class="fas fa-key fa-3x text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h3 class="text-white mb-2">
                                                <i class="fas fa-bolt me-2" style="color: #10b981;"></i>
                                                Clave Digital
                                            </h3>
                                            <p class="text-white-50 mb-3">Recibe tu clave de activación al instante
                                                por
                                                email</p>

                                            <div class="d-flex flex-wrap gap-3 mb-3">
                                                <span class="badge px-3 py-2"
                                                    style="background: rgba(16, 185, 129, 0.2); color: #6ee7b7; border: 1px solid #10b981;">
                                                    <i class="fas fa-infinity me-1"></i>
                                                    Stock: Ilimitado
                                                </span>
                                                <span class="badge px-3 py-2"
                                                    style="background: rgba(16, 185, 129, 0.2); color: #6ee7b7; border: 1px solid #10b981;">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Entrega inmediata
                                                </span>
                                                <span class="badge px-3 py-2"
                                                    style="background: rgba(16, 185, 129, 0.2); color: #6ee7b7; border: 1px solid #10b981;">
                                                    <i class="fas fa-dollar-sign me-1"></i>
                                                    GRATIS
                                                </span>
                                            </div>

                                            <div class="text-success">
                                                <i class="fas fa-check-circle me-2"></i>
                                                Sin gastos de envío • Activación instantánea
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Opción Domicilio -->
                        <div class="col-12">
                            <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden"
                                style="background: rgba(15, 23, 42, 0.9); border-radius: 20px; cursor: pointer; transition: all 0.3s; border: 3px solid {{ $metodoSeleccionado === 'domicilio' ? '#3b82f6' : 'transparent' }} !important;"
                                wire:click="seleccionarMetodo('domicilio')"
                                onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px rgba(59, 130, 246, 0.3)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.5)'">

                                @if ($metodoSeleccionado === 'domicilio')
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                    </div>
                                @endif

                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="rounded-3 d-flex align-items-center justify-content-center p-4"
                                                style="width: 100px; height: 100px; background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);">
                                                <i class="fas fa-truck fa-3x text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h3 class="text-white mb-2">
                                                <i class="fas fa-home me-2" style="color: #3b82f6;"></i>
                                                Envío a Domicilio
                                            </h3>
                                            <p class="text-white-50 mb-3">Recibe tu pedido cómodamente en tu casa</p>

                                            <div class="d-flex flex-wrap gap-3 mb-3">
                                                <span class="badge px-3 py-2"
                                                    style="background: rgba(59, 130, 246, 0.2); color: #93c5fd; border: 1px solid #3b82f6;">
                                                    <i class="fas fa-box me-1"></i>
                                                    Stock: {{ $stockDomicilio }} unidades
                                                </span>
                                                <span class="badge px-3 py-2"
                                                    style="background: rgba(59, 130, 246, 0.2); color: #93c5fd; border: 1px solid #3b82f6;">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    3-5 días laborables
                                                </span>
                                                <span class="badge px-3 py-2"
                                                    style="background: rgba(59, 130, 246, 0.2); color: #93c5fd; border: 1px solid #3b82f6;">
                                                    @if ($producto->precio * $cantidad > 50)
                                                        <i class="fas fa-gift me-1"></i>
                                                        GRATIS
                                                    @else
                                                        <i class="fas fa-euro-sign me-1"></i>
                                                        +3.99€
                                                    @endif
                                                </span>
                                            </div>

                                            <div class="text-primary">
                                                <i class="fas fa-shield-alt me-2"></i>
                                                Envío asegurado con seguimiento
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Opciones Tiendas -->
                        @if (count($stockTiendas) > 0)
                            @foreach ($stockTiendas as $tienda)
                                <div class="col-12">
                                    <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden"
                                        style="background: rgba(15, 23, 42, 0.9); border-radius: 20px; cursor: pointer; transition: all 0.3s; border: 3px solid {{ $metodoSeleccionado === 'recogida' && $tiendaSeleccionada === $tienda['tienda_id'] ? '#f59e0b' : 'transparent' }} !important;"
                                        wire:click="seleccionarMetodo('recogida', {{ $tienda['tienda_id'] }})"
                                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px rgba(245, 158, 11, 0.3)'"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.5)'">

                                        @if ($metodoSeleccionado === 'recogida' && $tiendaSeleccionada === $tienda['tienda_id'])
                                            <div class="position-absolute top-0 end-0 m-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px; background: #f59e0b;">
                                                    <i class="fas fa-check text-white"></i>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="card-body p-4">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="rounded-3 d-flex align-items-center justify-content-center p-4"
                                                        style="width: 100px; height: 100px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                                                        <i class="fas fa-store fa-3x text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h3 class="text-white mb-2">
                                                        <i class="fas fa-map-marker-alt me-2"
                                                            style="color: #f59e0b;"></i>
                                                        Recogida en Tienda
                                                    </h3>
                                                    <h5 class="text-white mb-2">{{ $tienda['nombre'] }}</h5>
                                                    <p class="text-white-50 mb-3">
                                                        <i class="fas fa-location-arrow me-1"></i>
                                                        {{ $tienda['direccion'] }}
                                                        @if ($tienda['ciudad'])
                                                            , {{ $tienda['ciudad'] }}
                                                        @endif
                                                    </p>

                                                    <div class="d-flex flex-wrap gap-3 mb-3">
                                                        <span class="badge px-3 py-2"
                                                            style="background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid #f59e0b;">
                                                            <i class="fas fa-box me-1"></i>
                                                            Stock: {{ $tienda['stock'] }} unidades
                                                        </span>
                                                        <span class="badge px-3 py-2"
                                                            style="background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid #f59e0b;">
                                                            <i class="fas fa-map-pin me-1"></i>
                                                            {{ $tienda['ubicacion'] }}
                                                        </span>
                                                        <span class="badge px-3 py-2"
                                                            style="background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid #f59e0b;">
                                                            <i class="fas fa-clock me-1"></i>
                                                            Disponible hoy
                                                        </span>
                                                        <span class="badge px-3 py-2"
                                                            style="background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid #f59e0b;">
                                                            <i class="fas fa-gift me-1"></i>
                                                            GRATIS
                                                        </span>
                                                    </div>

                                                    <div style="color: #f59e0b;">
                                                        <i class="fas fa-check-circle me-2"></i>
                                                        Sin gastos • Recogida el mismo día
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex gap-3">
                        <a href="{{ route('catalogo') }}" class="btn btn-lg px-5 py-3 text-white"
                            style="background: rgba(255, 255, 255, 0.1); border: 2px solid rgba(124, 58, 237, 0.5);"
                            onmouseover="this.style.background='rgba(124, 58, 237, 0.2)'"
                            onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
                            <i class="fas fa-arrow-left me-2"></i>
                            Volver al catálogo
                        </a>

                        <button wire:click="agregarAlCarrito"
                            class="btn btn-lg px-5 py-3 text-white fw-bold flex-grow-1"
                            style="background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%); border: none;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 30px rgba(124, 58, 237, 0.5)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)'"
                            {{ !$metodoSeleccionado ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart me-2"></i>
                            Añadir al carrito
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .breadcrumb {
            background-color: #0f172a !important;
        }

        .breadcrumb-item a:hover {
            color: #7c3aed !important;
        }

        .breadcrumb-item.active {
            color: white !important;
        }

        .sticky-top {
            position: sticky;
            z-index: 100;
        }

        button:disabled {
            opacity: 0.5;
            cursor: not-allowed !important;
        }
    </style>
</div>
