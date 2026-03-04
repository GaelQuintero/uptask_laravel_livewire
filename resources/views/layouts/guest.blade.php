<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('sweetalert2::index')
    @livewireStyles
</head>

<body class="bg-slate-800">
    <main class="min-h-screen flex items-center justify-center">
        @yield('content')
    </main>
    @livewireScripts
    @fluxScripts
</body>

</html>
