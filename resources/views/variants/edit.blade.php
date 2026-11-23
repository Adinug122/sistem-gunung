<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Varian: {{ $variant->variant_name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

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

            <div class="card">
                <form action="{{ route('variants.update', [$product, $variant]) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="variant_name" value="Nama Varian" />
                        <input type="text" name="variant_name" id="variant_name" value="{{ old('variant_name', $variant->variant_name) }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Mis: Ukuran S, Warna Biru">
                        @error('variant_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="sku" value="SKU" />
                        <input type="text" name="sku" id="sku" value="{{ old('sku', $variant->sku) }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Kode stok (opsional)">
                        <p class="mt-1 text-xs text-gray-500">Biarkan kosong agar sistem generate otomatis (format TTP-XXXXXXXX).</p>
                        @error('sku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="stock" value="Stok" />
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $variant->stock) }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="0">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="price_per_day" value="Harga Sewa per Hari" />
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-400">Rp</span>
                                <input type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day', $variant->price_per_day) }}" class="block w-full pl-9 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="0">
                            </div>
                            @error('price_per_day')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('variants.index', $product) }}" class="btn-outline">
                            Kembali
                        </a>
                        <button type="submit" class="btn-primary">
                            Update Varian
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
