<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-[#14532d] via-[#40916c] to-[#14532d] rounded-xl p-6 mb-6 text-white shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold mb-1">Selamat datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-[#f1faee]/90 text-sm">Nikmati pengalaman sewa alat gunung terbaik bersama kami.</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('rentals.create') }}" class="btn-primary text-sm">
                            Sewa Alat
                        </a>
                        <a href="{{ route('payments.index') }}" class="btn-outline text-sm">
                            Pembayaran Saya
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Sewa Aktif</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-1">0</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-green-50 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Riwayat Sewa</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-1">0</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Pembayaran Pending</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-1">0</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-yellow-50 text-yellow-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Pengembalian</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-1">0</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7v10a1 1 0 001 1h3m1-11h4a1 1 0 011 1v3m-1-4V7m-3 8V7m0 0L7 7m3 4L7 7m3-4v3"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="card">
                        <h4 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wider">
                            Sewa Terbaru
                        </h4>
                        <div class="p-4 text-center text-gray-400 text-sm">
                            Belum ada riwayat sewa. Mulai sewa alat gunung Anda sekarang.
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="card">
                        <h4 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wider">
                            Aksi Cepat
                        </h4>
                        <div class="space-y-3">
                            <a href="{{ route('rentals.create') }}" class="w-full flex items-center justify-between px-4 py-3 rounded-lg border border-[#40916c] bg-white text-[#14532d] font-medium hover:bg-[#14532d] hover:text-white transition-colors text-left">
                                <span>Buat Sewa Baru</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </a>
                            <a href="{{ route('payments.index') }}" class="w-full flex items-center justify-between px-4 py-3 rounded-lg border border-[#40916c] bg-white text-[#14532d] font-medium hover:bg-[#14532d] hover:text-white transition-colors text-left">
                                <span>Lihat Pembayaran</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="w-full flex items-center justify-between px-4 py-3 rounded-lg border border-[#40916c] bg-white text-[#14532d] font-medium hover:bg-[#14532d] hover:text-white transition-colors text-left">
                                <span>Edit Profil</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-user-layout>
