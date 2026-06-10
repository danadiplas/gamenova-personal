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

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-[#0a0e27] shadow sm:rounded-lg border-2 border-[#7c3aed]">
                <div class="max-w-xl ">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-[#0a0e27] shadow sm:rounded-lg border-2 border-[#7c3aed]">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-[#0a0e27] shadow sm:rounded-lg border-2 border-[#7c3aed]">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

@endsection