<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 rounded-xl p-6 mb-6 text-white shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold mb-1">Selamat datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-300 text-sm">Kelola sistem sewa alat gunung Anda dengan mudah dan efisien.</p>
                    </div>
                    <div class="flex space-x-3">
                        <button class="btn-primary text-sm">
                            Tambah Produk
                        </button>
                        <button class="btn-outline text-sm">
                            Lihat Semua Sewa
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Produk</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-1">124</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Sewa Aktif</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-1">23</h3>
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
                            <p class="text-sm text-gray-500 font-medium">Pembayaran Pending</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-1">5</h3>
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
                            <h3 class="text-2xl font-bold text-gray-900 mt-1">8</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Quick Actions -->
                <div class="lg:col-span-1">
                    <div class="card">
                        <h4 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wider">
                            Aksi Cepat
                        </h4>
                        <div class="space-y-3">
                            <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 hover:border-gray-300 transition-colors text-left group">
                                <span class="text-gray-700 font-medium">Tambah Produk Baru</span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 hover:border-gray-300 transition-colors text-left group">
                                <span class="text-gray-700 font-medium">Buat Sewa Baru</span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 hover:border-gray-300 transition-colors text-left group">
                                <span class="text-gray-700 font-medium">Verifikasi Pembayaran</span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 hover:border-gray-300 transition-colors text-left group">
                                <span class="text-gray-700 font-medium">Konfirmasi Pengembalian</span>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Primary Color Toggle -->
                    <div class="card mt-6">
                        <h4 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wider">
                            Tema Warna
                        </h4>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-100">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Primary Color</p>
                                <p class="text-sm font-medium text-gray-900">Hitam / Hijau</p>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="setTheme('black')" id="theme-black" class="w-8 h-8 rounded-full bg-gray-900 border-2 border-transparent focus:outline-none ring-2 ring-gray-300 transition-all" title="Hitam"></button>
                                <button onclick="setTheme('green')" id="theme-green" class="w-8 h-8 rounded-full bg-[#14532d] border-2 border-transparent focus:outline-none ring-2 ring-gray-300 transition-all" title="Hijau"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="lg:col-span-2">
                    <div class="card">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">
                                Aktivitas Terbaru
                            </h4>
                            <a href="#" class="text-xs text-[#40916c] font-medium hover:text-[#14532d] transition-colors">
                                Lihat Semua
                            </a>
                        </div>
                        <div class="overflow-hidden">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-100">
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Aktivitas</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Detail</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 text-sm text-gray-900">04 Nov 2026</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">Sewa baru dibuat</td>
                                        <td class="px-4 py-3 text-sm text-gray-500">Tenda Camping 2 Orang</td>
                                        <td class="px-4 py-3 text-right">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                Aktif
                                            </span>
                                        </td>
                                    </tr>
                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

<script>
    function setTheme(theme) {
        document.documentElement.classList.remove('primary-black', 'primary-green');
        if (theme === 'black') {
            document.documentElement.classList.add('primary-black');
            document.getElementById('theme-black').classList.add('ring-2', 'ring-white');
            document.getElementById('theme-green').classList.remove('ring-2', 'ring-white');
        } else {
            document.documentElement.classList.add('primary-green');
            document.getElementById('theme-green').classList.add('ring-2', 'ring-white');
            document.getElementById('theme-black').classList.remove('ring-2', 'ring-white');
        }
        localStorage.setItem('dashboard-theme', theme);
    }

    // Load saved theme
    const savedTheme = localStorage.getItem('dashboard-theme') || 'black';
    setTheme(savedTheme);

    setTimeout(()=>{
        const themeButtons = document.querySelectorAll('[id^="theme-"]');
        themeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const selectedTheme = button.id.split('-')[1];
                setTheme(selectedTheme);
            });
        });
    })


</script>
