@extends('layouts.auth')

@section('title', 'Ver invitación')

@section('content')
    <livewire:auth.requests.request-view :request="$request" />
@endsection
