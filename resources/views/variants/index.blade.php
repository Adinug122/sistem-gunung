<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Varian Produk: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ open: @js($errors->any()) }">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm text-gray-500">Kelola varian (ukuran, warna, dll.) untuk produk ini.</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('products.index') }}" class="btn-outline">
                        Kembali ke Daftar Produk
                    </a>
                    <button type="button" @click="open = true" class="bg-black rounded-lg px-4 py-2 text-white">
                        Tambah Varian
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($variants as $variant)
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden flex flex-col">
                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="text-lg font-bold text-gray-900 leading-tight line-clamp-2">{{ $variant->variant_name }}</h3>
                                <span class="text-sm font-semibold text-[#40916c]">
                                    Rp {{ number_format($variant->price_per_day ?? 0, 0, ',', '.') }}/hari
                                </span>
                            </div>

                            @if ($variant->sku)
                                <p class="text-sm text-gray-500 mb-4"><strong>SKU:</strong> {{ $variant->sku }}</p>
                            @endif

                            <div class="flex items-center justify-between text-xs mb-auto">
                                <span class="flex items-center gap-1 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Stok {{ $variant->stock }}
                                </span>
                            </div>

                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('variants.edit', [$product, $variant]) }}" class="flex-1 bg-[#40916c] hover:bg-[#14532d] text-white text-xs font-medium py-2 px-3 rounded-lg text-center transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('variants.destroy', [$product, $variant]) }}" method="POST" class="w-10 h-10 inline" onsubmit="return confirm('Yakin ingin menghapus varian ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full h-full bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-800 flex items-center justify-center rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white border border-gray-200 rounded-2xl p-16 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v4m-3-4h6m-6-4h6m-6-4V9m6 2b.932 0 1.864-.093 2.757-.282m-2.757.282L13.93 17m-6-3h.008M13 13h6m-6-3h.009M13 13h.01v.01l-.01.01z"></path></svg>
                        <p class="text-sm font-medium">Belum ada varian untuk produk ini.</p>
                    </div>
                @endforelse
            </div>

            {{ $variants->links() }}

            <div x-show="open" @click.self="open = false" class="fixed inset-0 z-50 bg-black/80 flex justify-center items-center p-4">
                <div class="card w-full max-w-md max-h-[90vh] overflow-y-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Tambah Varian</h2>
                        <button type="button" @click="open = false" class="text-gray-500 hover:text-gray-900" aria-label="Tutup">&times;</button>
                    </div>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg" role="alert">
                    <h3 class="font-bold text-sm mb-2">Mohon perbaiki kesalahan berikut:</h3>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form action="{{ route('variants.store', $product) }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="variant_name" value="Nama Varian" />
                        <input type="text" name="variant_name" id="variant_name" value="{{ old('variant_name') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Mis: Ukuran S, Warna Biru">
                        @error('variant_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="sku" value="SKU" />
                        <input type="text" name="sku" id="sku" value="{{ old('sku') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Kode stok (opsional)">
                        <p class="mt-1 text-xs text-gray-500">Biarkan kosong agar sistem generate otomatis (format TTP-XXXXXXXX).</p>
                        @error('sku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="stock" value="Stok" />
                            <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="0">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="price_per_day" value="Harga Sewa per Hari" />
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-400">Rp</span>
                                <input type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day') }}" class="block w-full pl-9 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="0">
                            </div>
                            @error('price_per_day')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="button" @click="open = false" class="btn-outline">Batal</button>
                        <button type="submit" class="btn-primary">Simpan Varian</button>
                    </div>
                </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
