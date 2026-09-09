@extends('layouts.admin')

@section('title', 'Tambah Menu Baru - Admin Kopi Gacoan')

@section('content')
<div class="max-w-3xl space-y-6">
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.products') }}" class="p-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-gray-300">
            <i class="ph ph-arrow-left"></i>
        </a>
        <div>
            <h1 class="font-display font-black text-2xl text-white">Tambah Menu Baru</h1>
            <p class="text-xs text-gray-400">Tambahkan kopi jagoan, kudapan dimsum, atau minuman segar baru.</p>
        </div>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" class="bg-[#121216] border border-white/10 rounded-3xl p-8 shadow-xl space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Kategori Menu *</label>
                <select name="category_id" required class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Tipe Penyajian *</label>
                <select name="serving_type" required class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">
                    <option value="both">Dingin / Hangat (Both)</option>
                    <option value="iced">Khusus Dingin (Iced Only)</option>
                    <option value="hot">Khusus Hangat (Hot Only)</option>
                    <option value="food">Makanan / Dimsum (Food)</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Nama Menu *</label>
            <input type="text" name="name" required placeholder="Contoh: Kopi Jagoan Butterscotch" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none" value="{{ old('name') }}">
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Deskripsi & Racikan Menu</label>
            <textarea name="description" rows="3" placeholder="Jelaskan kombinasi rasa espresso, saus, susu, atau tekstur renyahnya..." class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Harga Jual (Rp) *</label>
                <input type="number" name="price" required placeholder="12000" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none" value="{{ old('price') }}">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Harga Coret / Promo Awal (Rp)</label>
                <input type="number" name="original_price" placeholder="16000" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none" value="{{ old('original_price') }}">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Level Kafein (0 = Non-Coffee, 10 = Setan)</label>
                <input type="number" name="caffeine_level" min="0" max="10" value="5" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Level Pedas (0 = Gurih, 8 = Setan)</label>
                <input type="number" name="spicy_level" min="0" max="8" value="0" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Badge Label (Opsional)</label>
                <input type="text" name="badge" placeholder="Contoh: 🔥 BEST SELLER / NEW!" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">URL Foto Produk</label>
                <input type="url" name="image_url" placeholder="https://images.unsplash.com/photo-..." class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">
            </div>
        </div>

        <div class="flex items-center gap-6 pt-2">
            <label class="flex items-center gap-2 text-xs font-bold text-gray-300 cursor-pointer">
                <input type="checkbox" name="is_best_seller" value="1" class="rounded bg-[#09090C] border-white/10 text-[#FF2E63] focus:ring-[#FF2E63]">
                <span>Tandai Sebagai Best Seller</span>
            </label>
            <label class="flex items-center gap-2 text-xs font-bold text-gray-300 cursor-pointer">
                <input type="checkbox" name="is_spicy_or_bold" value="1" class="rounded bg-[#09090C] border-white/10 text-[#FF9900] focus:ring-[#FF9900]">
                <span>Rasa Ekstra Bold / Pedas</span>
            </label>
        </div>

        <div class="pt-4 border-t border-white/10 flex justify-end gap-3">
            <a href="{{ route('admin.products') }}" class="px-6 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-gray-300 text-xs font-bold transition-colors">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-[#FF2E63] to-[#FF9900] text-white text-xs font-black shadow-lg">
                Simpan Menu Baru
            </button>
        </div>
    </form>

</div>
@endsection
