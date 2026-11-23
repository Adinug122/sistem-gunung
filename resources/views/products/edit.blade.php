<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
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
                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="category_id" value="Kategori" />
                        <select id="category_id" name="category_id" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="name" value="Nama Produk" />
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="image" value="Gambar Produk" />
                        <input type="file" name="image" id="image" accept="image/*" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        @if ($product->image)
                            <p class="mt-1 text-xs text-gray-500">Gambar saat ini:</p>
                            <img src="{{ asset('storage/'.$product->image) }}" alt="current" class="mt-2 h-24 object-cover rounded border border-gray-200">
                        @endif
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea name="description" id="description" rows="4" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="price_per_day" value="Harga Sewa per Hari" />
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-400">Rp</span>
                                <input type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day', $product->price_per_day) }}" class="block w-full pl-9 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            </div>
                            @error('price_per_day')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="stock" value="Stok" />
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <x-input-label for="condition" value="Kondisi" />
                        <select name="condition" id="condition" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            <option value="baik" {{ old('condition', $product->condition) === 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="belum_dicuci" {{ old('condition', $product->condition) === 'belum_dicuci' ? 'selected' : '' }}>Belum Dicuci</option>
                            <option value="rusak" {{ old('condition', $product->condition) === 'rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                        @error('condition')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('products.index') }}" class="btn-outline">
                            Kembali
                        </a>
                        <button type="submit" class="btn-primary">
                            Update Produk
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
