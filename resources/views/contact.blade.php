@extends('layouts.landing')

@section('title', 'Kontak Kami | Rental OutDoor')

@section('content')

    {{-- Hero Contact --}}
<section class="relative w-full overflow-hidden">
    <img src="{{ asset('img/hero.webp') }}" alt="hero contact"
         class="h-[55vh] w-full object-cover object-center md:h-[65vh]">
    <div class="absolute inset-0 bg-gradient-to-t from-[#1b1b18]/90 via-[#1b1b18]/40 to-transparent"></div>
    <div class="absolute inset-0 z-10 flex flex-col items-center justify-center px-6 pt-20 text-center text-white">
        <h2 class="mb-4 text-3xl font-bold leading-tight md:text-5xl lg:text-6xl">Hubungi Kami</h2>
        <p class="max-w-2xl text-sm leading-relaxed text-gray-200 md:text-lg">
            Ada pertanyaan tentang sewa perlengkapan outdoor? Kami siap membantu petualanganmu.
        </p>
    </div>
</section>
    {{-- Info Cards --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Telepon -->
                <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition-shadow group">
                    <div class="w-12 h-12 rounded-full bg-[#1b1b18] flex items-center justify-center mx-auto mb-4 text-white group-hover:bg-[#40916c] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.63A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72v12a2 2 0 0 1-2 2v3z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-[#1b1b18] mb-2">Telepon</h4>
                    <p class="text-[#1b1b18] font-semibold">0812-3456-7890</p>
                    <p class="text-[#666] text-sm mt-2">Hubungi kami setiap hari</p>
                </div>

                <!-- Email -->
                <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition-shadow group">
                    <div class="w-12 h-12 rounded-full bg-[#1b1b18] flex items-center justify-center mx-auto mb-4 text-white group-hover:bg-[#40916c] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-[#1b1b18] mb-2">Email</h4>
                    <p class="text-[#1b1b18] font-semibold">info@rentaloutdoor.com</p>
                    <p class="text-[#666] text-sm mt-2">Kami akan membalas secepatnya</p>
                </div>

                <!-- Lokasi -->
                <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition-shadow group">
                    <div class="w-12 h-12 rounded-full bg-[#1b1b18] flex items-center justify-center mx-auto mb-4 text-white group-hover:bg-[#40916c] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-[#1b1b18] mb-2">Lokasi</h4>
                    <p class="text-[#1b1b18] font-semibold">Jl. Raya Gunung</p>
                    <p class="text-[#666] text-sm mt-2">Kab. Bogor, Jawa Barat</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Working Time & Form --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-[#f5f5f0]">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Working Hours -->
                <div>
                    <h3 class="text-2xl font-bold text-[#1b1b18] mb-8">Jam Operasional</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-4 bg-white rounded-xl border border-gray-200 group hover:bg-[#f5f5f0] transition-colors">
                            <span class="text-[#1b1b18] font-medium">Senin - Jumat</span>
                            <span class="text-[#1b1b18] font-semibold">07:00 - 17:00</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-white rounded-xl border border-gray-200 group hover:bg-[#f5f5f0] transition-colors">
                            <span class="text-[#1b1b18] font-medium">Sabtu</span>
                            <span class="text-[#1b1b18] font-semibold">08:00 - 15:00</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-white rounded-xl border border-gray-200 group hover:bg-[#f5f5f0] transition-colors">
                            <span class="text-[#1b1b18] font-medium">Minggu &amp; Hari Libur</span>
                            <span class="text-[#1b1b18] font-semibold">Tutup</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <h3 class="text-2xl font-bold text-[#1b1b18] mb-8">Kirim Pesan</h3>
                    <form action="#" method="POST" class="space-y-4" @submit.prevent>
                        <div>
                            <label class="block text-sm font-medium text-[#1b1b18] mb-1">Nama Lengkap</label>
                            <input type="text" name="name" placeholder="Masukkan nama anda"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#40916c] focus:border-[#40916c] outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1b1b18] mb-1">Email</label>
                            <input type="email" name="email" placeholder="email@example.com"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#40916c] focus:border-[#40916c] outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1b1b18] mb-1">Subjek</label>
                            <input type="text" name="subject" placeholder="Tentang sewa perlengkapan outdoor"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#40916c] focus:border-[#40916c] outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1b1b18] mb-1">Pesan</label>
                            <textarea name="message" rows="5" placeholder="Tulis pesan anda di sini..."
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#40916c] focus:border-[#40916c] outline-none transition-colors"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-[#1b1b18] text-white font-medium py-3 rounded-lg hover:bg-[#40916c] transition-colors">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Location --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <iframe class="w-full h-[400px] md:h-[500px] border-0"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.365747379043!2d106.78373141433631!3d-6.595160395420431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6b8f8a5b5f1%3A0x8f7a4b3c2d1e5f6a!2sJl.%20Raya%20Gunung%2C%20Kab.%20Bogor%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1234567890!5m2!1sid!2sid"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

@endsection
