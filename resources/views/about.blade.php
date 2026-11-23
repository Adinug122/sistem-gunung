@extends('layouts.landing')

@section('title', 'Tentang Kami | Rental OutDoor')

@section('content')

<section id="home" class="relative w-full min-h-[320px] pt-20 md:min-h-[620px] overflow-hidden flex items-center">

    <img
        src="{{ asset('img/about.webp') }}"
        alt="Perlengkapan outdoor"
        class="absolute inset-0 w-full h-full object-cover object-center"
    >

    <div class="absolute inset-0 bg-black/50"></div>

    <div class="relative z-10 w-full max-w-7.5xl mx-auto px-8 md:px-16 lg:px-24 py-12 text-white">

        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
            Sewa Perlengkapan Outdoor
        </h1>

        <p class="text-sm md:text-lg text-gray-200 max-w-2xl mb-8 leading-relaxed">
            Tenda, carrier, sleeping bag, dan perlengkapan petualangan lainnya dengan harga terjangkau.
        </p>

        <a href="{{ route('home') }}#produk"
           class="inline-block bg-white text-black font-semibold px-6 py-3 rounded-lg hover:bg-gray-200 transition duration-300">
            Lihat Katalog
        </a>

    </div>
</section>




<section id="tentang" class="relative isolate overflow-hidden bg-[#f7f7f2] px-6 py-20 sm:py-24 lg:px-8 lg:py-32">
    <div class="pointer-events-none absolute -right-32 -top-32 -z-10 h-96 w-96 rounded-full bg-emerald-100/60 blur-3xl"></div>
    <div class="mx-auto max-w-7xl">
        <div class="grid items-center gap-14 lg:grid-cols-[0.95fr_1.05fr] lg:gap-20">
            <div class="max-w-2xl">
            

                <h2 class="mt-7 text-4xl font-semibold leading-[1.12] tracking-tight text-[#17231d] sm:text-5xl lg:text-6xl">
                    Lebih dekat dengan alam, <span class=" text-emerald-800">lebih mudah</span> memulai petualangan.
                </h2>

                <p class="mt-7 max-w-xl text-base leading-8 text-gray-600 sm:text-lg">
                    Kami percaya pengalaman terbaik tidak harus dimulai dengan memiliki banyak perlengkapan. Cukup bawa rasa ingin tahu—biar kami bantu menyiapkan sisanya.
                </p>
                <p class="mt-4 max-w-xl text-sm leading-7 text-gray-500 sm:text-base">
                    Rental OutDoor hadir untuk menemani perjalananmu dengan perlengkapan camping pilihan yang praktis disewa, nyaman digunakan, dan ramah di kantong.
                </p>

                <a href="{{ route('home') }}#produk" class="group mt-8 inline-flex items-center gap-3 rounded-full bg-[#17231d] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-emerald-950/10 transition hover:bg-emerald-900 focus:outline-none focus:ring-4 focus:ring-emerald-800/20">
                    Temukan perlengkapanmu
                    <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/>
                    </svg>
                </a>

                <div class="mt-12 flex flex-wrap items-center gap-x-8 gap-y-4 border-t border-gray-200 pt-7">
                    <div class="flex items-center gap-3">
                        <span class="grid h-10 w-10 place-items-center rounded-full bg-emerald-900/10 text-emerald-900">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m3 17 6-6 4 4 8-8M15 7h6v6"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium text-gray-700">Praktis dari awal</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="grid h-10 w-10 place-items-center rounded-full bg-emerald-900/10 text-emerald-900">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m12 3 2.7 5.5 6.1.9-4.4 4.3 1 6.1-5.4-2.9-5.4 2.9 1-6.1-4.4-4.3 6.1-.9L12 3Z"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium text-gray-700">Dipilih untuk bertualang</span>
                    </div>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-xl lg:max-w-none">

                <div class="relative aspect-[4/4.5] overflow-hidden rounded-[2rem] bg-emerald-950 shadow-2xl shadow-emerald-950/15">
                    <img
                        src="{{ asset('img/tentang.jpg') }}"
                        alt="Suasana camping dan menikmati alam terbuka"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-[#101b15]/80 via-transparent to-transparent"></div>
                    
                </div>
                <div class="absolute -bottom-6 right-4 max-w-[15rem] rounded-2xl border border-white/70 bg-white/95 p-5 shadow-xl shadow-gray-900/10 backdrop-blur sm:-right-5 sm:p-6">
                    <div class="flex items-center gap-3">
                        <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-emerald-900 text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5v9L12 21l-9-4.5v-9ZM3.5 7.8 12 12l8.5-4.2M12 12v8.5"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Siap menemani</p>
                            <p class="mt-1 text-xs leading-5 text-gray-500">Dari perjalanan singkat hingga malam di alam.</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-8 left-4 -z-10 h-24 w-24 rounded-full border border-emerald-800/20 sm:left-8"></div>
            </div>
        </div>

        <div class="mt-24 grid gap-4 border-t border-gray-200 pt-8 sm:grid-cols-3 sm:gap-6 lg:mt-32">
            <article class="group rounded-2xl p-5 transition hover:bg-white hover:shadow-lg hover:shadow-gray-900/5 sm:p-6">
                <span class="text-xs font-semibold tracking-[0.18em] text-emerald-800">01 / MUDAH</span>
                <h3 class="mt-4 text-xl font-semibold text-[#17231d]">Sewa tanpa repot</h3>
                <p class="mt-2 text-sm leading-6 text-gray-500">Pilih perlengkapan sesuai rencana, tanpa perlu membeli dan menyimpan semuanya sendiri.</p>
            </article>
            <article class="group rounded-2xl p-5 transition hover:bg-white hover:shadow-lg hover:shadow-gray-900/5 sm:p-6">
                <span class="text-xs font-semibold tracking-[0.18em] text-emerald-800">02 / BERSAHABAT</span>
                <h3 class="mt-4 text-xl font-semibold text-[#17231d]">Lebih ramah di kantong</h3>
                <p class="mt-2 text-sm leading-6 text-gray-500">Nikmati perlengkapan yang kamu butuhkan dengan biaya yang sesuai perjalanan.</p>
            </article>
            <article class="group rounded-2xl p-5 transition hover:bg-white hover:shadow-lg hover:shadow-gray-900/5 sm:p-6">
                <span class="text-xs font-semibold tracking-[0.18em] text-emerald-800">03 / JELAJAH</span>
                <h3 class="mt-4 text-xl font-semibold text-[#17231d]">Fokus pada pengalaman</h3>
                <p class="mt-2 text-sm leading-6 text-gray-500">Persiapkan rencana perjalananmu; perlengkapan untuk berangkat bisa kami bantu.</p>
            </article>
        </div>
    </div>
</section>


{{-- tim kami --}}

<section class="max-w-7xl mx-auto pt-10">
  <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-[#1b1b18] mb-4">Tim Kami</h2>
            <p class="text-[#666] max-w-xl mx-auto">
             Orang-orang yang mewadahi kami dalam membangun bisnis ini
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 px-4 py-2">
            <div class=" rounded-lg  p-6 mb-4">
                <div class="flex rounded-lg justify-center  items-center mb-4">
                    <img class="w-100 h-96 object-cover mr-4" src="{{ asset('img/pendaki1.jpg') }}" alt="Foto Testimoni 1">
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold">Rizky Pratama</h3>
                    <p class="text-sm text-gray-600">Tim Leader</p>
                </div>
               
            </div>
            <div class=" rounded-lg  p-6 mb-4">
                <div class="flex rounded-lg justify-center  items-center mb-4">
                    <img class="w-100 h-96 object-cover mr-4" src="{{ asset('img/pendaki2.jpg') }}" alt="Foto Testimoni 1">
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold">Andika Septian</h3>
                    <p class="text-sm text-gray-600">Anggota</p>
                </div>
               
            </div>
            <div class=" rounded-lg  p-6 mb-4">
                <div class="flex rounded-lg justify-center  items-center mb-4">
                    <img class="w-100 h-96 object-cover mr-4" src="{{ asset('img/pendaki3.jpg') }}" alt="Foto Testimoni 1">
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold">Mr Ironi</h3>
                    <p class="text-sm text-gray-600">Anggota</p>
                </div>
               
            </div>

        
        </div>
</section>