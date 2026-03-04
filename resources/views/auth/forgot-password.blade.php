@extends('layouts.guest')

@section('title', 'Recuperar contraseña')

@section('content')
<div class="flex flex-col items-center space-y-6">
    <x-u-i.header-guest />

    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow">
        <p class="text-gray-600 font-black text-3xl">Restablece tu <span class="text-pink-600">contraseña</span></p>
        <p class="text-slate-500 font-semibold mt-2">Te enviaremos instrucciones para que puedas restablecer tu contraseña</p>

        {{-- Componente del formulario de forgot password --}}
        <livewire:auth.forgot-password-form />

         <nav class="flex justify-between gap-5 mt-5">
            <span class="text-slate-500 hover:text-pink-800 transition-colors"><a href="{{ route('login') }}">Iniciar sesión</a></span>
            <span class="text-slate-500 hover:text-pink-800 transition-colors"><a href="{{ route('register') }}">Crear cuenta</a></span>
        </nav>
    </div>

</div>

@endsection
