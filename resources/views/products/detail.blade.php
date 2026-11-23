@extends('layouts.landing')

@section('title', $product->name.' | Rental OutDoor')

@section('content')
    <section class="bg-[#f5f5f0] px-4 pb-16 pt-28 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <nav class="mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-[#40916c]">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('produk') }}" class="transition hover:text-[#40916c]">Produk</a>
                <span class="mx-2">/</span>
                <span class="font-medium text-[#1b1b18]">{{ $product->name }}</span>
            </nav>

            <div class="grid items-start gap-8 lg:grid-cols-[minmax(0,1.6fr)_minmax(19rem,0.8fr)]">
                <div>
                    <div class="mb-5">
                        <p class="mb-2 text-sm font-semibold uppercase tracking-[0.16em] text-[#40916c]">
                            {{ $product->category->name ?? 'Perlengkapan Outdoor' }}
                        </p>
                        <h1 class="text-3xl font-bold leading-tight text-[#1b1b18] sm:text-4xl">
                            {{ $product->name }}
                        </h1>
                    </div>

                    <div class="flex aspect-[4/3] items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 sm:p-10">
                        @if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                            <img
                                src="{{ asset('storage/'.$product->image) }}"
                                alt="{{ $product->name }}"
                                class="h-full w-full object-contain"
                            >
                        @else
                            <div class="flex h-full w-full items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" class="h-20 w-20" aria-hidden="true">
                                    <path d="m21 15-5.2-5.2a2 2 0 0 0-2.8 0L10 11l-4.2-4.2a2 2 0 0 0-2.8 0L2 8v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2Z"/>
                                    <circle cx="9" cy="8" r="2"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 sm:p-8">
                        <h2 class="text-xl font-bold text-[#1b1b18]">Deskripsi</h2>
                        <p class="mt-4 whitespace-pre-line text-sm leading-7 text-gray-600 sm:text-base">
                            {{ $product->description }}
                        </p>
                        <dl class="mt-6 grid gap-4 border-t border-slate-200 pt-5 sm:grid-cols-2">
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Kategori</dt>
                                <dd class="mt-1 font-medium text-[#1b1b18]">{{ $product->category->name ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Kondisi</dt>
                                <dd class="mt-1 font-medium capitalize text-[#1b1b18]">{{ str_replace('_', ' ', $product->condition) }}</dd>
                            </div>
                        </dl>
                    </section>
                </div>

                <aside class="space-y-6 lg:sticky lg:top-28">
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-7">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Harga sewa</p>
                                <p class="mt-1 text-2xl font-bold text-[#1b1b18]">
                                    Rp {{ number_format($product->price_per_day, 0, ',', '.') }}
                                    <span class="text-sm font-medium text-gray-500">/ hari</span>
                                </p>
                            </div>
                            <span class="rounded-lg bg-[#f5f5f0] px-3 py-2 text-sm font-semibold text-[#40916c]">
                                Stok {{ $product->stock }}
                            </span>
                        </div>

                        <p class="mt-5 rounded-xl bg-[#f5f5f0] p-4 text-sm leading-6 text-gray-600">
                            Harga sewa dihitung per hari. Atur jumlah dan durasi saat proses pemesanan.
                        </p>

                        @if ($product->stock > 0)
                            @auth
                                <button
                                    x-data="{ adding: false }"
                                    @click.prevent="adding = true; $store.cart.add($el.dataset.id).finally(() => adding = false)"
                                    :disabled="adding"
                                    data-id="{{ $product->id }}"
                                    class="mt-5 w-full rounded-xl bg-[#40916c] px-5 py-3.5 text-center font-semibold text-white transition hover:bg-[#1b1b18] disabled:cursor-not-allowed disabled:opacity-70"
                                    x-text="adding ? 'Menambahkan...' : 'Tambah ke Keranjang'"
                                ></button>
                            @else
                                <a href="{{ route('login') }}" class="mt-5 block w-full rounded-xl bg-[#40916c] px-5 py-3.5 text-center font-semibold text-white transition hover:bg-[#1b1b18]">
                                    Login untuk Menyewa
                                </a>
                            @endauth
                        @else
                            <button type="button" disabled class="mt-5 w-full cursor-not-allowed rounded-xl bg-gray-300 px-5 py-3.5 font-semibold text-gray-600">
                                Stok Habis
                            </button>
                        @endif
                    </section>

                    @if ($relatedProducts->isNotEmpty())
                        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h2 class="text-lg font-bold text-[#1b1b18]">Peralatan Lainnya</h2>
                            <div class="mt-4 divide-y divide-slate-200">
                                @foreach ($relatedProducts as $relatedProduct)
                                    <a href="{{ route('produk.detail', ['name' => $relatedProduct->name]) }}" class="flex items-center gap-4 py-4 first:pt-0 last:pb-0">
                                        <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-[#f5f5f0]">
                                            @if ($relatedProduct->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($relatedProduct->image))
                                                <img src="{{ asset('storage/'.$relatedProduct->image) }}" alt="" class="h-full w-full object-cover">
                                            @else
                                                <span class="text-xs text-gray-400">Foto</span>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="line-clamp-2 text-sm font-semibold text-[#1b1b18] transition-colors hover:text-[#40916c]">{{ $relatedProduct->name }}</p>
                                            <p class="mt-1 text-sm text-gray-500">Rp {{ number_format($relatedProduct->price_per_day, 0, ',', '.') }}/hari</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </aside>
            </div>

            <a href="{{ route('produk') }}" class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-[#40916c] transition hover:text-[#1b1b18]">
                <span aria-hidden="true">←</span> Kembali ke produk
            </a>
        </div>
    </section>
@endsection
