@extends('layouts.app')

@section('title', 'Katalog Presisi - Kopi Gacoan')
@section('meta_description', 'Jelajahi menu kopi signature, dimsum crispy, es setan, dan makanan utama Kopi Gacoan lengkap dengan pilihan level kafein dan pedas.')

@section('content')
<div class="pt-32 pb-40 px-4 md:px-8 max-w-[1600px] mx-auto min-h-[100dvh] overflow-hidden">
    
    <!-- Hero Banner -->
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-20">
        <div class="inline-block rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-semibold text-white/50 border border-white/10 mb-6 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
            Katalog Lengkap
        </div>
        <h1 class="font-display font-medium text-5xl md:text-7xl lg:text-[7rem] leading-[0.9] tracking-tighter text-white mb-6">
            Rasa <span class="italic text-[#FF2E63] pr-2">Juara</span>, <br class="hidden md:block">
            Harga Merakyat.
        </h1>
        <p class="text-white/50 text-base md:text-lg max-w-2xl font-light">
            Eksplorasi koleksi presisi kami. Mulai dari racikan creamy hingga intensitas Level Setan yang menantang batas kafein dan rasa.
        </p>
    </div>

    <!-- Filter & Categories -->
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 delay-150 mb-16 relative z-20">
        <div class="p-2 bg-white/5 rounded-[2rem] border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.3)] backdrop-blur-2xl">
            <div class="bg-[#050505] rounded-[calc(2rem-0.5rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)] p-4 md:p-6 flex flex-col md:flex-row items-center gap-4">
                
                <form method="GET" action="{{ route('menu.index') }}" class="w-full grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-6 relative">
                        <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-lg"></i>
                        <input type="text" name="q" value="{{ $search }}" placeholder="Pencarian spesifik..." class="w-full bg-[#0A0A0A] border border-white/10 focus:border-white/30 rounded-xl pl-12 pr-4 py-3.5 text-sm text-white placeholder:text-white/30 awwwards-transition outline-none focus:ring-0">
                    </div>
                    <div class="md:col-span-4 relative">
                        <i class="ph ph-faders absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-lg"></i>
                        <select name="level" onchange="this.form.submit()" class="w-full appearance-none bg-[#0A0A0A] border border-white/10 focus:border-white/30 rounded-xl pl-12 pr-10 py-3.5 text-sm text-white/80 awwwards-transition outline-none focus:ring-0">
                            <option value="">Semua Level Intensitas</option>
                            <option value="mild" {{ $level === 'mild' ? 'selected' : '' }}>Level Manja (Mild)</option>
                            <option value="hot" {{ $level === 'hot' ? 'selected' : '' }}>Level Hompimpa (Sedang)</option>
                            <option value="setan" {{ $level === 'setan' ? 'selected' : '' }}>Level Setan (Ekstrem)</option>
                        </select>
                        <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-white/30 pointer-events-none"></i>
                    </div>
                    <div class="md:col-span-2 flex gap-2">
                        <button type="submit" class="w-full bg-white text-black font-semibold rounded-xl py-3.5 hover:bg-gray-200 awwwards-transition active:scale-[0.98]">
                            Saring
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Horizontal Categories Scroll -->
    <div class="flex gap-4 overflow-x-auto pb-8 scrollbar-none mb-12 reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 delay-200">
        <a href="{{ route('menu.index', ['q' => $search, 'level' => $level]) }}" class="px-6 py-3 rounded-full text-[11px] font-semibold uppercase tracking-widest whitespace-nowrap awwwards-transition {{ empty($selectedCategorySlug) ? 'bg-[#FF2E63] text-white shadow-[0_0_20px_rgba(255,46,99,0.3)]' : 'bg-white/5 text-white/50 hover:bg-white/10 hover:text-white border border-white/5' }}">
            Koleksi Penuh ({{ $products->total() }})
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('menu.index', ['category' => $cat->slug, 'q' => $search, 'level' => $level]) }}" class="px-6 py-3 rounded-full text-[11px] font-semibold uppercase tracking-widest whitespace-nowrap awwwards-transition {{ $selectedCategorySlug === $cat->slug ? 'bg-[#FF2E63] text-white shadow-[0_0_20px_rgba(255,46,99,0.3)]' : 'bg-white/5 text-white/50 hover:bg-white/10 hover:text-white border border-white/5' }}">
                {{ $cat->name }} <span class="opacity-50 ml-1">({{ $cat->products_count }})</span>
            </a>
        @endforeach
    </div>

    <!-- Products Asymmetrical Grid -->
    @if($products->isEmpty())
        <div class="text-center py-32 bg-white/5 rounded-[2rem] border border-white/10 reveal-on-scroll">
            <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-6">
                <i class="ph ph-prohibit text-2xl text-white/30"></i>
            </div>
            <h3 class="font-display font-medium text-2xl text-white mb-2">Katalog Kosong</h3>
            <p class="text-sm text-white/40 mb-6">Tidak ada produk yang sesuai dengan kriteria presisi ini.</p>
            <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center bg-white text-black font-semibold rounded-full px-6 py-3 text-sm active:scale-[0.98] awwwards-transition">
                Atur Ulang Pencarian
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $index => $product)
                <!-- Double-Bezel Nested Card -->
                <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-white/5 rounded-[2rem] border border-white/5 ring-1 ring-black/5 shadow-xl hover:scale-[1.02] awwwards-transition group" style="transition-delay: {{ ($index % 8) * 50 }}ms;">
                    <!-- Inner Core -->
                    <div class="relative h-full w-full bg-[#0A0A0A] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)] overflow-hidden flex flex-col justify-between min-h-[420px]">
                        
                        <div class="relative z-10 p-6 flex flex-col items-start gap-1">
                            <div class="flex justify-between w-full items-center mb-3">
                                <span class="text-[9px] font-semibold text-[#FF2E63] uppercase tracking-[0.2em]">{{ $product->category->name }}</span>
                                <span class="text-[9px] font-semibold text-white/30 uppercase tracking-[0.2em]">{{ $product->level_name }}</span>
                            </div>
                            <a href="{{ route('menu.show', $product->slug) }}" class="w-full">
                                <h3 class="font-display font-medium text-2xl text-white group-hover:text-[#FF2E63] awwwards-transition line-clamp-1">{{ $product->name }}</h3>
                            </a>
                            <p class="text-[13px] text-white/40 mt-1 line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <!-- Image Mask -->
                        <div class="absolute inset-0 z-0 opacity-40 group-hover:opacity-70 awwwards-transition pointer-events-none mt-24">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover" style="mask-image: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 80%); -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 80%);">
                        </div>

                        <!-- Price & Action -->
                        <div class="relative z-10 p-6 pt-0 mt-auto flex items-end justify-between">
                            <div>
                                @if($product->original_price)
                                    <span class="text-[10px] text-white/30 line-through block">{{ $product->formatted_original_price }}</span>
                                @endif
                                <span class="font-display font-medium text-xl text-white">{{ $product->formatted_price }}</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <button onclick="window.openQuickModal({{ $product->id }})" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-white/20 awwwards-transition" title="Kustomisasi">
                                    <i class="ph ph-faders text-sm"></i>
                                </button>
                                <button onclick="window.quickAddToCart({{ $product->id }}, '{{ addslashes($product->name) }}')" class="w-10 h-10 rounded-full bg-white text-black flex items-center justify-center hover:bg-gray-200 active:scale-[0.98] awwwards-transition">
                                    <i class="ph ph-plus text-sm"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-20 flex justify-center">
            {{ $products->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('translate-y-16', 'blur-md', 'opacity-0');
                    entry.target.classList.add('translate-y-0', 'blur-0', 'opacity-100');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

        document.querySelectorAll('.reveal-on-scroll').forEach((el) => observer.observe(el));
    });
</script>
@endpush
@endsection
