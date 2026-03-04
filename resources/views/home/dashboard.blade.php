@extends('layouts.auth')

@section('title', 'Inicio')

@section('content')
<div>
    @if (session('message'))
    <p class="text-3xl text-slate-600 font-bold">{{ session('message') }}</p>
    @endif
    <livewire:auth.dashboard lazy />
</div>

@endsection
