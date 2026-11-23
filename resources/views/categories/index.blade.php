<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kategori') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ createOpen: @js($errors->any() && old('_form') !== 'edit'), editOpenId: @js(old('_form') === 'edit' ? (int) old('category_id') : null) }">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-6">
                <p class="text-sm text-gray-500">Kelola kategori produk sewa.</p>
                <button type="button" @click="createOpen = true" class="btn-primary">
                    Tambah Kategori
                </button>
            </div>

            <div class="card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50">
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Deskripsi</th>
                                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($categories as $category)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $category->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $category->description }}</td>
                                    <td class="px-6 py-4 text-sm text-right whitespace-nowrap">
                                        <button type="button" @click="editOpenId = {{ $category->id }}" class="text-blue-600 hover:text-blue-800 font-medium mr-4">
                                            Edit
                                        </button>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada kategori.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $categories->links() }}

            <div x-cloak x-show="createOpen" x-transition style="display: none;" @click.self="createOpen = false" @keydown.escape.window="createOpen = false" class="fixed inset-0 z-50 bg-black/80 flex justify-center items-center p-4">
                <div class="card w-full max-w-xl max-h-[90vh] overflow-y-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">Tambah Kategori</h3>
                        <button type="button" @click="createOpen = false" class="text-gray-500 hover:text-gray-900" aria-label="Tutup">
                            &times;
                        </button>
                    </div>

                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="_form" value="create">

                        <div>
                            <x-input-label for="create-name" value="Nama Kategori" />
                            <input id="create-name" type="text" name="name" value="{{ old('_form') === 'create' ? old('name') : '' }}" maxlength="30" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" placeholder="Contoh: Tenda">
                            @error('name')
                                @if (old('_form') !== 'edit')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @endif
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="create-description" value="Deskripsi" />
                            <textarea id="create-description" name="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" placeholder="Jelaskan kategori produk">{{ old('_form') === 'create' ? old('description') : '' }}</textarea>
                            @error('description')
                                @if (old('_form') !== 'edit')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @endif
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="button" @click="createOpen = false" class="btn-outline">Batal</button>
                            <button type="submit" class="btn-primary">Simpan Kategori</button>
                        </div>
                    </form>
                </div>
            </div>

            @foreach ($categories as $category)
                <div x-cloak x-show="editOpenId === {{ $category->id }}" x-transition style="display: none;" @click.self="editOpenId = null" @keydown.escape.window="editOpenId = null" class="fixed inset-0 z-50 bg-black/80 flex justify-center items-center p-4">
                    <div class="card w-full max-w-xl max-h-[90vh] overflow-y-auto">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-semibold text-gray-900">Edit Kategori</h3>
                            <button type="button" @click="editOpenId = null" class="text-gray-500 hover:text-gray-900" aria-label="Tutup">
                                &times;
                            </button>
                        </div>

                        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_form" value="edit">
                            <input type="hidden" name="category_id" value="{{ $category->id }}">

                            <div>
                                <x-input-label for="name-{{ $category->id }}" value="Nama Kategori" />
                                <input id="name-{{ $category->id }}" type="text" name="name" value="{{ old('_form') === 'edit' && (int) old('category_id') === $category->id ? old('name') : $category->name }}" maxlength="30" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
                                @if (old('_form') === 'edit' && (int) old('category_id') === $category->id)
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                @endif
                            </div>

                            <div>
                                <x-input-label for="description-{{ $category->id }}" value="Deskripsi" />
                                <textarea id="description-{{ $category->id }}" name="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">{{ old('_form') === 'edit' && (int) old('category_id') === $category->id ? old('description') : $category->description }}</textarea>
                                @if (old('_form') === 'edit' && (int) old('category_id') === $category->id)
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                @endif
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="button" @click="editOpenId = null" class="btn-outline">Batal</button>
                                <button type="submit" class="btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
