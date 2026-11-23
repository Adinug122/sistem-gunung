<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Rental OutDoor'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=shopping_cart" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')

    </head>
    <body class="min-h-screen bg-[#FDFDFC] text-[#1b1b18]">
        <header class="w-full">
            <nav x-data="{ open: false }" class="fixed start-0 top-0 z-20 w-full border-b border-white/20 bg-black">
                <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between p-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <span class="whitespace-nowrap text-lg font-semibold text-white md:text-xl">Rental OutDoor</span>
                    </a>

                    <div class="inline-flex items-center space-x-3 md:order-2">
                        @auth
                        <div class="flex gap-2 items-center justify-center" x-data="{}" data-cart-count="{{ collect(session('keranjang', []))->sum(fn($item) => $item['qty'] ?? 0) }}">
                            <a href="{{ route('keranjang') }}" class="relative group">
                                <span class="material-symbols-outlined text-white">
                                    shopping_cart
                                </span>
                                <span x-show="$store.cart.count > 0" x-text="$store.cart.count"
                                      class="absolute -top-1 -right-1 bg-[#40916c] text-white text-[10px] font-bold rounded-full px-1.5 py-0.5 leading-none">
                                </span>
                            </a>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="bg-red-500 px-4 py-2">Logout</button>
</form>
                        </div>
                        @else
                            <a href="{{ route('login') }}" class="hidden rounded-lg border border-white px-4 py-2.5 text-sm font-medium leading-5 text-white hover:bg-white/10 focus:outline-none focus:ring-4 focus:ring-white/30 md:block">
                                Login
                            </a>
                        @endauth

                        <button
                            type="button"
                            @click="open = !open"
                            :aria-expanded="open"
                            aria-controls="landing-navigation"
                            aria-label="Buka menu navigasi"
                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg p-2 text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/30 md:hidden"
                        >
                            <svg class="h-6 w-6" aria-hidden="true" viewBox="0 0 24 24" fill="none">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                            </svg>
                        </button>
                    </div>

                    <div
                        id="landing-navigation"
                        :class="open ? 'flex' : 'hidden'"
                        class="w-full items-center justify-between md:order-1 md:flex md:w-auto"
                    >
                        <ul class="mt-4 flex w-full flex-col rounded-lg border border-white/20 p-4 font-medium md:mt-0 md:w-auto md:flex-row md:space-x-8 md:border-0 md:p-0">
                            <li>
                                <a href="{{ route('home') }}" class="block rounded bg-white/10 px-3 py-2 text-white md:bg-transparent md:p-0" aria-current="page">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}" class="block rounded px-3 py-2 text-gray-300 hover:bg-white/10 hover:text-white md:p-0 md:hover:bg-transparent">About</a>
                            </li>
                            <li>
                                <a href="{{ route('produk') }}" class="block rounded px-3 py-2 text-gray-300 hover:bg-white/10 hover:text-white md:p-0 md:hover:bg-transparent">Produk</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="block rounded px-3 py-2 text-gray-300 hover:bg-white/10 hover:text-white md:p-0 md:hover:bg-transparent">Kontak</a>
                            </li>
                            <li class="md:hidden">
                                @auth
                                    <a href="{{ route('dashboard') }}" class="block rounded px-3 py-2 text-gray-300 hover:bg-white/10 hover:text-white">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="block rounded px-3 py-2 text-gray-300 hover:bg-white/10 hover:text-white">Login</a>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main x-data="{}" class="relative">
            @yield('content')

            <div x-show="$store.cart.showToast" x-transition
                 class="fixed top-4 right-4 z-50 p-4 bg-[#1b1b18] text-white rounded-lg shadow-lg text-sm flex items-center gap-3">
                <span x-text="$store.cart.toastMessage"></span>
            </div>
        </main>

        
<footer id="contact" class="bg-[#1b1b18] text-gray-300 border-t border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-12">
            <div>
                <a href="{{ route('home') }}" class="flex items-center space-x-2 mb-6">
                    <span class="text-lg font-bold text-white whitespace-nowrap">Rental OutDoor</span>
                </a>
                <p class="text-sm text-gray-400 leading-relaxed max-w-xs">
                    Perlengkapan outdoor berkualitas dengan harga terjangkau untuk petualanganmu.
                </p>
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#40916c] hover:text-white transition-colors" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="12.5" x2="17.51" y2="12.5"/></svg>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#40916c] hover:text-white transition-colors" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#40916c] hover:text-white transition-colors" aria-label="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="12.5" x2="17.51" y2="12.5"/></svg>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-6">Tautan Cepat</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-[#40916c] transition-colors">Beranda</a></li>
                    <li><a href="#produk" class="text-gray-400 hover:text-[#40916c] transition-colors">Produk</a></li>
                    <li><a href="#about" class="text-gray-400 hover:text-[#40916c] transition-colors">Tentang Kami</a></li>
                    <li><a href="#contact" class="text-gray-400 hover:text-[#40916c] transition-colors">Kontak</a></li>
               
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-6">Kontak Kami</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 flex-shrink-0 text-gray-400 mt-0.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>Jl. Raya Gunung, Kab. Bogor, Jawa Barat</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 flex-shrink-0 text-gray-400 mt-0.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.63A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72v12a2 2 0 0 1-2 2v3z"/></svg>
                        <span>0812-3456-7890</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 flex-shrink-0 text-gray-400 mt-0.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <span>info@rentaloutdoor.com</span>
                    </li>
                </ul>
            </div>

       
        </div>

        <div class="border-t border-white/10 pt-8 text-center text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} Rental OutDoor. Hak cipta dilindungi undang-undang.</p>
        </div>
    </div>
</footer>
        @stack('scripts')
    </body>
</html>
