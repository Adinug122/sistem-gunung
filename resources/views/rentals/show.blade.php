<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Sewa') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Informasi Sewa -->
            <div class="card mb-6">
                <div class="flex flex-col md:flex-row gap-6 items-start">
                    <div class="w-full md:w-1/3">
                        <div class="w-48 h-48 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            Sewa #{{ $rental->rental_code }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-4">
                            Pelanggan: {{ $rental->user->name ?? '-' }}
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Tanggal Mulai</p>
                                <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($rental->start_date)->format('d M Y') }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Tanggal Selesai</p>
                                <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($rental->end_date)->format('d M Y') }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Total Harga</p>
                                <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Status Sewa</p>
                                <p class="text-lg font-semibold
                                    @if ($rental->status === 'menunggu_pembayaran') text-yellow-700
                                    @elseif ($rental->status === 'dibayar') text-blue-700
                                    @elseif ($rental->status === 'diambil') text-green-700
                                    @elseif ($rental->status === 'selesai') text-gray-700
                                    @elseif ($rental->status === 'dibatalkan') text-red-700
                                    @else text-gray-700
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $rental->status)) }}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3 mb-6">
                            <a href="{{ route('rentals.index') }}" class="text-[#40916c] hover:text-[#14532d] font-medium">
                                ← Kembali ke Daftar Sewa
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Jaminan -->
            <div class="card mb-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wider border-b border-gray-100 pb-2">
                    Jaminan Identitas
                </h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Jenis Dokumen</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $rental->jaminan_type ? $rental->jaminanLabel() : '-' }}
                        </p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Status Jaminan</p>
                        <p class="text-lg font-semibold
                            @if ($rental->jaminan_status === 'belum_diterima') text-gray-700
                            @elseif ($rental->jaminan_status === 'ditahan') text-orange-700
                            @elseif ($rental->jaminan_status === 'dikembalikan') text-green-700
                            @else text-gray-700
                            @endif">
                            {{ $rental->jaminan_status ? $rental->jaminanStatusLabel() : 'Belum Diterima' }}
                        </p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Waktu Terima Jaminan</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $rental->jaminan_received_at ? \Carbon\Carbon::parse($rental->jaminan_received_at)->format('d M Y H:i') : '-' }}
                        </p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Waktu Kembali Jaminan</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $rental->jaminan_returned_at ? \Carbon\Carbon::parse($rental->jaminan_returned_at)->format('d M Y H:i') : '-' }}
                        </p>
                    </div>
                </div>

                <!-- Aksi Jaminan -->
                @if ($rental->status === 'dibayar' && $rental->jaminan_status === 'belum_diterima')
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <p class="text-sm text-blue-800 mb-3">
                            Pembayaran telah dikonfirmasi. Silakan terima dokumen identitas asli pelanggan
                            ({{ $rental->jaminanLabel() ?? 'KTP/SIM/KTM/Kartu Pelajar' }}) dan pilih jenis dokumen
                            sebelum mengonfirmasi penyerahan barang.
                        </p>
                        <form action="{{ route('rentals.confirm-pickup', $rental) }}" method="POST">
                            @csrf
                            <div class="space-y-3">
                                <div>
                                    <x-input-label value="Jenis Dokumen Jaminan" />
                                    <select name="jaminan_type" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="ktp">KTP</option>
                                        <option value="sim">SIM</option>
                                        <option value="ktm">KTM</option>
                                        <option value="kartu_pelajar">Kartu Pelajar</option>
                                    </select>
                                </div>
                                <x-primary-button>
                                    Konfirmasi Pengambilan Barang
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                @elseif ($rental->status === 'diambil' && $rental->jaminan_status === 'ditahan')
                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 mb-4">
                        <p class="text-sm text-orange-800 mb-3">
                            Dokumen identitas <strong>{{ $rental->jaminanLabel() }}</strong> sedang ditahan admin.
                            Setelah memeriksa kondisi barang dan memastikan seluruh barang dikembalikan, silakan
                            konfirmasi pengembalian dokumen jaminan kepada pelanggan.
                        </p>
                        <form action="{{ route('rentals.confirm-return', $rental) }}" method="POST">
                            @csrf
                            <x-primary-button>
                                Proses Pengembalian Barang dan Jaminan
                            </x-primary-button>
                        </form>
                    </div>
                @elseif ($rental->status === 'selesai')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-sm text-green-800">
                            Sewa telah selesai. Dokumen jaminan <strong>{{ $rental->jaminanLabel() }}</strong>
                            telah dikembalikan kepada pelanggan pada
                            {{ $rental->jaminan_returned_at ? \Carbon\Carbon::parse($rental->jaminan_returned_at)->format('d M Y H:i') : '-' }}.
                        </p>
                    </div>
                @endif
            </div>

            <!-- Detail Item Sewa -->
            <div class="card mb-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wider border-b border-gray-100 pb-2">
                    Detail Item
                </h4>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50">
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Produk</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-center">Qty</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-right">Harga/Hari</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($rental->rentalDetails as $detail)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $detail->product->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900">{{ $detail->quantity }}</td>
                                    <td class="px-6 py-4 text-sm text-right text-gray-900">Rp {{ number_format($detail->price_per_day, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-right text-gray-900">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        Tidak ada detail item.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pembayaran -->
            @if ($rental->payment)
                <div class="card">
                    <h4 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wider border-b border-gray-100 pb-2">
                        Pembayaran
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-500 uppercase font-semibold">Metode</p>
                            <p class="text-lg font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $rental->payment->payment_method ?? '-') }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-500 uppercase font-semibold">Status</p>
                            <p class="text-lg font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $rental->payment->payment_status ?? '-') }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-500 uppercase font-semibold">Jumlah</p>
                            <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($rental->payment->amount ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
