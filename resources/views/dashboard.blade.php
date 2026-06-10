@extends('layouts.layout')

@section('title', 'Mi cuenta')

@section('titulo-pagina')
    <p class="fs-1  fw-bold d-flex text-center" id="title-catalog">
        <img src="{{ Vite::asset('resources/images/person_20dp_B741C0_FILL1_wght400_GRAD0_opsz20.svg') }}" width="60px"
            class="px-1">
        Mi cuenta
    </p>
@endsection

@section('content')


    <div class="container perfil">
        <div class="row g-0" style="height: 500px">
            <div class="col-3 m-2 rounded-3 p-2 d-flex columnas">
                <div class="container sticky-top" id="datos-usuario">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" id="icono-usuario">
                        <p class="text-uppercase fs-1 text-white">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </p>
                    </div>
                    <p class="fs-4 text-white text-center align-middle">{{ Auth::user()->name }}
                        {{ Auth::user()->apellidos }}
                    </p>

                    <p class="text-muted text-center align-middle">{{ Auth::user()->email }} </p>
                    <button type="button" class="btn mt-2 button-profile ">
                        <a href="{{ route('profile.edit') }}" class="text-white">
                            Editar perfil
                        </a>
                    </button>
                </div>

            </div>
            <div class="col m-2 rounded-3 p-2 columnas" id="pedidos">
                <p class="fs-3 text-white m-2">Mis pedidos</p>
                <div class="container">
                    @include('partials.pedido-card', ['pedidos' => $pedidos])
                </div>

            </div>
        </div>
    </div>

@endsection
