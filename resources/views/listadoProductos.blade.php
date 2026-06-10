    @extends('layouts.layout')

    @section('titulo-pagina')
        <p class="fs-1  fw-bold d-flex text-center" id="title-catalog">
            <img src="{{ Vite::asset('resources/images/stadia_controller_24dp_B741C0_FILL1_wght400_GRAD0_opsz24.svg') }}"
                width="60px" class="px-1">
            Catálogo de Juegos
        </p>
        <p class="text-center subtitulo text-muted">Explora nuestra colección</p>

    @endsection


    @section('title', 'Productos')

    @section('content')

        <div class="container">
            <div class="row row-cols-auto justify-content-end buttons-categories">
                <div class="col">
                    <button type="button " class="btn btn-dark text-white bg-transparent rounded-5 m-2 category-button"
                        data-id="">Todos</button>
                </div>
                <div class="col">
                    @foreach ($categorias as $categoria)
                        <button type="button" data-id="{{ $categoria->id }}"
                            class="btn btn-dark ustify-content-end text-white bg-transparent rounded-5 m-2 category-button">{{ $categoria->nombre }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container">
            <div class="d-flex justify-content-center my-4 d-none" id="spinner">
                <div class="spinner-grow text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="row row-cols-4" id="products-container">
                @include('partials.product-card', ['productos' => $productos])

            </div>
        </div>
    @endsection
