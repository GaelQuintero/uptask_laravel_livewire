@extends('layouts.guest')

@section('title', 'Confirmar cuenta')

@section('content')
<div class="flex flex-col items-center space-y-6">
    <x-u-i.header-guest />

    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow">
        <p class="text-gray-600 font-black text-3xl">Confirma tu <span class="text-pink-600">cuenta</span></p>

        {{-- Componente del confirmar cuenta --}}
        <livewire:auth.form-confirm-account />

    </div>
</div>

@endsection
