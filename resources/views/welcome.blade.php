@extends('layouts.landing')

@section('title', 'Rental OutDoor | Sewa Perlengkapan Outdoor')

@section('content')
   

{{-- hero --}}
<section id="home" class="relative w-full h-screen overflow-hidden">

  <img src="{{ asset('img/hero.webp') }}" alt="hero"
       class="absolute inset-0 w-full h-full object-cover">

  <div class="absolute inset-0 bg-black/50"></div>
  <div class="relative z-10 flex flex-col items-center justify-center h-full px-6 text-center text-white">
    <h1 class="text-4xl md:text-6xl font-bold mb-4">Sewa Perlengkapan Outdoor</h1>
    <p class="text-base md:text-xl max-w-xl mb-8 text-gray-200">
      Tenda, carrier, sleeping bag, dan perlengkapan petualangan lainnya dengan harga terjangkau.
    </p>
    <a href="#produk" class="bg-white text-black font-medium px-6 py-3 rounded-lg hover:bg-gray-200 transition">
      Lihat Katalog
    </a>
  </div>
</section>

<section id="about" class="max-w-7xl mx-auto pt-12 pb-20">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-[#1b1b18] mb-4">Mengapa Memilih Kami</h2>
        <p class="text-base md:text-lg text-[#666] max-w-xl mx-auto">
            Kami hadir untuk membuat petualangan outdoormu lebih mudah, hemat, dan menyenangkan.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 px-4 sm:px-6 lg:px-8">
        <!-- Kualitas -->
        <div class="bg-white border border-slate-200 hover:border-black rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300 group">
            <div class="w-14 h-14 rounded-xl bg-[#f5f5f0] flex items-center justify-center mb-6 group-hover:rotate-12 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-[#4a5568]">
                    <path d="m3 21 9-6 9 6"/>
                    <path d="M12 15V9"/>
                    <path d="M3 21h18"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-[#1b1b18] mb-3">Perlengkapan Berkualitas</h3>
            <p class="text-[#666] leading-relaxed text-sm">
                Setiap tenda, carrier, dan sleeping bag kami teruji keawetan di lapangan, jadi petualanganmu tetap aman dan nyaman di segala medan.
            </p>
        </div>

        <!-- Harga -->
        <div class="bg-white border border-slate-200 hover:border-black  rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300 group">
            <div class="w-14 h-14 rounded-xl bg-[#f5f5f0] flex items-center justify-center mb-6 group-hover:rotate-12 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-[#4a5568]">
                    <circle cx="12" cy="12" r="8"/>
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h8a3.5 3.5 0 0 1 0 7"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-[#1b1b18] mb-3">Harga Sewa Terjangkau</h3>
            <p class="text-[#666] leading-relaxed text-sm">
                Nikmati perlengkapan outdoor prima dengan harga sewa yang ramah kantong tanpa mengorbankan kualitas dan kenyamanan.
            </p>
        </div>

        <!-- Pengiriman -->
        <div class="bg-white border border-slate-200 hover:border-black rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300 group">
            <div class="w-14 h-14 rounded-xl bg-[#f5f5f0] flex items-center justify-center mb-6 group-hover:rotate-12 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-[#4a5568]">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-[#1b1b18] mb-3">Proses Sewa Cepat</h3>
            <p class="text-[#666] leading-relaxed text-sm">
                Pemesanan online sederhana, konfirmasi cepat, dan pengiriman tepat waktu langsung ke lokasi petualanganmu.
            </p>
        </div>
    </div>
</section>

{{-- section produk --}}

<section id="produk" class="max-w-7xl mx-auto pt-12 pb-20">
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
    </div>
</section>

{{-- galeri --}}

<section id="galeri" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mb-10 flex flex-col items-center text-center">
        <span class="mb-3 text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Momen petualangan</span>
        <h2 class="text-3xl font-bold text-[#1b1b18] md:text-4xl">Galeri Kami</h2>
        <p class="mt-3 max-w-xl text-sm leading-6 text-gray-600 sm:text-base">
            Intip keseruan perjalanan dan perlengkapan yang menemani setiap petualangan.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <button type="button" class="gallery-item group relative overflow-hidden rounded-2xl bg-gray-100 text-left shadow-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/40" data-src="https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&amp;fit=crop&amp;w=1600&amp;q=90" data-title="Menikmati alam terbuka" data-description="Pemandangan gunung dan danau yang menenangkan menjadi salah satu alasan untuk terus menjelajah." aria-label="Lihat detail foto Menikmati alam terbuka">
            <img class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&amp;fit=crop&amp;w=1200&amp;q=85" alt="Pemandangan gunung dan danau" loading="lazy">
            <span class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></span>
            <span class="absolute inset-x-0 bottom-0 flex items-end justify-between p-5 text-white">
                <span>
                    <span class="block text-lg font-semibold">Menikmati alam terbuka</span>
                    <span class="mt-1 block text-sm text-white/80">Momen petualangan</span>
                </span>
                <span class="grid h-10 w-10 place-items-center rounded-full bg-white/20 backdrop-blur transition group-hover:bg-white group-hover:text-gray-900" aria-hidden="true">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 3h6v6M14 10l7-7M10 14l-7 7m0-6v6h6"/></svg>
                </span>
            </span>
        </button>
        <button type="button" class="gallery-item group relative overflow-hidden rounded-2xl bg-gray-100 text-left shadow-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/40" data-src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&amp;fit=crop&amp;w=1600&amp;q=90" data-title="Jalur menuju puncak" data-description="Persiapan yang matang dan perlengkapan yang tepat membuat perjalanan menuju puncak terasa lebih nyaman." aria-label="Lihat detail foto Jalur menuju puncak">
            <img class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&amp;fit=crop&amp;w=1200&amp;q=85" alt="Lanskap pegunungan untuk perjalanan menuju puncak" loading="lazy">
            <span class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></span>
            <span class="absolute inset-x-0 bottom-0 flex items-end justify-between p-5 text-white">
                <span>
                    <span class="block text-lg font-semibold">Jalur menuju puncak</span>
                    <span class="mt-1 block text-sm text-white/80">Cerita di perjalanan</span>
                </span>
                <span class="grid h-10 w-10 place-items-center rounded-full bg-white/20 backdrop-blur transition group-hover:bg-white group-hover:text-gray-900" aria-hidden="true">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 3h6v6M14 10l7-7M10 14l-7 7m0-6v6h6"/></svg>
                </span>
            </span>
        </button>
        <button type="button" class="gallery-item group relative overflow-hidden rounded-2xl bg-gray-100 text-left shadow-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/40" data-src="https://images.unsplash.com/photo-1511497584788-876760111969?auto=format&amp;fit=crop&amp;w=1600&amp;q=90" data-title="Jelajah hutan pinus" data-description="Suasana teduh hutan membuat perjalanan singkat maupun berkemah terasa semakin berkesan." aria-label="Lihat detail foto Jelajah hutan pinus">
            <img class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1511497584788-876760111969?auto=format&amp;fit=crop&amp;w=1200&amp;q=85" alt="Hutan pinus yang rimbun" loading="lazy">
            <span class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></span>
            <span class="absolute inset-x-0 bottom-0 flex items-end justify-between p-5 text-white">
                <span>
                    <span class="block text-lg font-semibold">Jelajah hutan pinus</span>
                    <span class="mt-1 block text-sm text-white/80">Perlengkapan petualang</span>
                </span>
                <span class="grid h-10 w-10 place-items-center rounded-full bg-white/20 backdrop-blur transition group-hover:bg-white group-hover:text-gray-900" aria-hidden="true">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 3h6v6M14 10l7-7M10 14l-7 7m0-6v6h6"/></svg>
                </span>
            </span>
        </button>
    </div>
</section>

<div id="lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-4 backdrop-blur-sm" role="dialog" aria-modal="true" aria-labelledby="lightbox-title" aria-hidden="true">
    <button id="lightbox-close" type="button" class="absolute right-4 top-4 z-10 grid h-11 w-11 place-items-center rounded-full bg-white/10 text-white transition hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white" aria-label="Tutup detail foto">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="m18 6-12 12M6 6l12 12"/></svg>
    </button>
    <button id="lightbox-prev" type="button" class="absolute left-3 top-1/2 z-10 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white transition hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white sm:left-6 sm:h-12 sm:w-12" aria-label="Foto sebelumnya">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6"/></svg>
    </button>
    <figure class="w-full max-w-5xl">
        <img id="lightbox-img" class="mx-auto max-h-[72vh] w-auto max-w-full rounded-xl object-contain shadow-2xl" src="" alt="">
        <figcaption class="mx-auto mt-5 max-w-2xl text-center text-white">
            <h3 id="lightbox-title" class="text-xl font-semibold sm:text-2xl"></h3>
            <p id="lightbox-description" class="mt-2 text-sm leading-6 text-white/75 sm:text-base"></p>
            <p id="lightbox-counter" class="mt-4 text-xs font-medium tracking-widest text-white/60"><span id="lightbox-current">1</span> / <span id="lightbox-total">3</span></p>
        </figcaption>
    </figure>
    <button id="lightbox-next" type="button" class="absolute right-3 top-1/2 z-10 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white transition hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white sm:right-6 sm:h-12 sm:w-12" aria-label="Foto berikutnya">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
    </button>
</div>

{{-- cara sewa --}}


<section class="bg-black text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Cara Sewa</h2>
            <p class="text-gray-400 max-w-xl mx-auto">
                Tiga langkah sederhana dari pemilihan sampai pengembalian.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Langkah 1 -->
            <div class="relative p-8 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 transition-all">
                <div class="w-10 h-10 rounded-full bg-gray-400 flex items-center justify-center text-black font-bold mb-6">1</div>
             
                <h3 class="text-lg font-bold mb-3">Pilih Produk</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Jelajahi katalog perlengkapan outdoor dan pilih alat yang kamu butuhkan.
                </p>
            </div>

            <!-- Langkah 2 -->
            <div class="relative p-8 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 transition-all">
                <div class="w-10 h-10 rounded-full bg-gray-400 flex items-center justify-center text-black font-bold mb-6">2</div>
                             <h3 class="text-lg font-bold mb-3">Sewa Sekarang</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Konfirmasi tanggal sewa dan jumlah alat melalui halaman detail produk.
                </p>
            </div>

            <!-- Langkah 3 -->
            <div class="relative p-8 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 transition-all">
                <div class="w-10 h-10 rounded-full bg-gray-400 flex items-center justify-center text-black font-bold mb-6">3</div>
              
                <h3 class="text-lg font-bold mb-3">Ambil &amp; Kembalikan</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Ambil perlengkapan di lokasi kami dan kembalikan tepat waktu setelah selesai.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-16 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-[#1b1b18] mb-4">Apa Kata Mereka</h2>
            <p class="text-[#666] max-w-xl mx-auto">
                Cerita petualangan pelanggan kami yang sudah menyewa perlengkapan outdoor.
            </p>
        </div>

        <div x-data="{ current: 0, total: 3, previous() { this.current = (this.current - 1 + this.total) % this.total }, next() { this.current = (this.current + 1) % this.total } }" class="relative">
            <div class="overflow-hidden rounded-2xl">
                <div class="flex w-[300%] transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (current * 100 / total) + '%)'">
                    <!-- Testimonial 1 -->
                    <div class="w-1/3 flex-none rounded-2xl border border-gray-100 bg-gray-50 p-6 sm:p-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-[#f5f5f0] flex items-center justify-center text-[#1b1b18] font-bold">AD</div>
                            <div>
                                <h4 class="text-sm font-bold text-[#1b1b18]">Andi Dewanto</h4>
                                <p class="text-xs text-[#666]">Pendaki Gunung</p>
                            </div>
                        </div>
                        <div class="flex text-yellow-400 mb-4">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-[#1b1b18] leading-relaxed text-sm mb-6">
                            "Sangat puas dengan kualitas tenda yang disewa. Tahan panas dan hujan, cocok untuk pemukiman di gunung."
                        </p>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="w-1/3 flex-none rounded-2xl border border-gray-100 bg-gray-50 p-6 sm:p-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-[#f5f5f0] flex items-center justify-center text-[#1b1b18] font-bold">SR</div>
                            <div>
                                <h4 class="text-sm font-bold text-[#1b1b18]">Siti Rahayu</h4>
                                <p class="text-xs text-[#666]">Penjelajah Alam</p>
                            </div>
                        </div>
                        <div class="flex text-yellow-400 mb-4">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-[#1b1b18] leading-relaxed text-sm mb-6">
                            "Proses sewa sangat cepat dan alatnya bersih. Sleeping bagnya hangat banget di tempat dingin."
                        </p>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="w-1/3 flex-none rounded-2xl border border-gray-100 bg-gray-50 p-6 sm:p-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-[#f5f5f0] flex items-center justify-center text-[#1b1b18] font-bold">BM</div>
                            <div>
                                <h4 class="text-sm font-bold text-[#1b1b18]">Budi Mahesa</h4>
                                <p class="text-xs text-[#666]">Camping Hobi</p>
                            </div>
                        </div>
                        <div class="flex text-yellow-400 mb-4">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.384-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-[#1b1b18] leading-relaxed text-sm mb-6">
                            "Carrier yang disewa nyaman dipakai untuk trekking panjang. Harga juga terjangkau untuk mahasiswa."
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-center gap-5">
                <button type="button" @click="previous()" class="grid h-10 w-10 place-items-center rounded-full border border-gray-200 text-gray-700 transition hover:border-[#1b1b18] hover:bg-[#1b1b18] hover:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500" aria-label="Testimoni sebelumnya">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6"/></svg>
                </button>
                <div class="flex items-center gap-2" aria-label="Pilih testimoni">
                    <button type="button" @click="current = 0" :class="current === 0 ? 'w-6 bg-[#1b1b18]' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all" aria-label="Tampilkan testimoni 1" :aria-current="current === 0"></button>
                    <button type="button" @click="current = 1" :class="current === 1 ? 'w-6 bg-[#1b1b18]' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all" aria-label="Tampilkan testimoni 2" :aria-current="current === 1"></button>
                    <button type="button" @click="current = 2" :class="current === 2 ? 'w-6 bg-[#1b1b18]' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all" aria-label="Tampilkan testimoni 3" :aria-current="current === 2"></button>
                </div>
                <button type="button" @click="next()" class="grid h-10 w-10 place-items-center rounded-full border border-gray-200 text-gray-700 transition hover:border-[#1b1b18] hover:bg-[#1b1b18] hover:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500" aria-label="Testimoni berikutnya">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>


@endsection
