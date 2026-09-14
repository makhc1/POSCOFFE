@extends('layouts.admin')

@section('title', 'Katalog Produk - Bagelan Coffee')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto opacity-0 translate-y-16" style="animation: fadeUp 1s cubic-bezier(0.32, 0.72, 0, 1) forwards;">
    
    <div class="flex flex-col sm:flex-row justify-between sm:items-end gap-6 mb-4">
        <div>
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="w-8 h-[1px] bg-[#2D2420]/30"></span>
                <span class="text-[10px] font-semibold uppercase tracking-[0.3em] text-[#2D2420]/60">Manajemen Inventori</span>
            </div>
            <h1 class="font-editorial text-4xl text-[#2D2420] leading-tight">Katalog Menu.</h1>
        </div>
        <a href="{{ route('admin.products.create') }}" class="group relative rounded-full pl-6 pr-2 py-2 bg-[#2D2420] hover:bg-[#4E342E] text-[#FDFBF7] text-[11px] font-semibold uppercase tracking-widest inline-flex items-center gap-4 transition-all duration-700 shadow-[0_10px_30px_rgba(45,36,32,0.2)] active:scale-[0.98]">
            <span>Kreasi Baru</span>
            <div class="w-8 h-8 rounded-full bg-[#FDFBF7]/10 flex items-center justify-center group-hover:scale-105 awwwards-transition">
                <i class="ph ph-plus text-sm"></i>
            </div>
        </a>
    </div>

    <!-- Editorial Double-Bezel Table Container -->
    <div class="bg-[#FAF7F2] border border-[#2D2420]/10 rounded-[2.5rem] p-1.5 shadow-[0_20px_40px_rgba(45,36,32,0.05)] relative overflow-hidden">
        <div class="bg-[#FDFBF7] shadow-[inset_0_1px_2px_rgba(255,255,255,1)] rounded-[calc(2.5rem-0.375rem)] border border-[#2D2420]/5 p-6 sm:p-10 relative z-10">
            
            <div class="overflow-x-auto hide-scrollbar">
                <table class="w-full text-left text-sm text-[#2D2420]">
                    <thead class="uppercase text-[9px] font-bold text-[#2D2420]/40 tracking-widest border-b border-[#2D2420]/10">
                        <tr>
                            <th class="pb-6">Sajian (Menu)</th>
                            <th class="pb-6">Kategori</th>
                            <th class="pb-6">Nilai Jual</th>
                            <th class="pb-6">Spesifikasi</th>
                            <th class="pb-6">Status Promo</th>
                            <th class="pb-6">Ketersediaan</th>
                            <th class="pb-6 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2D2420]/5">
                        @foreach($products as $p)
                            <tr class="group hover:bg-[#2D2420]/[0.02] awwwards-transition">
                                <td class="py-6 pr-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-[#2D2420]/5 shrink-0 border border-[#2D2420]/5">
                                            <img src="{{ asset($p->image_url) }}" alt="{{ $p->name }}" class="w-full h-full object-cover mix-blend-multiply opacity-90 group-hover:scale-110 awwwards-transition duration-700">
                                        </div>
                                        <div>
                                            <span class="font-editorial font-bold text-base text-[#2D2420] block">{{ $p->name }}</span>
                                            <span class="text-[10px] text-[#2D2420]/50 font-medium line-clamp-1 max-w-xs mt-0.5">{{ $p->description }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6 pr-4 font-bold text-[#8D6E63] text-xs">
                                    {{ $p->category->name }}
                                </td>
                                <td class="py-6 pr-4">
                                    <span class="font-bold text-[#2D2420] block">Rp {{ number_format($p->price, 0, ',', '.') }}</span>
                                    @if($p->original_price)
                                        <span class="text-[10px] text-[#2D2420]/40 line-through block mt-0.5">Rp {{ number_format($p->original_price, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td class="py-6 pr-4">
                                    <span class="text-[11px] font-semibold text-[#2D2420]/70 block">{{ $p->serving_type === 'iced' ? 'Iced Only' : ($p->serving_type === 'hot' ? 'Hot Only' : 'Hot & Iced') }}</span>
                                    <span class="text-[9px] text-[#2D2420]/40 uppercase tracking-widest mt-1 block">Kafein: {{ $p->caffeine_level }} | Pedas: {{ $p->spicy_level }}</span>
                                </td>
                                <td class="py-6 pr-4">
                                    @if($p->badge)
                                        <span class="bg-[#8D6E63]/10 text-[#4E342E] text-[9px] font-bold px-3 py-1.5 rounded-full uppercase tracking-widest border border-[#8D6E63]/20">
                                            {{ $p->badge }}
                                        </span>
                                    @else
                                        <span class="text-[#2D2420]/30 font-bold">-</span>
                                    @endif
                                </td>
                                <td class="py-6 pr-4">
                                    @if($p->is_available)
                                        <span class="text-emerald-600 font-bold text-[10px] uppercase tracking-widest bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-100">Tersedia</span>
                                    @else
                                        <span class="text-[#FF2E63] font-bold text-[10px] uppercase tracking-widest bg-[#FF2E63]/5 px-3 py-1.5 rounded-full border border-[#FF2E63]/10">Habis</span>
                                    @endif
                                </td>
                                <td class="py-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.products.edit', $p) }}" class="w-8 h-8 rounded-full border border-[#2D2420]/10 flex items-center justify-center text-[#2D2420]/50 hover:text-[#2D2420] hover:bg-[#2D2420]/5 awwwards-transition" title="Ubah Spesifikasi">
                                            <i class="ph ph-pen-nib"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $p) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahakarya {{ $p->name }}?')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-full border border-red-500/20 flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 awwwards-transition" title="Tarik dari Peredaran">
                                                <i class="ph ph-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(2rem); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
