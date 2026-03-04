@extends('layouts.guest')

@section('title', 'Actualizar contraseña')

@section('content')
<div class="flex flex-col items-center space-y-6">
    <x-u-i.header-guest />

    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow">
        <p class="text-gray-600 font-black text-3xl">Recupera tu <span class="text-pink-600">contraseña</span></p>

        {{-- Componente para actualizar contraseña --}}
        <livewire:auth.update-password-form />
    </div>
</div>

@endsection
