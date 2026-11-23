<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pembayaran') }}
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
                    <p class="text-sm text-gray-500">Kelola data pembayaran dan jaminan sewa.</p>
                </div>
                <a href="{{ route('payments.create') }}" class="btn-primary">
                    Tambah Pembayaran
                </a>
            </div>

            <div class="card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50">
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Sewa</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Jaminan</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Metode</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-center">Status</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($payments as $payment)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $payment->rental->rental_code ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($payment->jaminan, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($payment->payment_method) }}</td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                            @if ($payment->payment_status === 'pending') bg-yellow-100 text-yellow-700
                                            @elseif ($payment->payment_status === 'paid') bg-green-100 text-green-700
                                            @elseif ($payment->payment_status === 'failed') bg-red-100 text-red-700
                                            @else bg-gray-100 text-gray-700 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $payment->payment_status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right">
                                        <a href="{{ route('payments.show', $payment) }}" class="text-[#40916c] hover:text-[#14532d] font-medium mr-4">Lihat</a>
                                        <a href="{{ route('payments.edit', $payment) }}" class="text-blue-600 hover:text-blue-800 font-medium mr-4">Edit</a>
                                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Yakin ingin menghapus pembayaran ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada pembayaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $payments->links() }}

        </div>
    </div>
</x-app-layout>
