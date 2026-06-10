@section('title', 'Pago')

<div>
    <div class="min-vh-100" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);">
        <div class="container py-5">
            <!-- Cabecera de confirmación -->
            <div class="text-center mb-5">
                <div class="mx-auto mb-4"
                    style="width: 100px; height: 100px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 20px 40px rgba(16, 185, 129, 0.3);">
                    <i class="fas fa-check" style="font-size: 50px; color: white;"></i>
                </div>

                <h1 class="display-4 fw-bold text-white mb-3">¡Pedido Confirmado!</h1>
                <p class="lead text-white-50 mb-2">Tu pedido ha sido procesado correctamente</p>
                <div class="text-white font-monospace fs-5 bg-dark bg-opacity-50 d-inline-block px-4 py-2 rounded">
                    Nº Pedido: <span class="text-success fw-bold">{{ $pedido->numero_pedido }}</span>
                </div>
            </div>

            <!-- Tarjeta principal de resumen -->
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0"
                        style="background: rgba(15, 23, 42, 0.9); border-radius: 20px; backdrop-filter: blur(10px);">
                        <div class="card-body p-4 p-md-5">
                            <div class="row g-4">
                                <!-- Detalles del pedido -->
                                <div class="col-md-4">
                                    <div class="p-4 rounded"
                                        style="background: rgba(124, 58, 237, 0.1); border-left: 4px solid #7c3aed;">
                                        <h5 class="text-white mb-4 d-flex align-items-center">
                                            <span class="bg-purple-600 p-2 rounded me-3" style="background: #7c3aed;">
                                                <i class="fas fa-box text-white"></i>
                                            </span>
                                            Detalles del pedido
                                        </h5>
                                        <div class="space-y-3">
                                            <div class="d-flex justify-content-between mb-3">
                                                <span class="text-white-50">Fecha:</span>
                                                <span
                                                    class="text-white fw-semibold">{{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <span class="text-white-50">Estado:</span>
                                                <span
                                                    class="badge bg-warning text-dark">{{ ucfirst($pedido->estado) }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <span class="text-white-50">Método de pago:</span>
                                                <span class="text-white fw-semibold">
                                                    <i class="fas fa-credit-card me-1"></i>
                                                    {{ ucfirst($pedido->metodo_pago) }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span class="text-white-50">Método de entrega:</span>
                                                <span class="text-white fw-semibold">
                                                    @if ($pedido->metodo_entrega === 'digital')
                                                        <i class="fas fa-key me-1 text-success"></i> Digital
                                                    @elseif($pedido->metodo_entrega === 'recogida')
                                                        <i class="fas fa-store me-1 text-warning"></i> Recogida
                                                    @else
                                                        <i class="fas fa-truck me-1 text-primary"></i> Domicilio
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Resumen de pago -->
                                <div class="col-md-4">
                                    <div class="p-4 rounded"
                                        style="background: rgba(16, 185, 129, 0.1); border-left: 4px solid #10b981;">
                                        <h5 class="text-white mb-4 d-flex align-items-center">
                                            <span class="bg-success p-2 rounded me-3">
                                                <i class="fas fa-euro-sign text-white"></i>
                                            </span>
                                            Resumen de pago
                                        </h5>
                                        <div class="space-y-3">
                                            <div class="d-flex justify-content-between mb-3">
                                                <span class="text-white-50">Subtotal:</span>
                                                <span
                                                    class="text-white">{{ number_format($pedido->subtotal, 2) }}€</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <span class="text-white-50">Envío:</span>
                                                <span class="text-white">
                                                    @if ($pedido->envio > 0)
                                                        {{ number_format($pedido->envio, 2) }}€
                                                    @else
                                                        <span class="text-success">Gratis</span>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <span class="text-white-50">IVA:</span>
                                                <span class="text-white">{{ number_format($pedido->iva, 2) }}€</span>
                                            </div>
                                            <div
                                                class="d-flex justify-content-between pt-3 border-top border-secondary">
                                                <span class="h5 mb-0 text-white fw-bold">Total:</span>
                                                <span class="h4 mb-0 fw-bold"
                                                    style="color: #10b981;">{{ number_format($pedido->total, 2) }}€</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Información de contacto -->
                                <div class="col-md-4">
                                    <div class="p-4 rounded"
                                        style="background: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6;">
                                        <h5 class="text-white mb-4 d-flex align-items-center">
                                            <span class="bg-primary p-2 rounded me-3">
                                                <i class="fas fa-user text-white"></i>
                                            </span>
                                            Contacto
                                        </h5>
                                        <div class="space-y-3">
                                            <div class="text-white mb-2">
                                                <i class="fas fa-user-circle me-2 text-white-50"></i>
                                                {{ $pedido->user->name }}
                                            </div>
                                            <div class="text-white-50 mb-2">
                                                <i class="fas fa-envelope me-2"></i>
                                                {{ $pedido->user->email }}
                                            </div>
                                            @if ($pedido->direccionEnvio)
                                                <div class="text-white-50 small mt-3 p-3 rounded"
                                                    style="background: rgba(0,0,0,0.3);">
                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                    {{ $pedido->direccionEnvio->direccion }},
                                                    {{ $pedido->direccionEnvio->codigo_postal }},
                                                    {{ $pedido->direccionEnvio->ciudad }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Productos del pedido -->
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0"
                        style="background: rgba(15, 23, 42, 0.9); border-radius: 20px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="text-white mb-4 d-flex align-items-center">
                                <i class="fas fa-gamepad me-3" style="color: #7c3aed;"></i>
                                Productos en tu pedido
                            </h3>

                            <div class="row g-4">
                                @foreach ($pedido->ordenes as $orden)
                                    <div class="col-12">
                                        <div class="p-4 rounded"
                                            style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(124, 58, 237, 0.2); transition: all 0.3s;"
                                            onmouseover="this.style.borderColor='rgba(124, 58, 237, 0.5)'"
                                            onmouseout="this.style.borderColor='rgba(124, 58, 237, 0.2)'">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="rounded d-flex align-items-center justify-center p-3"
                                                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);">
                                                        <i class="fas fa-gamepad fa-2x text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h5 class="text-white mb-2">
                                                        {{ $orden->producto->nombre ?? 'Producto' }}</h5>
                                                    <div class="text-white-50 mb-2">
                                                        <span class="me-3">
                                                            <i class="fas fa-cubes me-1"></i>
                                                            Cantidad: <strong
                                                                class="text-white">{{ $orden->cantidad }}</strong>
                                                        </span>
                                                        <span>
                                                            <i class="fas fa-tag me-1"></i>
                                                            Precio unitario: <strong
                                                                class="text-white">{{ number_format($orden->precio_unitario, 2) }}€</strong>
                                                        </span>
                                                    </div>

                                                    <!-- MÉTODO DE ENTREGA -->
                                                    <div class="mt-2">
                                                        @if ($orden->metodo_entrega === 'digital')
                                                            <span class="badge bg-success px-3 py-2">
                                                                <i class="fas fa-key me-1"></i> Entrega digital
                                                            </span>
                                                        @elseif($orden->metodo_entrega === 'recogida')
                                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                                <i class="fas fa-store me-1"></i> Recogida en tienda
                                                            </span>
                                                        @else
                                                            <span class="badge bg-primary px-3 py-2">
                                                                <i class="fas fa-truck me-1"></i> Envío a domicilio
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-auto text-end">
                                                    <div class="h4 mb-0 fw-bold" style="color: #10b981;">
                                                        {{ number_format($orden->subtotal, 2) }}€
                                                    </div>

                                                    <!-- MOSTRAR CLAVE DIGITAL SI EXISTE -->
                                                    @if ($orden->clave_digital)
                                                        <div class="mt-3 p-3 rounded"
                                                            style="background: rgba(16, 185, 129, 0.2); border: 2px solid rgba(16, 185, 129, 0.5);">
                                                            <div class="text-success small fw-bold mb-2">
                                                                <i class="fas fa-key me-1"></i> Tu clave digital:
                                                            </div>
                                                            <div class="font-monospace text-white h5 mb-2 user-select-all"
                                                                style="cursor: pointer; letter-spacing: 2px;"
                                                                onclick="copiarClave('{{ $orden->clave_digital }}')"
                                                                title="Haz clic para copiar">
                                                                {{ $orden->clave_digital }}
                                                            </div>
                                                            <button
                                                                onclick="copiarClave('{{ $orden->clave_digital }}')"
                                                                class="btn btn-sm btn-success w-100">
                                                                <i class="fas fa-copy me-2"></i> Copiar clave
                                                            </button>
                                                            <div class="text-success-emphasis small mt-2 text-center">
                                                                <i class="fas fa-envelope me-1"></i> También enviada a
                                                                tu
                                                                email
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                        <button wire:click="imprimirFactura"
                            class="btn btn-lg px-5 py-3 border-2 text-white fw-semibold"
                            style="background: rgba(255,255,255,0.1); border-color: rgba(124, 58, 237, 0.5);"
                            onmouseover="this.style.background='rgba(124, 58, 237, 0.3)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                            <i class="fas fa-print me-2"></i> Imprimir factura
                        </button>

                        <button wire:click="descargarFactura"
                            class="btn btn-lg px-5 py-3 border-2 text-white fw-semibold"
                            style="background: rgba(255,255,255,0.1); border-color: rgba(124, 58, 237, 0.5);"
                            onmouseover="this.style.background='rgba(124, 58, 237, 0.3)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                            <i class="fas fa-download me-2"></i> Descargar factura
                        </button>

                        <button wire:click="volverAlCatalogo"
                            class="btn btn-lg px-5 py-3 text-white fw-bold shadow-lg"
                            style="background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%); border: none;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 30px rgba(124, 58, 237, 0.5)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)'">
                            <i class="fas fa-shopping-bag me-2"></i> Seguir comprando
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mensaje de ayuda -->
            <div class="text-center pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <p class="text-white-50 mb-3">¿Necesitas ayuda con tu pedido?</p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="#" class="text-decoration-none" style="color: #7c3aed;">
                        <i class="fas fa-envelope me-2"></i> Contactar con soporte
                    </a>
                    <a href="#" class="text-decoration-none" style="color: #7c3aed;">
                        <i class="fas fa-phone me-2"></i> Llamar al 900 123 456
                    </a>
                    <a href="{{ route('carrito') }}" class="text-decoration-none" style="color: #7c3aed;">
                        <i class="fas fa-shopping-cart me-2"></i> Ver mi carrito
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .user-select-all {
            user-select: all;
            -webkit-user-select: all;
            -moz-user-select: all;
            -ms-user-select: all;
        }
    </style>
</div>
