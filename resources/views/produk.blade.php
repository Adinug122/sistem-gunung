@extends('layouts.landing')

@section('title', 'Produk | Rental OutDoor')

@section('content')
<section id="produk" class="max-w-7xl mx-auto pt-28 pb-20">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-[#1b1b18] mb-4">Produk Unggulan Kami</h2>
        <p class="text-base md:text-lg text-[#666] max-w-xl mx-auto">
            Pilih perlengkapan outdoor terbaik untuk petualanganmu berikutnya.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 px-4 sm:px-6 lg:px-8">
        @forelse ($produk as $product)
            <div class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                <a href="{{ route('produk.detail', ['name' => $product->name]) }}" class="relative block aspect-[4/3] overflow-hidden bg-[#f5f5f0]">
                    @if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                        <img src="{{ asset('storage/'.$product->image) }}"
                             alt="{{ $product->name }}"
                             class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full w-full items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" class="h-16 w-16 opacity-60">
                                <path d="m21 15-5.2-5.2a2 2 0 0 0-2.8 0L10 11l-4.2-4.2a2 2 0 0 0-2.8 0L2 8v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2Z"/>
                                <circle cx="9" cy="8" r="2"/>
                            </svg>
                        </div>
                    @endif
                </a>

                <div class="p-3">
                    <p class="mb-1 text-sm font-medium text-gray-500">{{ $product->category['name'] ?? '-' }}</p>
                    <a href="{{ route('produk.detail', ['name' => $product->name]) }}" class="block">
                        <h3 class="line-clamp-2 min-h-12 text-lg font-bold leading-6 text-[#1b1b18] transition-colors group-hover:text-[#40916c]">
                            {{ $product->name }}
                        </h3>
                    </a>
                    <p class="mt-1 line-clamp-2 min-h-10 text-sm leading-5 text-gray-500">{{ $product->description }}</p>

                    <div class="mt-4 flex items-center justify-between gap-3">
                        <p class="font-bold text-[#40916c]">
                            <span class="text-lg">Rp{{ number_format($product->price_per_day, 0, ',', '.') }}</span>
                            <span class="text-xs font-medium text-gray-500">/hari</span>
                        </p>
                        <button x-data="{ adding: false }"
                                @click.prevent="adding = true; $store.cart.add($el.dataset.id).finally(() => adding = false)"
                                :disabled="adding"
                                data-id="{{ $product->id }}"
                                aria-label="Tambah {{ $product->name }} ke keranjang"
                                class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-[#40916c] text-white transition hover:bg-[#1b1b18] focus:outline-none focus:ring-4 focus:ring-emerald-700/20 disabled:cursor-not-allowed disabled:opacity-70"
                                x-bind:aria-busy="adding">
                            <span class="sr-only" x-text="adding ? 'Menambahkan...' : 'Tambah ke keranjang'"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12l1 14H5L6 7Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V6a3 3 0 0 1 6 0v3"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white border border-slate-200 rounded-2xl p-16 text-center text-[#666]">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 mx-auto mb-3 opacity-50">
                    <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/>
                    <line x1="16" y1="8" x2="2" y2="22"/>
                    <line x1="17" y1="15" x2="9" y2="15"/>
                </svg>
                <p class="text-sm font-medium">Belum ada produk tersedia.</p>
            </div>
        @endforelse

        <div>
        
                    {{ $produk->links() }}
        </div>
    </div>
</section>