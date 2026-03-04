@extends('layouts.guest')

@section('title', 'Crear cuenta')

@section('content')
<div class="flex flex-col items-center space-y-6">
    <x-u-i.header-guest />

    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow">
        @if (session('message'))
        <x-u-i.alert type="{{ session('status') }}" message="{{ session('message') }}" />
        @endif
        <p class="text-gray-600 font-black text-3xl">Crea tu cuenta en <span class="text-pink-600">Up</span>Task</p>

        {{-- Componente del Registers --}}
        <x-auth.register-form />

        <nav class="flex justify-between gap-5 mt-5">
            <span class="text-slate-500 hover:text-pink-800 transition-colors"><a href="{{ route('login') }}">Iniciar
                    sesión</a></span>
            <span class="text-slate-500 hover:text-pink-800 transition-colors"><a
                    href="{{ route('forgot-password') }}">Olvide mi contraseña</a></span>
        </nav>
    </div>
</div>

@endsection
