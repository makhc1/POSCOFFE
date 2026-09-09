@extends('layouts.admin')

@section('title', 'Edit Menu ' . $product->name . ' - Admin Kopi Gacoan')

@section('content')
<div class="max-w-3xl space-y-6">
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.products') }}" class="p-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-gray-300">
            <i class="ph ph-arrow-left"></i>
        </a>
        <div>
            <h1 class="font-display font-black text-2xl text-white">Edit Menu: {{ $product->name }}</h1>
            <p class="text-xs text-gray-400">Ubah harga, status ketersediaan, atau deskripsi menu.</p>
        </div>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" class="bg-[#121216] border border-white/10 rounded-3xl p-8 shadow-xl space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Kategori Menu *</label>
                <select name="category_id" required class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id === $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Tipe Penyajian *</label>
                <select name="serving_type" required class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">
                    <option value="both" {{ $product->serving_type === 'both' ? 'selected' : '' }}>Dingin / Hangat (Both)</option>
                    <option value="iced" {{ $product->serving_type === 'iced' ? 'selected' : '' }}>Khusus Dingin (Iced Only)</option>
                    <option value="hot" {{ $product->serving_type === 'hot' ? 'selected' : '' }}>Khusus Hangat (Hot Only)</option>
                    <option value="food" {{ $product->serving_type === 'food' ? 'selected' : '' }}>Makanan / Dimsum (Food)</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Nama Menu *</label>
            <input type="text" name="name" required class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none" value="{{ old('name', $product->name) }}">
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Deskripsi & Racikan Menu</label>
            <textarea name="description" rows="3" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Harga Jual (Rp) *</label>
                <input type="number" name="price" required class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none" value="{{ old('price', (int)$product->price) }}">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Harga Coret / Promo Awal (Rp)</label>
                <input type="number" name="original_price" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none" value="{{ old('original_price', (int)$product->original_price) }}">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Level Kafein (0 - 10)</label>
                <input type="number" name="caffeine_level" min="0" max="10" value="{{ old('caffeine_level', $product->caffeine_level) }}" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Level Pedas (0 - 8)</label>
                <input type="number" name="spicy_level" min="0" max="8" value="{{ old('spicy_level', $product->spicy_level) }}" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">Badge Label</label>
                <input type="text" name="badge" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none" value="{{ old('badge', $product->badge) }}">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-300 mb-1.5 uppercase">URL Foto Produk</label>
                <input type="url" name="image_url" class="w-full bg-[#09090C] border border-white/10 focus:border-[#FF2E63] rounded-xl px-4 py-3 text-xs text-white focus:outline-none" value="{{ old('image_url', $product->image_url) }}">
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-6 pt-2">
            <label class="flex items-center gap-2 text-xs font-bold text-gray-300 cursor-pointer">
                <input type="checkbox" name="is_available" value="1" {{ $product->is_available ? 'checked' : '' }} class="rounded bg-[#09090C] border-white/10 text-emerald-500 focus:ring-emerald-500">
                <span class="text-emerald-400 font-bold">Stok Tersedia (Ready)</span>
            </label>
            <label class="flex items-center gap-2 text-xs font-bold text-gray-300 cursor-pointer">
                <input type="checkbox" name="is_best_seller" value="1" {{ $product->is_best_seller ? 'checked' : '' }} class="rounded bg-[#09090C] border-white/10 text-[#FF2E63] focus:ring-[#FF2E63]">
                <span>Best Seller</span>
            </label>
            <label class="flex items-center gap-2 text-xs font-bold text-gray-300 cursor-pointer">
                <input type="checkbox" name="is_spicy_or_bold" value="1" {{ $product->is_spicy_or_bold ? 'checked' : '' }} class="rounded bg-[#09090C] border-white/10 text-[#FF9900] focus:ring-[#FF9900]">
                <span>Rasa Ekstra Bold / Pedas</span>
            </label>
        </div>

        <div class="pt-4 border-t border-white/10 flex justify-end gap-3">
            <a href="{{ route('admin.products') }}" class="px-6 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-gray-300 text-xs font-bold transition-colors">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-[#FF2E63] to-[#FF9900] text-white text-xs font-black shadow-lg">
                Update Menu
            </button>
        </div>
    </form>

</div>
@endsection
