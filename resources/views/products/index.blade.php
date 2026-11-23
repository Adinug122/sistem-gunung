<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
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
                    <p class="text-sm text-gray-500">Kelola daftar produk sewa alat gunung.</p>
                </div>
                <button type="button" @click="open = true" class="bg-black rounded-lg px-4 py-2 text-white">
                    Tambah Produk
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($produk as $product)
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden flex flex-col group">
                        <div class="relative aspect-[4/5] overflow-hidden bg-gray-100">
                            @if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-2 right-2 bg-black/60 backdrop-blur-sm text-white px-2 py-1 rounded text-xs font-medium">
                                {{ $product->category->name ?? '-' }}
                            </div>
                        </div>

                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="text-lg font-bold text-gray-900 leading-tight group-hover:text-[#40916c] transition-colors line-clamp-2">{{ $product->name }}</h3>
                                <span class="text-sm font-semibold text-[#40916c]">Rp {{ number_format($product->price_per_day, 0, ',', '.') }}/hari</span>
                            </div>

                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $product->description }}</p>

                            <div class="flex items-center justify-between text-xs mb-auto">
                                <span class="flex items-center gap-1 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    Stok {{ $product->stock }}
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full
                                    @if ($product->condition === 'baik') bg-green-100 text-green-700
                                    @elseif ($product->condition === 'belum_dicuci') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif
                                    font-semibold capitalize">
                                    {{ str_replace('_', ' ', $product->condition) }}
                                </span>
                            </div>

                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('variants.index', $product) }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-900 text-xs font-medium py-2 px-3 rounded-lg text-center transition-colors">
                                    Varian
                                </a>
                                <a href="{{ route('products.show', $product) }}" class="flex-1 bg-[#40916c] hover:bg-[#14532d] text-white text-xs font-medium py-2 px-3 rounded-lg text-center transition-colors">
                                    Lihat
                                </a>
                                <a href="{{ route('products.edit', $product) }}" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-900 flex items-center justify-center rounded-lg transition-colors" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="w-10 h-10 inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full h-full bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-800 flex items-center justify-center rounded-lg transition-colors" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                            <line x1="10" y1="11" x2="10" y2="17"/>
                                            <line x1="14" y1="11" x2="14" y2="17"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white border border-gray-200 rounded-2xl p-16 text-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 mx-auto mb-3 opacity-50">
                            <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/>
                            <line x1="16" y1="8" x2="2" y2="22"/>
                            <line x1="17" y1="15" x2="9" y2="15"/>
                        </svg>
                        <p class="text-sm font-medium">Belum ada produk.</p>
                    </div>
                @endforelse
            </div>

            {{ $produk->links() }}

            <div x-show="open" @click.self="open = false" class="fixed inset-0 z-50 bg-black/80 flex justify-center items-center p-4">
                <div class="card w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Tambah Produk</h2>
                        <button type="button" @click="open = false" class="text-gray-500 hover:text-gray-900" aria-label="Tutup">
                            &times;
                        </button>
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
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="category_id" value="Kategori" />
                        <select id="category_id" name="category_id" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="name" value="Nama Produk" />
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Mis: Tenda Camping 2 Orang">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{
                        preview: null,
                        isDragover: false,
                        uploadError: '',
                        handleDrop(event) {
                            this.isDragover = false;
                            const file = event.dataTransfer?.files?.[0];
                            if (file) this.handleFile(file);
                        },
                        handleFileSelect(event) {
                            const file = event.target.files?.[0];
                            if (file) this.handleFile(file);
                        },
                        handleFile(file) {
                            const allowed = ['image/jpeg','image/png','image/jpg','image/webp'];
                            if (!allowed.includes(file.type)) {
                                this.uploadError = 'Format gambar yang diizinkan: JPG, JPEG, PNG, WEBP.';
                                this.clearPreview();
                                this.$refs.image.value = '';
                                return;
                            }
                            if (file.size > 20 * 1024 * 1024) {
                                this.uploadError = 'Ukuran gambar maksimal 20 MB.';
                                this.clearPreview();
                                this.$refs.image.value = '';
                                return;
                            }
                            this.uploadError = '';
                            this.clearPreview();
                            this.preview = URL.createObjectURL(file);

                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            this.$refs.image.files = dataTransfer.files;
                        },
                        clearPreview() {
                            if (this.preview) URL.revokeObjectURL(this.preview);
                            this.preview = null;
                        },
                        removeImage() {
                            this.$refs.image.value = '';
                            this.uploadError = '';
                            this.clearPreview();
                        },
                    }">
                        <x-input-label for="image" value="Gambar Produk" />
                        <div
                            @dragover.prevent="isDragover = true"
                            @dragleave.self.prevent="isDragover = false"
                            @drop.prevent="handleDrop($event)"
                            class="relative border-2 border-dashed rounded-xl p-8 text-center transition-colors duration-200"
                            x-bind:class="{
                                'border-[#40916c] bg-[#40916c]/5': isDragover,
                                'border-gray-300 bg-white hover:border-[#40916c]': !isDragover,
                                'bg-gray-50': preview,
                            }"
                            @click.self="$refs.image.click()"
                            @keydown.enter.prevent="$refs.image.click()"
                            @keydown.space.prevent="$refs.image.click()"
                            role="button"
                            tabindex="0"
                            aria-label="Pilih atau jatuhkan gambar produk"
                            style="min-height: 240px;"
                        >
                            <input
                                id="image"
                                x-ref="image"
                                name="image"
                                type="file"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                class="hidden"
                                @change="handleFileSelect($event)"
                            >

                            <template x-if="preview">
                                <div class="absolute inset-2 flex items-center justify-center">
                                    <img :src="preview" alt="Preview gambar produk" class="max-h-48 max-w-full rounded-lg object-contain">
                                    <div class="absolute right-2 top-2 flex gap-2">
                                        <button type="button" @click.stop="$refs.image.click()" class="rounded-lg bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow hover:bg-gray-100">
                                            Ganti
                                        </button>
                                        <button type="button" @click.stop="removeImage()" class="rounded-lg bg-red-600 px-3 py-1.5 text-xs font-medium text-white shadow hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <div x-show="!preview" class="flex flex-col items-center justify-center h-full">
                                <button type="button" @click.stop="$refs.image.click()" class="inline-flex items-center gap-2 bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#40916c]">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    Upload
                                </button>
                                <p class="mt-3 text-sm text-gray-600 pointer-events-none">Choose an image or drag &amp; drop it here.</p>
                                <p class="mt-1 text-xs text-gray-500 pointer-events-none">JPG, JPEG, PNG and WEBP. Max 20 MB.</p>
                            </div>

                        </div>
                        <p x-show="uploadError" x-text="uploadError" role="alert" class="mt-2 text-sm text-red-600"></p>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea name="description" id="description" rows="4" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
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

                        <div>
                            <x-input-label for="stock" value="Stok" />
                            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="0">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <x-input-label for="condition" value="Kondisi" />
                        <select name="condition" id="condition" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            <option value="baik" {{ old('condition', 'baik') === 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="belum_dicuci" {{ old('condition') === 'belum_dicuci' ? 'selected' : '' }}>Belum Dicuci</option>
                            <option value="rusak" {{ old('condition') === 'rusak' ? 'selected' : '' }}>Rusak</option>
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
                            Simpan Produk
                        </button>
                    </div>
                </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
