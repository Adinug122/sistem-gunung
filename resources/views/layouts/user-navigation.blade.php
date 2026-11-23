
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
                                <span class="material-symbols-outlined text-white text-2xl">
                                    shopping_cart
                                </span>
                                <span x-show="$store.cart.count > 0" x-text="$store.cart.count"
                                      class="absolute -top-1 -right-1 bg-[#40916c] text-white text-[10px] font-bold rounded-full px-1.5 py-0.5 leading-none">
                                </span>
                            </a>

                            <a href="{{ route('customer.profile.edit') }}" class="relative group">
                                <span class="material-symbols-outlined text-white text-2xl">
                                    account_circle
                                </span>
                            </a>
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
                                <a href="{{ route('home') }}" class="block rounded px-3 py-2 transition-colors md:p-0 {{ request()->routeIs('home') ? 'bg-white/10 text-white md:bg-transparent' : 'text-gray-300 hover:bg-white/10 hover:text-white md:hover:bg-transparent' }}" @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}" class="block rounded px-3 py-2 transition-colors md:p-0 {{ request()->routeIs('about') ? 'bg-white/10 text-white md:bg-transparent' : 'text-gray-300 hover:bg-white/10 hover:text-white md:hover:bg-transparent' }}" @if (request()->routeIs('about')) aria-current="page" @endif>About</a>
                            </li>
                            <li>
                                <a href="{{ route('produk') }}" class="block rounded px-3 py-2 transition-colors md:p-0 {{ request()->routeIs('produk', 'produk.detail') ? 'bg-white/10 text-white md:bg-transparent' : 'text-gray-300 hover:bg-white/10 hover:text-white md:hover:bg-transparent' }}" @if (request()->routeIs('produk', 'produk.detail')) aria-current="page" @endif>Produk</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="block rounded px-3 py-2 transition-colors md:p-0 {{ request()->routeIs('contact') ? 'bg-white/10 text-white md:bg-transparent' : 'text-gray-300 hover:bg-white/10 hover:text-white md:hover:bg-transparent' }}" @if (request()->routeIs('contact')) aria-current="page" @endif>Kontak</a>
                            </li>
                            <li>
                                @auth
                                    {{-- <a href="{{ route(auth()->user()->isAdmin() ? 'dashboard' : 'dashboardUser') }}" class="block rounded px-3 py-2 text-gray-300 hover:bg-white/10 hover:text-white">Dashboard</a> --}}
                                @else
                                    <a href="{{ route('login') }}" class="block rounded px-3 py-2 text-gray-300 hover:bg-white/10 hover:text-white md:hidden">Login</a>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>