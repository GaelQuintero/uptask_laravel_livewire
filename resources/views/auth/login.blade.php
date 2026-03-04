@extends('layouts.guest')

@section('title', 'Inicio de sesión')

@section('content')
<div class="flex flex-col items-center space-y-6">
     <x-u-i.header-guest />

    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow">
        <p class="text-gray-600 font-black text-3xl">Inicia sesión en  <span class="text-pink-600">Up</span>Task</p>

        {{-- Componente del Login --}}
        <x-auth.login-form />

        <nav class="flex justify-between gap-5 mt-5">
            <span class="text-slate-500 hover:text-pink-800 transition-colors"><a href="{{ route('register') }}">Crear cuenta</a></span>
            <span class="text-slate-500 hover:text-pink-800 transition-colors"><a href="{{ route('forgot-password') }}">Olvide mi contraseña</a></span>
        </nav>
    </div>
</div>

@endsection
