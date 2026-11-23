<x-user-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Profil Saya') }}
                </h2>
                <p class="text-sm text-gray-500">{{ __('Kelola informasi akun Anda') }}</p>
            </div>
            <a href="{{ route('customer.profile.edit') }}" class="bg-[#14532d] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#40916c] transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                {{ __('Kelola Profil') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Sidebar -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Profile Header -->
                    <div class="text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100">
                            <span class="material-symbols-outlined text-green-700 text-3xl">person</span>
                        </div>
                        <h3 class="mt-2 text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>

            

                    <!-- Menu -->
                    <div class="space-y-1 border rounded-xl p-2">
                        <a href="{{ route('customer.profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-green-50 text-[#14532d] font-medium">
                            <span class="material-symbols-outlined text-[16px]">account_circle</span>
                            {{ __('Akun Saya') }}
                        </a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                            {{ __('Alamat') }}
                        </a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <span class="material-symbols-outlined text-[16px]">history</span>
                            {{ __('Riwayat') }}
                        </a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <span class="material-symbols-outlined text-[16px]">notifications</span>
                            {{ __('Notifikasi') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full text-left" onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="material-symbols-outlined text-[16px]">exit_to_app</span>
                                {{ __('Keluar') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-9 space-y-6">
                    @if (session('status') === 'profile-updated')
                        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                            {{ __('Profil berhasil diperbarui.') }}
                        </div>
                    @endif

                    <div class="bg-[#14532d] rounded-xl p-6 text-white shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-white/20">
                                <span class="material-symbols-outlined text-[24px]">person</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">{{ __('Profil Saya') }}</h3>
                                <p class="text-green-100 text-sm">{{ __('Kelola informasi akun Anda') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Info Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-gray-100 text-gray-600">
                                    <span class="material-symbols-outlined text-[18px]">badge</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-medium">{{ __('Nama Lengkap') }}</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-gray-100 text-gray-600">
                                    <span class="material-symbols-outlined text-[18px]">email</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-medium">{{ __('Email') }}</p>
                                    <p class="text-sm font-semibold text-[#14532d]">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-gray-100 text-gray-600">
                                    <span class="material-symbols-outlined text-[18px]">phone</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-medium">{{ __('Nomor WhatsApp') }}</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $user->phone ?? __('Belum diatur') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-gray-100 text-gray-600">
                                    <span class="material-symbols-outlined text-[18px]">people</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-medium">{{ __('Jenis Kelamin') }}</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        @php
                                            $genderLabel = match($user->gender) {
                                                'laki-laki' => 'Laki-laki',
                                                'perempuan' => 'Perempuan',
                                                default => __('Belum diatur'),
                                            };
                                        @endphp
                                        {{ $genderLabel }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-gray-100 text-gray-600">
                                    <span class="material-symbols-outlined text-[18px]">cake</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-medium">{{ __('Tanggal Lahir') }}</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d M Y') : __('Belum diatur') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-gray-100 text-gray-600">
                                    <span class="material-symbols-outlined text-[18px]">shield</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-medium">{{ __('Status Akun') }}</p>
                                    <p class="text-sm font-semibold text-green-600">
                                        {{ ucfirst($user->status) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-user-layout>
