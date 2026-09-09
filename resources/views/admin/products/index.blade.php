@extends('layouts.admin')

@section('title', 'Kelola Menu Produk - Admin Kopi Gacoan')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <h1 class="font-display font-black text-2xl text-white">Daftar Menu Kopi & Makanan</h1>
            <p class="text-xs text-gray-400 mt-1">Kelola harga, level pedas/kafein, badge promo, dan ketersediaan menu.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-[#FF2E63] hover:bg-[#e01e53] text-white text-xs font-black px-5 py-3 rounded-xl shadow-lg shadow-[#FF2E63]/30 transition-all">
            <i class="ph ph-plus"></i>
            <span>Tambah Menu Baru</span>
        </a>
    </div>

    <div class="bg-[#121216] border border-white/10 rounded-3xl p-6 shadow-xl space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-gray-300">
                <thead class="bg-white/5 uppercase text-[10px] font-bold text-gray-400 tracking-wider">
                    <tr>
                        <th class="p-3.5 rounded-l-xl">Menu</th>
                        <th class="p-3.5">Kategori</th>
                        <th class="p-3.5">Harga Jual</th>
                        <th class="p-3.5">Level Kafein / Pedas</th>
                        <th class="p-3.5">Badge Promo</th>
                        <th class="p-3.5">Status</th>
                        <th class="p-3.5 rounded-r-xl text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($products as $p)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="p-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-12 h-12 rounded-xl object-cover shrink-0">
                                    <div>
                                        <span class="font-bold text-white block">{{ $p->name }}</span>
                                        <span class="text-[10px] text-gray-500 line-clamp-1 max-w-xs">{{ $p->description }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3.5 font-bold text-[#FF9900]">
                                {{ $p->category->name }}
                            </td>
                            <td class="p-3.5 font-extrabold text-[#FF2E63]">
                                {{ $p->formatted_price }}
                                @if($p->original_price)
                                    <span class="text-[10px] text-gray-500 line-through block">{{ $p->formatted_original_price }}</span>
                                @endif
                            </td>
                            <td class="p-3.5">
                                <span class="text-xs text-gray-300 block">{{ $p->level_name }}</span>
                                <span class="text-[10px] text-gray-500">Kafein: {{ $p->caffeine_level }}/10 | Pedas: {{ $p->spicy_level }}/8</span>
                            </td>
                            <td class="p-3.5">
                                @if($p->badge)
                                    <span class="bg-[#FF2E63]/20 text-[#FF2E63] text-[10px] font-bold px-2.5 py-1 rounded-full border border-[#FF2E63]/30">
                                        {{ $p->badge }}
                                    </span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="p-3.5">
                                @if($p->is_available)
                                    <span class="text-emerald-400 font-bold text-[11px]"><i class="ph ph-circle-check mr-1"></i> Tersedia</span>
                                @else
                                    <span class="text-red-400 font-bold text-[11px]"><i class="ph ph-circle-xmark mr-1"></i> Habis</span>
                                @endif
                            </td>
                            <td class="p-3.5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $p) }}" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white" title="Edit">
                                        <i class="ph ph-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus menu {{ $p->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-white/5 hover:bg-red-600 text-gray-400 hover:text-white" title="Hapus">
                                            <i class="ph ph-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pt-4">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection
