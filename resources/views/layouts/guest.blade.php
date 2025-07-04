<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Noli Me Tangere') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900" style="background-image: url('{{ asset('images/noli_bg.png') }}'); background-size: cover; background-position: center;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            {{-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div> --}}

<!-- Add this link in your <head> to use a pixel font -->


<!-- The pixel-style card -->
            <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-orange-800 text-black border-4 border-black shadow-[4px_4px_0_#000] font-['Press_Start_2P']">
                {{ $slot }}
            </div>


        </div>
    </body>
</html>
