@extends('layouts.app')

@section('title', $product->name . ' - Kopi Gacoan')
@section('meta_description', $product->description)

@section('content')
<div class="py-12 bg-[#0D0D11]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
            <i class="ph ph-chevron-right text-[10px]"></i>
            <a href="{{ route('menu.index') }}" class="hover:text-white">Menu</a>
            <i class="ph ph-chevron-right text-[10px]"></i>
            <a href="{{ route('menu.index', ['category' => $product->category->slug]) }}" class="hover:text-[#FF2E63]">{{ $product->category->name }}</a>
            <i class="ph ph-chevron-right text-[10px]"></i>
            <span class="text-white font-bold">{{ $product->name }}</span>
        </nav>

        <!-- Product Main Showcase -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 bg-[#16161C] border border-white/10 rounded-3xl p-6 sm:p-10 shadow-2xl mb-16">
            
            <!-- Left: Product Image -->
            <div class="lg:col-span-6 relative">
                <div class="relative h-80 sm:h-96 md:h-[420px] rounded-2xl overflow-hidden bg-black/40 border border-white/10">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @if($product->badge)
                        <span class="absolute top-4 left-4 bg-[#FF2E63] text-white text-xs font-black uppercase px-3.5 py-1.5 rounded-full shadow-lg">
                            {{ $product->badge }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Right: Product Info & Order Form -->
            <div class="lg:col-span-6 space-y-6 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-[#FF9900] bg-[#FF9900]/10 px-3 py-1 rounded-lg border border-[#FF9900]/20 inline-block mb-2">
                        {{ $product->category->name }}
                    </span>
                    <h1 class="font-display font-black text-3xl sm:text-4xl text-white">
                        {{ $product->name }}
                    </h1>

                    <!-- Rating & Reviews -->
                    <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
                        <div class="flex text-yellow-400 gap-1">
                            <i class="ph ph-star"></i>
                            <span class="font-bold text-white ml-1">{{ $product->rating }}</span>
                        </div>
                        <span>•</span>
                        <span>{{ number_format($product->review_count) }} Ulasan Pembeli</span>
                        <span>•</span>
                        <span class="text-emerald-400 font-bold"><i class="ph ph-circle-check mr-1"></i> 100% Halal</span>
                    </div>

                    <!-- Price -->
                    <div class="mt-4 flex items-baseline gap-3">
                        <span class="font-display font-black text-3xl sm:text-4xl text-[#FF2E63]">{{ $product->formatted_price }}</span>
                        @if($product->original_price)
                            <span class="text-sm text-gray-500 line-through">{{ $product->formatted_original_price }}</span>
                        @endif
                    </div>

                    <!-- Description -->
                    <p class="text-gray-300 text-sm leading-relaxed mt-4">
                        {{ $product->description }}
                    </p>

                    <!-- Level Indicator Box -->
                    <div class="mt-6 p-4 rounded-2xl bg-[#0D0D11] border border-white/10 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#FF2E63]/20 flex items-center justify-center text-[#FF2E63] text-lg">
                                <i class="ph ph-fire-burner"></i>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-white block">Level & Racikan Khas:</span>
                                <span class="text-xs text-gray-400">{{ $product->level_name }}</span>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-[#FF9900]">Gacoan Signature</span>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center gap-4">
                    <button onclick="window.openQuickModal({{ $product->id }})" class="w-full sm:w-auto flex-grow flex items-center justify-center gap-2 bg-gradient-to-r from-[#FF2E63] to-[#FF9900] hover:from-[#e01e53] hover:to-[#e68a00] text-white font-extrabold text-sm py-4 px-8 rounded-2xl shadow-xl shadow-[#FF2E63]/30 transition-all">
                        <i class="ph ph-cart-plus text-base"></i>
                        <span>Kustomisasi & Tambah ke Keranjang</span>
                    </button>
                    <a href="{{ route('menu.index') }}" class="w-full sm:w-auto px-6 py-4 rounded-2xl bg-[#0D0D11] hover:bg-white/5 text-gray-300 hover:text-white border border-white/10 text-xs font-bold text-center transition-colors">
                        Kembali
                    </a>
                </div>

            </div>

        </div>

        <!-- Related Products -->
        @if($relatedProducts->isNotEmpty())
            <div>
                <h3 class="font-display font-bold text-2xl text-white mb-6">Menu Lain di Kategori Ini</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $rel)
                        <div class="bg-[#16161C] border border-white/10 rounded-3xl p-4 shadow-xl hover:border-[#FF2E63]/40 transition-all flex flex-col justify-between group">
                            <div>
                                <div class="relative h-40 w-full rounded-2xl overflow-hidden bg-black/40 mb-3">
                                    <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                </div>
                                <h4 class="font-bold text-sm text-white group-hover:text-[#FF2E63] transition-colors line-clamp-1">{{ $rel->name }}</h4>
                                <span class="font-extrabold text-[#FF2E63] text-sm block mt-1">{{ $rel->formatted_price }}</span>
                            </div>
                            <div class="mt-4 pt-3 border-t border-white/10 flex justify-between items-center">
                                <a href="{{ route('menu.show', $rel->slug) }}" class="text-xs text-gray-400 hover:text-white">Detail</a>
                                <button onclick="window.quickAddToCart({{ $rel->id }}, '{{ addslashes($rel->name) }}')" class="bg-[#FF2E63] text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow">
                                    + Pesan
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
