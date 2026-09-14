@extends('layouts.app')

@section('title', 'Katalog Presisi - Bagelan Coffee')
@section('meta_description', 'Jelajahi menu kopi nusantara, robusta pekat, kopi susu aren, dan kudapan khas Bagelan lengkap dengan pilihan level kafein.')

@section('content')
<div class="pt-32 pb-40 px-4 md:px-8 max-w-[1600px] mx-auto min-h-[100dvh] overflow-hidden">
    
    <!-- Hero Banner -->
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-20 text-center md:text-left">
        <div class="inline-block rounded-full px-4 py-1.5 text-[10px] uppercase tracking-[0.2em] font-semibold text-[#8D6E63] border border-[#8D6E63]/30 mb-8 shadow-[inset_0_1px_1px_rgba(141,110,99,0.1)] bg-[#8D6E63]/5">
            Katalog Lengkap
        </div>
        <h1 class="font-editorial text-5xl md:text-7xl lg:text-[7rem] leading-[0.9] tracking-tighter text-[#2D2420] mb-6">
            Rasa <span class="italic text-[#4E342E] pr-2 font-light">Juara</span>, <br class="hidden md:block">
            Harga Merakyat.
        </h1>
        <p class="text-[#2D2420]/60 text-base md:text-xl max-w-2xl font-light mx-auto md:mx-0 leading-relaxed">
            Eksplorasi koleksi presisi kami. Mulai dari racikan murni manual brew hingga kelembutan kopi susu aren otentik Nusantara.
        </p>
    </div>

    <!-- Filter & Categories -->
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 delay-150 mb-16 relative z-20">
        <div class="p-2 bg-[#FDFBF7] rounded-[2rem] border border-[#2D2420]/10 shadow-[0_20px_40px_rgba(45,36,32,0.05)] backdrop-blur-2xl">
            <div class="bg-[#FAF7F2] rounded-[calc(2rem-0.5rem)] shadow-[inset_0_1px_2px_rgba(0,0,0,0.03)] p-4 md:p-6 flex flex-col md:flex-row items-center gap-4">
                
                <form method="GET" action="{{ route('menu.index') }}" class="w-full grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-8 relative">
                        <i class="ph-light ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-[#2D2420]/40 text-lg"></i>
                        <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Pencarian spesifik..." class="w-full bg-[#FDFBF7] border border-[#2D2420]/10 focus:border-[#8D6E63] rounded-xl pl-12 pr-4 py-3.5 text-sm text-[#2D2420] placeholder:text-[#2D2420]/40 awwwards-transition outline-none focus:ring-1 focus:ring-[#8D6E63]">
                    </div>
                    <div class="md:col-span-4 flex gap-2">
                        <button type="submit" class="w-full bg-[#2D2420] text-[#FDFBF7] font-semibold rounded-xl py-3.5 hover:bg-[#4E342E] awwwards-transition active:scale-[0.98]">
                            Saring Koleksi
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Horizontal Categories Scroll -->
    <div class="flex gap-4 overflow-x-auto pb-8 hide-scrollbar mb-12 reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 delay-200">
        <a href="{{ route('menu.index', ['q' => $search ?? '']) }}" class="px-6 py-3 rounded-full text-[11px] font-semibold uppercase tracking-widest whitespace-nowrap awwwards-transition {{ empty($selectedCategorySlug) ? 'bg-[#2D2420] text-[#FDFBF7] shadow-[0_5px_15px_rgba(45,36,32,0.2)]' : 'bg-[#FDFBF7] text-[#2D2420]/60 hover:bg-[#E0D8D0] hover:text-[#2D2420] border border-[#2D2420]/10' }}">
            Koleksi Penuh ({{ $products->total() }})
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('menu.index', ['category' => $cat->slug, 'q' => $search ?? '']) }}" class="px-6 py-3 rounded-full text-[11px] font-semibold uppercase tracking-widest whitespace-nowrap awwwards-transition {{ ($selectedCategorySlug ?? '') === $cat->slug ? 'bg-[#2D2420] text-[#FDFBF7] shadow-[0_5px_15px_rgba(45,36,32,0.2)]' : 'bg-[#FDFBF7] text-[#2D2420]/60 hover:bg-[#E0D8D0] hover:text-[#2D2420] border border-[#2D2420]/10' }}">
                {{ $cat->name }} <span class="opacity-50 ml-1">({{ $cat->products_count }})</span>
            </a>
        @endforeach
    </div>

    <!-- Products Asymmetrical Grid -->
    @if($products->isEmpty())
        <div class="text-center py-32 bg-[#FDFBF7] rounded-[2rem] border border-[#2D2420]/10 reveal-on-scroll shadow-[0_20px_40px_rgba(45,36,32,0.03)]">
            <div class="w-16 h-16 rounded-full bg-[#FAF7F2] border border-[#2D2420]/5 flex items-center justify-center mx-auto mb-6">
                <i class="ph-light ph-prohibit text-2xl text-[#2D2420]/30"></i>
            </div>
            <h3 class="font-editorial text-2xl text-[#2D2420] mb-2">Katalog Kosong</h3>
            <p class="text-sm text-[#2D2420]/50 mb-6 font-light">Tidak ada racikan yang sesuai dengan kriteria presisi ini.</p>
            <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center bg-[#2D2420] text-[#FDFBF7] font-semibold rounded-full px-6 py-3 text-sm active:scale-[0.98] awwwards-transition shadow-lg">
                Atur Ulang Pencarian
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $index => $product)
                <!-- Double-Bezel Nested Card -->
                <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-[#FDFBF7] rounded-[2rem] border border-[#2D2420]/10 shadow-[0_20px_40px_rgba(45,36,32,0.05)] hover:scale-[1.02] awwwards-transition group" style="transition-delay: {{ ($index % 8) * 50 }}ms;">
                    <!-- Inner Core -->
                    <div class="relative h-full w-full bg-[#FAF7F2] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_2px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col justify-between min-h-[420px]">
                        
                        <div class="relative z-10 p-6 flex flex-col items-start gap-1">
                            <div class="flex justify-between w-full items-center mb-4">
                                <span class="text-[9px] font-semibold text-[#8D6E63] uppercase tracking-[0.2em]">{{ $product->category->name }}</span>
                            </div>
                            <a href="{{ route('menu.show', $product->slug) }}" class="w-full">
                                <h3 class="font-editorial text-2xl text-[#2D2420] group-hover:text-[#4E342E] awwwards-transition line-clamp-2 leading-snug">{{ $product->name }}</h3>
                            </a>
                            <p class="text-[13px] text-[#2D2420]/60 font-light mt-2 line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <!-- Image Mask -->
                        <div class="absolute inset-0 z-0 opacity-[0.15] group-hover:opacity-40 awwwards-transition pointer-events-none mt-32">
                            <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover grayscale-[20%]" style="mask-image: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 80%); -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 80%);">
                        </div>

                        <!-- Price & Action -->
                        <div class="relative z-10 p-6 pt-0 mt-auto flex items-end justify-between">
                            <div>
                                @if($product->original_price)
                                    <span class="text-[10px] text-[#2D2420]/40 line-through block mb-0.5">{{ $product->formatted_original_price }}</span>
                                @endif
                                <span class="font-editorial text-2xl text-[#4E342E]">{{ $product->formatted_price }}</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <button onclick="window.openQuickModal({{ $product->id }})" class="w-10 h-10 rounded-full bg-[#FDFBF7] border border-[#2D2420]/10 flex items-center justify-center text-[#2D2420] hover:bg-[#E0D8D0] awwwards-transition shadow-sm" title="Kustomisasi">
                                    <i class="ph-light ph-faders text-sm"></i>
                                </button>
                                <button onclick="window.quickAddToCart({{ $product->id }}, '{{ addslashes($product->name) }}')" class="w-10 h-10 rounded-full bg-[#2D2420] text-[#FDFBF7] flex items-center justify-center hover:bg-[#4E342E] active:scale-[0.98] awwwards-transition shadow-md">
                                    <i class="ph-light ph-plus text-sm"></i>
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
