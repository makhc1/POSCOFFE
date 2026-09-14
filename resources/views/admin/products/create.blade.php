@extends('layouts.admin')

@section('title', 'Kreasi Menu Baru - Bagelan Coffee')

@section('content')
<div class="max-w-4xl space-y-8 opacity-0 translate-y-16" style="animation: fadeUp 1s cubic-bezier(0.32, 0.72, 0, 1) forwards;">
    
    <div class="flex items-center gap-4 mb-4">
        <a href="{{ route('admin.products') }}" class="w-10 h-10 rounded-full bg-[#FAF7F2] border border-[#2D2420]/10 flex items-center justify-center text-[#2D2420]/60 hover:text-[#2D2420] hover:bg-[#2D2420]/5 awwwards-transition group shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
            <i class="ph ph-arrow-left text-lg group-hover:-translate-x-0.5 transition-transform"></i>
        </a>
        <div>
            <div class="inline-flex items-center gap-3 mb-1">
                <span class="text-[9px] font-semibold uppercase tracking-[0.3em] text-[#2D2420]/50">Laboratorium Rasa</span>
            </div>
            <h1 class="font-editorial text-3xl text-[#2D2420] leading-tight">Formulasi Menu Baru.</h1>
        </div>
    </div>

    <!-- Editorial Double-Bezel Form Container -->
    <div class="bg-[#FAF7F2] border border-[#2D2420]/10 rounded-[2.5rem] p-1.5 shadow-[0_20px_40px_rgba(45,36,32,0.05)] relative overflow-hidden">
        <form action="{{ route('admin.products.store') }}" method="POST" class="bg-[#FDFBF7] shadow-[inset_0_1px_2px_rgba(255,255,255,1)] rounded-[calc(2.5rem-0.375rem)] border border-[#2D2420]/5 p-8 sm:p-12 relative z-10 space-y-8">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="relative group">
                    <label class="block text-[10px] font-bold text-[#2D2420]/60 mb-2 uppercase tracking-widest">Kategori Sajian *</label>
                    <div class="relative">
                        <select name="category_id" required class="w-full appearance-none bg-[#FAF7F2] border border-[#2D2420]/10 focus:border-[#2D2420]/40 rounded-xl px-5 py-4 text-xs font-semibold text-[#2D2420] focus:outline-none awwwards-transition shadow-[inset_0_2px_4px_rgba(45,36,32,0.02)]">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-[#2D2420]/40"></i>
                    </div>
                </div>
                <div class="relative group">
                    <label class="block text-[10px] font-bold text-[#2D2420]/60 mb-2 uppercase tracking-widest">Metode Penyajian *</label>
                    <div class="relative">
                        <select name="serving_type" required class="w-full appearance-none bg-[#FAF7F2] border border-[#2D2420]/10 focus:border-[#2D2420]/40 rounded-xl px-5 py-4 text-xs font-semibold text-[#2D2420] focus:outline-none awwwards-transition shadow-[inset_0_2px_4px_rgba(45,36,32,0.02)]">
                            <option value="both">Dingin / Hangat (Both)</option>
                            <option value="iced">Khusus Dingin (Iced Only)</option>
                            <option value="hot">Khusus Hangat (Hot Only)</option>
                            <option value="food">Makanan Pendamping (Food)</option>
                        </select>
                        <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-[#2D2420]/40"></i>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-[#2D2420]/60 mb-2 uppercase tracking-widest">Nama Mahakarya *</label>
                <input type="text" name="name" required placeholder="Contoh: Signature Butterscotch Latte" class="w-full bg-[#FAF7F2] border border-[#2D2420]/10 focus:border-[#2D2420]/40 rounded-xl px-5 py-4 text-sm font-editorial font-bold text-[#2D2420] placeholder:text-[#2D2420]/30 placeholder:font-sans placeholder:font-normal focus:outline-none awwwards-transition shadow-[inset_0_2px_4px_rgba(45,36,32,0.02)]" value="{{ old('name') }}">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-[#2D2420]/60 mb-2 uppercase tracking-widest">Narasi Rasa & Tekstur</label>
                <textarea name="description" rows="3" placeholder="Deskripsikan profil rasa, asal biji kopi, atau keunikan teksturnya..." class="w-full bg-[#FAF7F2] border border-[#2D2420]/10 focus:border-[#2D2420]/40 rounded-xl px-5 py-4 text-xs font-semibold text-[#2D2420] placeholder:text-[#2D2420]/30 placeholder:font-normal focus:outline-none awwwards-transition shadow-[inset_0_2px_4px_rgba(45,36,32,0.02)]">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-[#2D2420]/60 mb-2 uppercase tracking-widest">Nilai Jual (Rp) *</label>
                    <input type="number" name="price" required placeholder="25000" class="w-full bg-[#FAF7F2] border border-[#2D2420]/10 focus:border-[#2D2420]/40 rounded-xl px-5 py-4 text-sm font-bold text-[#2D2420] focus:outline-none awwwards-transition shadow-[inset_0_2px_4px_rgba(45,36,32,0.02)]" value="{{ old('price') }}">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-[#2D2420]/60 mb-2 uppercase tracking-widest">Harga Coret (Rp) Opsional</label>
                    <input type="number" name="original_price" placeholder="30000" class="w-full bg-[#FAF7F2] border border-[#2D2420]/10 focus:border-[#2D2420]/40 rounded-xl px-5 py-4 text-sm font-bold text-[#2D2420]/60 focus:outline-none awwwards-transition shadow-[inset_0_2px_4px_rgba(45,36,32,0.02)]" value="{{ old('original_price') }}">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-6 bg-[#FAF7F2] rounded-2xl border border-[#2D2420]/5">
                <div>
                    <label class="block text-[10px] font-bold text-[#2D2420]/60 mb-2 uppercase tracking-widest">Intensitas Kafein (0-10)</label>
                    <input type="number" name="caffeine_level" min="0" max="10" value="5" class="w-full bg-[#FDFBF7] border border-[#2D2420]/10 focus:border-[#2D2420]/40 rounded-xl px-5 py-3 text-xs font-bold text-[#2D2420] focus:outline-none awwwards-transition">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-[#2D2420]/60 mb-2 uppercase tracking-widest">Intensitas Pedas (0-8)</label>
                    <input type="number" name="spicy_level" min="0" max="8" value="0" class="w-full bg-[#FDFBF7] border border-[#2D2420]/10 focus:border-[#2D2420]/40 rounded-xl px-5 py-3 text-xs font-bold text-[#2D2420] focus:outline-none awwwards-transition">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-[#2D2420]/60 mb-2 uppercase tracking-widest">Label Kurasi (Badge)</label>
                    <input type="text" name="badge" placeholder="Contoh: BEST SELLER / SEASONAL" class="w-full bg-[#FAF7F2] border border-[#2D2420]/10 focus:border-[#2D2420]/40 rounded-xl px-5 py-4 text-xs font-semibold text-[#2D2420] placeholder:text-[#2D2420]/30 placeholder:font-normal focus:outline-none awwwards-transition shadow-[inset_0_2px_4px_rgba(45,36,32,0.02)]" value="{{ old('badge') }}">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-[#2D2420]/60 mb-2 uppercase tracking-widest">Referensi Visual (URL)</label>
                    <input type="url" name="image_url" placeholder="https://images.unsplash.com/..." class="w-full bg-[#FAF7F2] border border-[#2D2420]/10 focus:border-[#2D2420]/40 rounded-xl px-5 py-4 text-xs font-semibold text-[#2D2420] placeholder:text-[#2D2420]/30 placeholder:font-normal focus:outline-none awwwards-transition shadow-[inset_0_2px_4px_rgba(45,36,32,0.02)]" value="{{ old('image_url') }}">
                </div>
            </div>

            <div class="flex items-center gap-8 pt-2">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="is_best_seller" value="1" class="w-5 h-5 rounded bg-[#FAF7F2] border border-[#2D2420]/20 text-[#2D2420] focus:ring-[#2D2420] focus:ring-offset-0 awwwards-transition cursor-pointer checked:bg-[#2D2420] checked:border-[#2D2420]">
                    <span class="text-[11px] font-bold text-[#2D2420]/70 group-hover:text-[#2D2420] uppercase tracking-widest transition-colors">Sorot Sebagai Favorit</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="is_spicy_or_bold" value="1" class="w-5 h-5 rounded bg-[#FAF7F2] border border-[#2D2420]/20 text-[#4E342E] focus:ring-[#4E342E] focus:ring-offset-0 awwwards-transition cursor-pointer checked:bg-[#4E342E] checked:border-[#4E342E]">
                    <span class="text-[11px] font-bold text-[#2D2420]/70 group-hover:text-[#2D2420] uppercase tracking-widest transition-colors">Rasa Ekstra Bold</span>
                </label>
            </div>

            <div class="pt-8 border-t border-[#2D2420]/10 flex justify-end gap-4">
                <a href="{{ route('admin.products') }}" class="px-8 py-3.5 rounded-2xl bg-transparent hover:bg-[#FAF7F2] text-[#2D2420]/60 hover:text-[#2D2420] text-[11px] font-bold uppercase tracking-widest transition-colors">
                    Batalkan
                </a>
                <button type="submit" class="px-10 py-3.5 rounded-2xl bg-[#2D2420] hover:bg-[#4E342E] text-[#FDFBF7] text-[11px] font-bold uppercase tracking-widest shadow-[0_10px_20px_rgba(45,36,32,0.15)] active:scale-[0.98] awwwards-transition">
                    Rilis Menu Baru
                </button>
            </div>
        </form>
    </div>

</div>

<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(2rem); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
