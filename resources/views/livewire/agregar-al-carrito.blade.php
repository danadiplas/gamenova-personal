@section('title', 'Carrito')

<div>
    {{-- Botón principal --}}
    @if ($enCarrito)
        <a href="{{ route('carrito') }}"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center text-center d-block text-decoration-none">
            <svg class="w-5 h-5 mr-2 d-inline" style="width: 20px; height: 20px;" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            @php
                $textoMetodo = match ($metodoEntrega) {
                    'digital' => 'Clave Digital',
                    'recogida' => 'Recoger en tienda',
                    default => 'Envío a domicilio',
                };
            @endphp
            En el carrito ({{ $textoMetodo }})
        </a>
    @else
        <button wire:click="agregarAlCarrito" type="button"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">
            <i class="fas fa-cart-plus me-2"></i>
            Añadir al carrito
        </button>
    @endif

    {{-- Mensajes de error/éxito --}}
    @if (session()->has('error'))
        <div class="mt-4 p-4 bg-red-900/20 border-2 border-red-500 text-red-400 rounded-lg">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="mt-4 p-4 bg-green-900/20 border-2 border-green-500 text-green-400 rounded-lg">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif
</div>
