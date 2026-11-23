<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Sewa') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm text-gray-500">Kelola transaksi sewa pelanggan.</p>
                </div>
                <a href="{{ route('rentals.create') }}" class="btn-primary">
                    Buat Sewa Baru
                </a>
            </div>

            <div class="card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50">
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Kode Sewa</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Pelanggan</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Tanggal Mulai</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Tanggal Selesai</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-right">Total Harga</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-center">Status</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($rentals as $rental)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $rental->rental_code }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $rental->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ \Carbon\Carbon::parse($rental->start_date)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ \Carbon\Carbon::parse($rental->end_date)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 text-right">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-center">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                        @if ($rental->status === 'menunggu_pembayaran') bg-yellow-100 text-yellow-700
                                        @elseif ($rental->status === 'dibayar') bg-blue-100 text-blue-700
                                        @elseif ($rental->status === 'diambil') bg-green-100 text-green-700
                                        @elseif ($rental->status === 'selesai') bg-gray-100 text-gray-700
                                        @elseif ($rental->status === 'dibatalkan') bg-red-100 text-red-700
                                        @elseif ($rental->status === 'kadaluarsa') bg-gray-100 text-gray-700
                                        @elseif ($rental->status === 'baru') bg-blue-100 text-blue-700
                                        @elseif ($rental->status === 'dirental') bg-green-100 text-green-700
                                        @else bg-gray-100 text-gray-700 
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $rental->status)) }}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right">
                                        <a href="{{ route('rentals.show', $rental) }}" class="text-[#40916c] hover:text-[#14532d] font-medium mr-4">Lihat</a>
                                        <a href="{{ route('rentals.edit', $rental) }}" class="text-blue-600 hover:text-blue-800 font-medium mr-4">Edit</a>
                                        <form action="{{ route('rentals.destroy', $rental) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Yakin ingin menghapus sewa ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada sewa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $rentals->links() }}

        </div>
    </div>
</x-app-layout>
