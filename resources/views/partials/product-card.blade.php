@forelse ($productos as $producto)
    <div class="col g-4">
        <a href="{{ url("productos/{$producto->id}") }}">
            <div class="card product text-white" style="width: 18rem;" href="{{ url("productos/{$producto->id}") }}">
                <img src="{{ Vite::asset('resources/images/games/' . $producto->imagen_principal) }}"
                    class="card-img-top ">
                <div class="card-body">
                    <h5 class="card-title fs-5 mb-1">{{ $producto->nombre }} </h5>
                    <p class="card-text my-1 text-muted category-text">{{ $producto->categoria->nombre }}</p>
                    <div class="container text-center ps-0">
                        <div class="row row-cols-auto g-1">
                            @if ($producto->stock)
                                <div class="col">
                                    <span class="badge d-flex text-bg-light" style="--bs-bg-opacity: .5;">
                                        <img src="{{ Vite::asset('resources/images/key_16dp_000000_FILL0_wght400_GRAD0_opsz20.svg') }}"
                                            width="20px" style="transform: rotate(70deg);">
                                        <p class="pt-1">Digital</p>
                                    </span>
                                </div>
                            @endif

                            @if ($producto->stockTiendas)
                                <div class="col">
                                    <span class="badge d-flex text-bg-light" style="--bs-bg-opacity: .5;">
                                        <img src="{{ Vite::asset('resources/images/store_16dp_000000_FILL0_wght400_GRAD0_opsz20.svg') }}"
                                            width="20px">
                                        <p class="pt-1">Físico</p>
                                    </span>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="container d-flex">
                        @if ($producto->precio_rebajado)
                            <p class="fs-5 mt-1 fw-bold text-price-rebajado">{{ $producto->precio }}€</p>
                            <p class="fs-5 mt-1 ms-2 fw-bold text-price">{{ $producto->precio_rebajado }}€</p>
                        @else
                            <p class="fs-5 mt-1 fw-bold text-price">{{ $producto->precio }}€</p>
                        @endif

                    </div>
                </div>
            </div>

        </a>

    </div>
@empty
    <div class="container mt-7">
        <p class="text-center text-muted fs-4">No hay productos en esta categoría </p>
    </div>
@endforelse
