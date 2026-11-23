@extends('layouts.landing')

@section('title', 'Keranjang | Rental OutDoor')

@section('content')
    <section class="max-w-6xl mx-auto pt-28 pb-20 px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-800 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div x-data="keranjang()">
            {{-- Toast --}}
            <div x-show="showToast" x-transition x-cloak
                 class="fixed top-4 right-4 z-50 p-4 bg-[#1b1b18] text-white rounded-lg shadow-lg text-sm">
                <span x-text="toastMessage"></span>
            </div>

        
            <template x-if="items.length > 0">
                <div class="grid gap-6 lg:grid-cols-3 lg:items-start">

                    {{-- ============ KOLOM KIRI: DAFTAR ITEM ============ --}}
                    <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

                        {{-- Header --}}
                        <div class="flex items-center justify-between gap-4 pb-6 border-b border-slate-200">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-[#f5f5f0] flex items-center justify-center text-[#40916c]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                        <line x1="3" y1="6" x2="21" y2="6"/>
                                        <path d="M16 10a4 4 0 0 1-8 0"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-[#1b1b18]">Keranjang Sewa</h2>
                                    <p class="text-sm text-[#666]" x-text="`${items.length} item`"></p>
                                </div>
                            </div>

                            <label class="flex items-center gap-2 px-4 py-2 rounded-xl border border-[#40916c]/30 bg-[#f5f5f0] text-sm font-semibold text-[#40916c] cursor-pointer select-none">
                                Pilih Semua
                                <input type="checkbox"
                                       class="cb"
                                       :checked="allSelected"
                                       @change="toggleAll($event.target.checked)">
                            </label>
                        </div>

                        {{-- Bar item terpilih + hapus terpilih --}}
                        <div class="flex items-center justify-between py-4 border-b border-slate-200">
                            <p class="flex items-center gap-2 text-sm font-semibold text-[#40916c]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm-1.2 14.4-4-4 1.4-1.4 2.6 2.6 5-5 1.4 1.4-6.4 6.4z"/></svg>
                                <span x-text="`${selectedItems.length} item • Rp ${fmt(selectedTotal)}`"></span>
                            </p>
                            <button @click.prevent="removeSelected()"
                                    :disabled="selectedItems.length === 0"
                                    class="text-red-500 hover:text-red-700 disabled:opacity-40 disabled:pointer-events-none"
                                    title="Hapus item terpilih">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"/>
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                    <path d="M10 11v6M14 11v6"/>
                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                </svg>
                            </button>
                        </div>

                        {{-- Daftar item --}}
                        <div class="mt-4 space-y-3">
                            <template x-for="item in items" :key="item.id">
                                <div class="flex items-start gap-4 p-4 rounded-xl border transition-colors"
                                     :class="isSelected(item.id) ? 'bg-[#f0f5ec] border-[#40916c]/30' : 'bg-white border-slate-200'">

                                    <input type="checkbox"
                                           class="cb"
                                           :checked="isSelected(item.id)"
                                           @change="toggleItem(item.id)">

     {{--  --}}               {{-- Gambar --}}
                                    <template x-if="item.has_image">
                                        <img :src="item.image_url" :alt="item.name"
                                             class="w-24 h-24 object-cover rounded-xl shrink-0">
                                    </template>
                                    <template x-if="!item.has_image">
                                        <div class="w-24 h-24 rounded-xl bg-slate-100 flex items-center justify-center text-gray-400 shrink-0">--</div>
                                    </template>

                                    {{-- Info + qty --}}
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-[#1b1b18] leading-snug" x-text="item.name"></h3>
                                        <p class="mt-1 text-sm text-[#666]"
                                           x-text="`${item.category?.name ?? 'Outdoor'} • Rp ${fmt(item.price_per_day)}/hari`"></p>

                                        <div class="mt-3 flex items-center gap-4">
                                            <div class="inline-flex items-center rounded-xl border border-slate-300 bg-white overflow-hidden">
                                                <button @click.prevent="updateQty(item.id, item.qty - 1)"
                                                        :disabled="isLoading(item.id)"
                                                        class="w-10 h-10 flex items-center justify-center text-[#1b1b18] hover:bg-slate-100 disabled:opacity-50 disabled:pointer-events-none">−</button>
                                                <span x-text="item.qty" class="w-10 text-center font-medium text-[#1b1b18] border-x border-slate-200"></span>
                                                <button @click.prevent="updateQty(item.id, item.qty + 1)"
                                                        :disabled="isLoading(item.id)"
                                                        class="w-10 h-10 flex items-center justify-center text-[#1b1b18] hover:bg-slate-100 disabled:opacity-50 disabled:pointer-events-none">+</button>
                                            </div>
                                            <button @click.prevent="removeItem(item.id)"
                                                    class="text-sm font-medium text-red-500 hover:text-red-700">Hapus</button>
                                        </div>
                                    </div>

                                    {{-- Subtotal --}}
                                    <div class="text-right shrink-0">
                                        <p class="text-xs text-[#888]">Subtotal</p>
                                        <p class="font-bold text-[#1b1b18]" x-text="`Rp ${fmt(item.price_per_day * item.qty)}`"></p>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="mt-6 text-right">
                            <button @click.prevent="clearCart"
                                    class="text-sm text-[#666] hover:text-red-500"
                                    x-text="isLoading('clear') ? 'Mengosongkan...' : 'Kosongkan Keranjang'"></button>
                        </div>
                    </div>

                    {{-- ============ KOLOM KANAN: RINGKASAN ============ --}}
                    <aside class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden lg:sticky lg:top-28">

                        <div class="p-6 bg-[#f5f5f0]">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-[#40916c]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                        <line x1="3" y1="6" x2="21" y2="6"/>
                                        <path d="M16 10a4 4 0 0 1-8 0"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-[#1b1b18]">Ringkasan Sewa</h3>
                            </div>

                            <div class="mt-4 flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#40916c"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm-1.2 14.4-4-4 1.4-1.4 2.6 2.6 5-5 1.4 1.4-6.4 6.4z"/></svg>
                                    <div>
                                        <p class="font-medium text-[#1b1b18]">Item Terpilih</p>
                                        <p class="text-xs text-[#666]" x-text="`${selectedItems.length} item`"></p>
                                    </div>
                                </div>
                                <span class="text-[11px] font-bold tracking-wide px-2 py-1 rounded-md bg-[#f0f5ec] text-[#40916c]">TERPILIH</span>
                            </div>
                        </div>

                        <div class="p-6">
                            <p class="text-sm text-[#666] mb-3">Item dalam Keranjang:</p>

                            <div class="space-y-2 max-h-56 overflow-y-auto">
                                <template x-for="item in selectedItems" :key="item.id">
                                    <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-[#f5f5f0]/60 px-4 py-3">
                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-medium text-[#1b1b18]" x-text="item.name"></p>
                                            <p class="text-xs text-[#666]" x-text="`${item.qty}× Rp ${fmt(item.price_per_day)}`"></p>
                                        </div>
                                        <p class="font-bold text-sm text-[#1b1b18] shrink-0" x-text="`Rp ${fmt(item.price_per_day * item.qty)}`"></p>
                                    </div>
                                </template>
                                <p x-show="selectedItems.length === 0" class="text-sm text-[#888] py-2">Belum ada item dipilih.</p>
                            </div>

                            <div class="mt-6 rounded-xl border border-slate-200 bg-[#f5f5f0]/60 p-4">
                                <div class="flex items-center justify-between text-[#666]">
                                    <span>Subtotal</span>
                                    <span x-text="`Rp ${fmt(selectedTotal)}`"></span>
                                </div>
                                <div class="mt-3 pt-3 border-t border-slate-300 flex items-center justify-between">
                                    <span class="text-sm font-bold text-[#1b1b18]">Total Pembayaran</span>
                                    <span class="text-2xl font-bold text-[#1b1b18]" x-text="`Rp ${fmt(selectedTotal)}`"></span>
                                </div>
                            </div>

                            <button @click.prevent="checkout()"
                                    :disabled="selectedItems.length === 0"
                                    class="mt-5 w-full flex items-center justify-center gap-2 rounded-xl bg-[#1b1b18] py-3.5 font-bold text-white hover:bg-[#40916c] transition-colors disabled:opacity-40 disabled:pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                <span x-text="`Checkout (${selectedItems.length})`"></span>
                            </button>
                        </div>
                    </aside>
                </div>
            </template>

            {{-- KERANJANG KOSONG --}}
            <template x-if="items.length === 0">
                <div class="bg-white border border-slate-200 rounded-2xl p-16 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 mx-auto mb-4 text-gray-400 opacity-50">
                        <path d="M3 3v2l1.5 2L5 19l-1.5 2L22 19l-1.5-2L18 5l1.5-2V3z"/>
                        <line x1="17" y1="20" x2="7" y2="20"/>
                        <line x1="7" y1="9" x2="7" y2="20"/>
                    </svg>
                    <p class="text-lg font-medium text-[#1b1b18]">Keranjang masih kosong</p>
                    <p class="text-sm text-[#666] mt-2">Belum ada produk yang ditambahkan ke keranjang.</p>
                    <a href="{{ route('produk') }}" class="mt-6 inline-block bg-[#1b1b18] text-white font-medium px-6 py-2.5 rounded-xl hover:bg-[#40916c] transition-colors">
                        Lihat Produk
                    </a>
                </div>
            </template>
        </div>

        <script>
            function keranjang() {
                const csrf = () => document.querySelector('meta[name="csrf-token"]').content;

                const post = (url, body = null) => fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf(),
                    },
                    body: body ? JSON.stringify(body) : null,
                }).then(r => r.json());

                return {
                    items: @json($produk ?? []),
                    total: @json($total ?? 0),
                    count: @json($count ?? 0),
                    selected: [],          // id item yang dicentang
                    loading: [],
                    showToast: false,
                    toastMessage: '',

                    init() {
                        // default: semua item tercentang
                        this.selected = this.items.map(i => i.id);
                        if (window.Alpine && Alpine.store('cart')) {
                            this.count = Alpine.store('cart').count;
                        }
                    },

                    /* ---------- helper ---------- */
                    fmt(n) { return Number(n).toLocaleString('id-ID'); },
                    isLoading(id) { return this.loading.includes(id); },
                    isSelected(id) { return this.selected.includes(id); },

                    get selectedItems() {
                        return this.items.filter(i => this.selected.includes(i.id));
                    },
                    get selectedTotal() {
                        return this.selectedItems.reduce((s, i) => s + i.price_per_day * i.qty, 0);
                    },
                    get allSelected() {
                        return this.items.length > 0 && this.selected.length === this.items.length;
                    },

                    /* ---------- pilih item ---------- */
                    toggleItem(id) {
                        this.selected = this.isSelected(id)
                            ? this.selected.filter(x => x !== id)
                            : [...this.selected, id];
                    },
                    toggleAll(checked) {
                        this.selected = checked ? this.items.map(i => i.id) : [];
                    },

                    /* ---------- aksi keranjang ---------- */
                    async updateQty(productId, qty) {
                        if (qty < 1) { return this.removeItem(productId); }
                        const current = this.items.find(i => i.id === productId)?.qty || 1;
                        this.loading.push(productId);
                        const data = await post(`/keranjang/tambah/${productId}`, { qty: qty - current });
                        this.loading = this.loading.filter(id => id !== productId);
                        if (data.success) {
                            this.syncCount(data.count);
                            this.toast(data.message);
                            await this.refreshFromServer();
                        }
                    },

                    async removeItem(productId, ask = true) {
                        if (ask && !confirm('Hapus produk dari keranjang?')) return;
                        this.loading.push(productId);
                        const data = await post(`/keranjang/hapus/${productId}`);
                        this.loading = this.loading.filter(id => id !== productId);
                        if (data.success) {
                            this.syncCount(data.count);
                            if (ask) this.toast(data.message);
                            if (ask) await this.refreshFromServer();
                        }
                        return data.success;
                    },

                    async removeSelected() {
                        if (this.selectedItems.length === 0) return;
                        if (!confirm(`Hapus ${this.selectedItems.length} item terpilih?`)) return;
                        for (const item of [...this.selectedItems]) {
                            await this.removeItem(item.id, false);
                        }
                        this.toast('Item terpilih dihapus.');
                        await this.refreshFromServer();
                    },

                    async clearCart() {
                        if (!confirm('Kosongkan seluruh keranjang?')) return;
                        this.loading.push('clear');
                        const data = await post('/keranjang/hapus-semua');
                        this.loading = this.loading.filter(id => id !== 'clear');
                        if (data.success) {
                            this.items = [];
                            this.selected = [];
                            this.total = 0;
                            this.syncCount(0);
                            this.toast(data.message);
                        }
                    },

                    async refreshFromServer() {
                        const res = await fetch('/keranjang', {
                            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                        });
                        const data = await res.json();
                        this.items = data.produk;
                        this.total = data.total;
                        this.count = data.count;
                        // buang id yang sudah tidak ada dari daftar terpilih
                        const ids = this.items.map(i => i.id);
                        this.selected = this.selected.filter(id => ids.includes(id));
                    },

                    checkout() {
                        if (this.selectedItems.length === 0) return;
                        // TODO: ganti dengan route checkout milikmu
                        const ids = this.selected.join(',');
                        window.location.href = `/checkout?items=${ids}`;
                    },

                    syncCount(n) {
                        this.count = n;
                        if (window.Alpine && Alpine.store('cart')) Alpine.store('cart').count = n;
                    },

                    toast(msg) {
                        this.toastMessage = msg;
                        this.showToast = true;
                        setTimeout(() => { this.showToast = false; }, 3000);
                    },
                }
            }
        </script>
    </section>
@endsection