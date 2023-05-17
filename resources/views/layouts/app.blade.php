<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    {{-- {{ config('app.name', 'El Rincon de Las Letras') }} --}}
    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ Storage::url('Logo.svg') }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 (CSS y JS) -->
    @vite(['resources/js/app.js'])

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{--
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"> --}}


    @livewireStyles
</head>

<body>
    <div class="sticky-top" id="app">
        @livewire('navbar')

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>

{{-- <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}" defer></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" defer></script> --}}


{{--
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Bootstrap 5 (CSS y JS) -->
    @vite(['resources/js/app.js'])

    <!--Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        {{-- @livewire('navigation-menu') --}}

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    <script>
        document.getElementById("imagen").addEventListener("change", cambiarImagen);
        function cambiarImagen(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("img").setAttribute("src", event.target.result)
            }
            reader.readAsDataURL(file);
        }
    </script>

    @stack('modals')

    @livewireScripts

    <script>
        Livewire.on('alert', function(txt) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: txt,
                showConfirmButton: false,
                timer: 1500
            })
        });
    </script>

    {{-- Función para que funcione SweetAlert2 con Livewire --}}
    <script>
        Livewire.on('info', function(txt) {
            Swal.fire({
                icon: 'success',
                title: txt,
                showConfirmButton: false,
                timer: 1500
            })
        });
    </script>

    {{-- Función para que funciones SweetAlert2 con Controladores--}}
    @if (session('info'))
    <script>
        Swal.fire({
                icon: 'success',
                title: '{{ session('info') }}',
                showConfirmButton: false,
                timer: 1500
            })
    </script>
    @endif
</body>

<style>
    /* :focus {
        outline: none;
    }

    :focus-visible {
        outline: none;
        position: relative;
    }

    :focus-visible::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border: 2px solid red !important;
    } */
</style>

</html>
