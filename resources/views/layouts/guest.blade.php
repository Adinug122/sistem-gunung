<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @php($isFocusedAuthPage = request()->routeIs('login', 'register', 'password.request', 'password.reset'))

        <div class="relative min-h-screen bg-cover  bg-center bg-no-repeat" style="background-image: url('{{ asset('img/login-bg.webp') }}')">
            @if ($isFocusedAuthPage)
                <div class="absolute inset-0 bg-black/40"></div>
            @endif

            <div class="{{ $isFocusedAuthPage ? 'relative z-10 grid min-h-screen grid-cols-1 md:grid-cols-2' : 'grid grid-cols-1 md:grid-cols-2' }}">
                <div class="{{ $isFocusedAuthPage ? ' bg-white/10 backdrop-blur-sm min-h-screen flex flex-col items-center justify-center px-8 sm:px-12 md:px-16' : 'min-h-screen bg-white/20 backdrop-blur-sm flex flex-col justify-center items-center' }}">
                    @unless ($isFocusedAuthPage)
                        <div>
                            <a href="/">
                                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                            </a>
                        </div>
                    @endunless

                    <div class="{{ $isFocusedAuthPage ? 'w-full max-w-sm' : 'w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden' }}">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
