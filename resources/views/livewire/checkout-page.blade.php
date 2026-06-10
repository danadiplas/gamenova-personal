{{-- resources/views/livewire/checkout-page.blade.php --}}
@section('title', 'Pago')

<div class="min-vh-100 bg-dark">
    <div class="container py-5">
        <!-- Breadcrumb -->
        <div class="mb-5">
            <nav class="mb-4" aria-label="breadcrumb">
                <ol class="breadcrumb bg-tarjetas border border-primary rounded p-3">
                    <li class="breadcrumb-item">
                        <a href="{{ route('catalogo') }}" class="text-muted">
                            <i class="fas fa-home me-1"></i> Inicio
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('carrito') }}" class="text-muted">
                            <i class="fas fa-shopping-cart me-1"></i> Carrito
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white">
                        <i class="fas fa-credit-card me-1"></i> Checkout
                    </li>
                </ol>
            </nav>

            <h1 class="display-5 fw-bold text-white mb-3">Finalizar Compra</h1>
            <p class="lead text-muted">Completa tus datos para completar el pedido</p>
        </div>

        @if (session()->has('error'))
            <div class="alert alert-danger bg-dark border border-danger text-danger p-4 rounded-lg mb-5">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success bg-dark border border-success text-success p-4 rounded-lg mb-5">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="procesarPago">
            <div class="row g-4">
                <!-- Columna izquierda - Formulario -->
                <div class="col-lg-8">

                    <!-- Información de contacto -->
                    <div class="card bg-tarjetas border-primary mb-4">
                        <div class="card-header border-bottom border-primary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-user-circle me-2 text-primary"></i> Información de contacto
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-white mb-2">Nombre *</label>
                                    <input type="text" wire:model="nombre"
                                        class="form-control bg-dark border-secondary text-white"
                                        placeholder="Tu nombre">
                                    @error('nombre')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-white mb-2">Apellidos *</label>
                                    <input type="text" wire:model="apellidos"
                                        class="form-control bg-dark border-secondary text-white"
                                        placeholder="Tus apellidos">
                                    @error('apellidos')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-white mb-2">Email *</label>
                                    <input type="email" wire:model="email"
                                        class="form-control bg-dark border-secondary text-white"
                                        placeholder="ejemplo@email.com">
                                    @error('email')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-white mb-2">Teléfono *</label>
                                    <input type="tel" wire:model="telefono"
                                        class="form-control bg-dark border-secondary text-white"
                                        placeholder="+34 600 000 000">
                                    @error('telefono')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dirección de envío -->
                    <div class="card bg-tarjetas border-primary mb-4">
                        <div class="card-header border-bottom border-primary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i> Dirección de envío
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label text-white mb-2">Dirección *</label>
                                <input type="text" wire:model="direccion"
                                    class="form-control bg-dark border-secondary text-white"
                                    placeholder="Calle, número, piso">
                                @error('direccion')
                                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label text-white mb-2">Ciudad *</label>
                                    <input type="text" wire:model="ciudad"
                                        class="form-control bg-dark border-secondary text-white"
                                        placeholder="Tu ciudad">
                                    @error('ciudad')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label text-white mb-2">Provincia *</label>
                                    <input type="text" wire:model="provincia"
                                        class="form-control bg-dark border-secondary text-white"
                                        placeholder="Tu provincia">
                                    @error('provincia')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label text-white mb-2">Código Postal *</label>
                                    <input type="text" wire:model="codigoPostal"
                                        class="form-control bg-dark border-secondary text-white" placeholder="28001">
                                    @error('codigoPostal')
                                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-label text-white mb-2">País</label>
                                <select wire:model="pais" class="form-select bg-dark border-secondary text-white">
                                    <option value="España">España</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Francia">Francia</option>
                                    <option value="Italia">Italia</option>
                                    <option value="Alemania">Alemania</option>
                                </select>
                            </div>

                            <div class="form-check mt-4">
                                <input type="checkbox" wire:model="mismaDireccion" id="mismaDireccion"
                                    class="form-check-input">
                                <label for="mismaDireccion" class="form-check-label text-white">
                                    <i class="fas fa-copy me-1"></i> Usar la misma dirección para facturación
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Método de pago -->
                    <div class="card bg-tarjetas border-primary mb-4">
                        <div class="card-header border-bottom border-primary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-credit-card me-2 text-primary"></i> Método de pago
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Opciones de pago -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <input type="radio" wire:model="metodoPago" value="tarjeta" id="pagoTarjeta"
                                        class="d-none">
                                    <label for="pagoTarjeta"
                                        class="payment-option 
                                        {{ $metodoPago === 'tarjeta' ? 'selected' : '' }}">
                                        <i class="fas fa-credit-card fa-2x mb-3"></i>
                                        <h6 class="text-white mb-1">Tarjeta</h6>
                                        <p class="text-muted small">Visa, Mastercard</p>
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <input type="radio" wire:model="metodoPago" value="paypal" id="pagoPaypal"
                                        class="d-none">
                                    <label for="pagoPaypal"
                                        class="payment-option 
                                        {{ $metodoPago === 'paypal' ? 'selected' : '' }}">
                                        <i class="fab fa-paypal fa-2x mb-3"></i>
                                        <h6 class="text-white mb-1">PayPal</h6>
                                        <p class="text-muted small">Pago rápido</p>
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <input type="radio" wire:model="metodoPago" value="transferencia"
                                        id="pagoTransferencia" class="d-none">
                                    <label for="pagoTransferencia"
                                        class="payment-option 
                                        {{ $metodoPago === 'transferencia' ? 'selected' : '' }}">
                                        <i class="fas fa-university fa-2x mb-3"></i>
                                        <h6 class="text-white mb-1">Transferencia</h6>
                                        <p class="text-muted small">Datos bancarios</p>
                                    </label>
                                </div>
                            </div>

                            <!-- Formulario de tarjeta -->
                            @if ($metodoPago === 'tarjeta')
                                <div class="p-4 bg-dark rounded border border-secondary">
                                    <h5 class="text-white mb-4">
                                        <i class="fas fa-credit-card me-2"></i> Detalles de la tarjeta
                                    </h5>

                                    <div class="mb-3">
                                        <label class="form-label text-white mb-2">Número de tarjeta</label>
                                        <input type="text" wire:model="numeroTarjeta"
                                            class="form-control bg-dark border-secondary text-white"
                                            placeholder="1234 5678 9012 3456">
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label text-white mb-2">Nombre del titular</label>
                                            <input type="text" wire:model="nombreTitular"
                                                class="form-control bg-dark border-secondary text-white"
                                                placeholder="JUAN PEREZ">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label text-white mb-2">Fecha de expiración</label>
                                            <input type="text" wire:model="fechaExpiracion"
                                                class="form-control bg-dark border-secondary text-white"
                                                placeholder="MM/AA">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label text-white mb-2">CVV</label>
                                            <input type="text" wire:model="cvv"
                                                class="form-control bg-dark border-secondary text-white"
                                                placeholder="123">
                                        </div>
                                    </div>

                                    <div class="form-check mt-4">
                                        <input type="checkbox" wire:model="recordarTarjeta" id="recordarTarjeta"
                                            class="form-check-input">
                                        <label for="recordarTarjeta" class="form-check-label text-white">
                                            <i class="fas fa-save me-1"></i> Recordar esta tarjeta
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <!-- Información PayPal -->
                            @if ($metodoPago === 'paypal')
                                <div class="p-4 bg-dark rounded border border-secondary text-center">
                                    <i class="fab fa-paypal fa-3x text-primary mb-3"></i>
                                    <h5 class="text-white mb-3">Serás redirigido a PayPal</h5>
                                    <p class="text-muted">
                                        Al continuar, serás redirigido a la página segura de PayPal para completar tu
                                        pago.
                                    </p>
                                </div>
                            @endif

                            <!-- Información transferencia -->
                            @if ($metodoPago === 'transferencia')
                                <div class="p-4 bg-dark rounded border border-secondary">
                                    <h5 class="text-white mb-4">
                                        <i class="fas fa-university me-2"></i> Datos bancarios
                                    </h5>
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <div
                                                class="d-flex justify-content-between border-bottom border-secondary pb-2">
                                                <span class="text-muted">Banco:</span>
                                                <span class="text-white">Banco GameNova</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div
                                                class="d-flex justify-content-between border-bottom border-secondary pb-2">
                                                <span class="text-muted">IBAN:</span>
                                                <span class="text-white">ES91 2100 0418 4502 0005 1332</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div
                                                class="d-flex justify-content-between border-bottom border-secondary pb-2">
                                                <span class="text-muted">Beneficiario:</span>
                                                <span class="text-white">GameNova S.L.</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted">Concepto:</span>
                                                <span class="text-white">Pedido
                                                    #{{ Auth::id() }}-{{ time() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-muted mt-4 small">
                                        Una vez realizado el ingreso, tu pedido será procesado. Te enviaremos un email
                                        de confirmación.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Términos y condiciones -->
                    <div class="card bg-tarjetas border-primary mb-4">
                        <div class="card-body">
                            <div class="form-check">
                                <input type="checkbox" wire:model="aceptaTerminos" id="aceptaTerminos"
                                    class="form-check-input">
                                <label for="aceptaTerminos" class="form-check-label text-white">
                                    <i class="fas fa-file-contract me-1"></i> Acepto los
                                    <a href="#" class="text-primary">términos y condiciones</a>,
                                    <a href="#" class="text-primary">política de privacidad</a> y
                                    <a href="#" class="text-primary">política de devoluciones</a> de GameNova.
                                </label>
                                @error('aceptaTerminos')
                                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna derecha - Resumen -->
                <div class="col-lg-4">
                    <!-- Resumen del pedido -->
                    <div class="card bg-tarjetas border-primary sticky-top" style="top: 100px;">
                        <div class="card-header border-bottom border-primary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-receipt me-2 text-primary"></i> Resumen del pedido
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Productos -->
                            <div class="mb-4">
                                <h6 class="text-white mb-3">Productos:</h6>
                                @if ($cartItems && $cartItems->count() > 0)
                                    <div class="product-list mb-4">
                                        @foreach ($cartItems as $item)
                                            <div
                                                class="d-flex align-items-center mb-3 pb-3 border-bottom border-secondary">
                                                @if ($item->producto)
                                                    <div class="position-relative">
                                                        <div class="rounded bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3"
                                                            style="width: 50px; height: 50px;">
                                                            <i class="fas fa-gamepad text-primary"></i>
                                                        </div>
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                            {{ $item->cantidad }}
                                                        </span>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="text-white small">{{ $item->producto->nombre }}
                                                        </div>
                                                        <div class="text-success fw-bold">
                                                            €{{ number_format($item->producto->precio * $item->cantidad, 2) }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-shopping-cart fa-2x text-muted mb-3"></i>
                                        <p class="text-muted mb-2">No hay productos en el carrito</p>
                                        <a href="{{ route('catalogo') }}" class="text-primary">
                                            <i class="fas fa-arrow-left me-1"></i> Ir al catálogo
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Totales -->
                            <div class="border-top border-secondary pt-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal:</span>
                                    <span class="text-white">€{{ number_format($subtotal, 2) }}</span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Envío:</span>
                                    <span class="text-white">
                                        @if ($envio > 0)
                                            €{{ number_format($envio, 2) }}
                                        @else
                                            <span class="text-success">Gratis</span>
                                        @endif
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">IVA (21%):</span>
                                    <span class="text-white">€{{ number_format($iva, 2) }}</span>
                                </div>

                                <div class="d-flex justify-content-between border-top border-secondary pt-3">
                                    <span class="h5 mb-0 text-white">Total:</span>
                                    <span class="h4 mb-0 text-success fw-bold">
                                        €{{ number_format($total, 2) }}
                                    </span>
                                </div>

                                @if ($total < 50)
                                    <div class="mt-3 p-2 bg-dark border border-warning rounded">
                                        <small class="text-warning">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Añade €{{ number_format(50 - $total, 2) }} más para envío gratis
                                        </small>
                                    </div>
                                @endif
                            </div>

                            <!-- Botón de pago -->
                            <button type="submit" class="btn btn-primary w-100 py-3 mt-4 fw-bold"
                                @if (!$cartItems || $cartItems->count() === 0) disabled @endif>
                                <i class="fas fa-lock me-2"></i>
                                Confirmar y Pagar €{{ number_format($total, 2) }}
                            </button>

                            <!-- Volver al carrito -->
                            <a href="{{ route('carrito') }}" class="btn btn-outline-light w-100 py-3 mt-3">
                                <i class="fas fa-arrow-left me-2"></i>
                                Volver al carrito
                            </a>

                            <!-- Seguridad -->
                            <div class="mt-4 pt-4 border-top border-secondary">
                                <div class="d-flex align-items-center text-muted small">
                                    <div class="me-3">
                                        <i class="fas fa-shield-alt fa-lg text-success"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white">Compra 100% segura</div>
                                        <div class="small">Pago cifrado • Garantía de devolución • Soporte 24/7</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Estilos específicos para el checkout -->
    <style>
        .bg-tarjetas {
            background-color: #0f172a !important;
        }

        .delivery-option,
        .payment-option {
            display: block;
            padding: 1.5rem;
            border: 2px solid #2d3748;
            border-radius: 0.75rem;
            background-color: rgba(15, 23, 42, 0.5);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
        }

        .delivery-option:hover,
        .payment-option:hover {
            border-color: #7c3aed;
            background-color: rgba(124, 58, 237, 0.1);
            transform: translateY(-2px);
        }

        .delivery-option.selected,
        .payment-option.selected {
            border-color: #7c3aed;
            background-color: rgba(124, 58, 237, 0.15);
            box-shadow: 0 0 0 1px #7c3aed;
        }

        .delivery-icon {
            color: #7c3aed;
        }

        .payment-option i {
            color: #7c3aed;
        }

        .product-list {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .product-list::-webkit-scrollbar {
            width: 6px;
        }

        .product-list::-webkit-scrollbar-track {
            background: #1e293b;
            border-radius: 3px;
        }

        .product-list::-webkit-scrollbar-thumb {
            background: #7c3aed;
            border-radius: 3px;
        }

        .sticky-top {
            position: sticky;
            z-index: 1020;
        }

        .form-control.bg-dark,
        .form-select.bg-dark {
            background-color: rgba(10, 14, 39, 0.8) !important;
            color: white !important;
            border-color: #4b5563 !important;
        }

        .form-control.bg-dark:focus,
        .form-select.bg-dark:focus {
            border-color: #7c3aed !important;
            box-shadow: 0 0 0 0.25rem rgba(124, 58, 237, 0.25) !important;
        }

        .badge.bg-success {
            background-color: #10b981 !important;
        }

        .alert {
            border-radius: 0.75rem;
            border-width: 2px;
        }

        .breadcrumb {
            background-color: #0f172a !important;
            border: 1px solid #7c3aed !important;
        }

        .breadcrumb-item a {
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb-item a:hover {
            color: #7c3aed !important;
        }

        .form-check-input:checked {
            background-color: #7c3aed !important;
            border-color: #7c3aed !important;
        }

        a.text-primary {
            color: #7c3aed !important;
            text-decoration: none;
        }

        a.text-primary:hover {
            color: #ec4899 !important;
            text-decoration: underline;
        }

        .btn-outline-light:hover {
            background-color: #7c3aed !important;
            border-color: #7c3aed !important;
        }
    </style>
</div>
