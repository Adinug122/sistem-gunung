<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="card">
                <div class="flex flex-col md:flex-row gap-6 items-start">
                    <div class="w-full md:w-1/3">
                        <div class="w-48 h-48 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8">
                                <path d="m3 21 9-6 9 6"/>
                                <path d="M12 15V9"/>
                                <path d="M3 21h18"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 mb-4">{{ $product->category->name ?? '-' }}</p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Harga per Hari</p>
                                <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($product->price_per_day, 0, ',', '.') }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Stok</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $product->stock }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Kondisi</p>
                                <p class="text-lg font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $product->condition) }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Dibuat pada</p>
                                <p class="text-lg font-semibold text-gray-900">{{ optional($product->created_at)->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <p class="text-gray-700 mb-6">{{ $product->description }}</p>

                        <div class="flex gap-3">
                            <a href="{{ route('products.edit', $product) }}" class="btn-primary flex-1 text-center">
                                Edit
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('products.index') }}" class="text-[#40916c] hover:text-[#14532d] font-medium">
                    ← Kembali ke Daftar Produk
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
