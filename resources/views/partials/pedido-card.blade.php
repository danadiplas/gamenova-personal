@forelse ($pedidos as $pedido)
    <div class="card pedido text-white mb-3" style="min-width: 50em;">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title">{{ $pedido->numero_pedido }} </h5>
                    <h6 class="card-subtitle mb-2 text-muted">Realizado el {{ $pedido->fecha_pedido }} </h6>
                    <a href="#" class="card-link"> </a>

                </div>
                <div class="col">
                    <p class="text-end text-price fw-bold">{{ $pedido->subtotal }}€ </p>
                    <p class="text-end text-warning text-capitalize">{{ $pedido->estado }} </p>
                </div>
                <div style="display: flex" class="mt-2">
                    <button class="p-1 rounded button-mostrar" data-pedido="{{ $pedido->id }}">
                        <img src="{{ Vite::asset('resources/images/arrow_drop_down_20dp_FFFFFF_FILL1_wght400_GRAD0_opsz20.svg') }}"
                            class="px-1">
                    </button>
                </div>
                <div class="tabla-pedidos container rounded-bottom" style="display:flex;"
                    data-pedido="{{ $pedido->id }}">
                    <table class="table linea-pedido text-white">

                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        @foreach ($pedido->ordenes as $orden)
                            <tbody>
                                <tr>
                                    <td>
                                        <a class="link-producto" href="{{ url("productos/{$orden->producto->id}") }}">
                                            {{ $orden->producto->nombre }}
                                        </a>
                                    </td>
                                    <td>{{ $orden->cantidad }}</td>
                                    <td>{{ $orden->precio_unitario }}</td>
                                </tr>
                            </tbody>
                        @endforeach

                    </table>
                </div>

            </div>
        </div>
    </div>
@empty
    <div class="container mt-7">
        <p class="text-center text-muted fs-4">No tienes pedidos </p>
    </div>
@endforelse
