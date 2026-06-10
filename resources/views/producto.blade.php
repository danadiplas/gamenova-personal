@extends('layouts.layout')

@section('title', 'Productos')

@section('titulo-pagina')
    <p class="fs-1  fw-bold d-flex text-center" id="title-catalog">
        <img src="{{ Vite::asset('resources/images/stadia_controller_24dp_B741C0_FILL1_wght400_GRAD0_opsz24.svg') }}"
            width="60px" class="px-1">
        Catálogo de Juegos
    </p>
    <p class="text-center subtitulo text-muted">Explora nuestra colección</p>
@endsection

@section('content')

    @foreach ($producto as $pro)
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="{{ Vite::asset('resources/images/games/' . $pro->imagen_principal) }}" style="width: 550px"
                        class="rounded-4">
                </div>
                <div class="col">
                    <div class="container text-white">
                        <p class="fs-1">{{ $pro->nombre }} </p>
                        <p class="fs-2 text-price fw-bold">{{ $pro->precio }}€ </p>
                        <p class="text-muted">{{ $pro->descripcion }} </p>
                        <div class="container mt-3 p-3 ms-1" id="tabla-especificaciones">
                            <p class="fs-6 fw-bold">Especificaciones</p>
                            <div class="container">
                                <div class="row fila-especificaciones ">
                                    <div class="col ">
                                        <p>Plataforma:</p>
                                    </div>
                                    <div class="col text-end">{{ $pro->plataforma }}</div>
                                </div>
                                <div class="row fila-especificaciones">
                                    <div class="col">
                                        <p>Género:</p>
                                    </div>
                                    <div class="col text-end">
                                        <p>{{ $pro->plataforma }}</p>
                                    </div>
                                </div>
                                <div class="row fila-especificaciones">
                                    <div class="col">
                                        <p>Clasificación:</p>
                                    </div>
                                    <div class="col text-end">
                                        <p>PEGI-{{ $pro->pegi }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="container m-3 mt-5">
                            <form action="{{ route('carrito.agregar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $pro->id }}">
                                <input type="hidden" name="metodo_entrega" value="domicilio">
                                <button type="submit" class="btn button-anadir text-white">
                                    <a href="{{ url("seleccionar-metodo-entrega/{$pro->id}") }}">
                                        Añadir al carrito
                                    </a>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
