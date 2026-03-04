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

<body class="bg-gray-100">
    <livewire:layout.auth.nav />
    <main class="max-w-10/12 mx-auto mt-10 p-5">
        @yield('content')
    </main>
    @livewireScripts
    @fluxScripts
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</body>

</html>
