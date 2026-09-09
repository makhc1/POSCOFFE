@extends('layouts.app')

@section('title', 'Kopi Gacoan - Elite Aesthetic')

@section('content')

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

<!-- Spatial Hero -->
<section class="relative min-h-[100dvh] flex flex-col justify-center items-center text-center px-4 overflow-hidden -mt-32">
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 flex flex-col items-center z-10 w-full pt-32">
        
        <div class="rounded-full px-4 py-1.5 text-[10px] uppercase tracking-[0.2em] font-semibold text-white/50 border border-white/10 mb-8 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
            Elevating the Everyday
        </div>

        <h1 class="font-display font-medium text-6xl md:text-8xl lg:text-[9rem] leading-[0.9] tracking-tighter text-white mb-8 max-w-5xl">
            SENSASI <span class="italic text-[#FF2E63] pr-2">NENDANG</span>.
        </h1>
        
        <p class="text-lg md:text-xl text-white/50 max-w-2xl font-light tracking-wide mb-12">
            Perpaduan presisi espresso arabika dengan intensitas yang dapat dikalibrasi. Sebuah definisi baru untuk menikmati kopi.
        </p>
        
        <!-- Button in Button CTA -->
        <a href="{{ route('menu.index') }}" class="group relative inline-flex items-center gap-4 bg-white text-[#050505] font-semibold rounded-full pl-8 pr-2 py-2 text-sm active:scale-[0.98] awwwards-transition shadow-[0_0_40px_rgba(255,255,255,0.1)]">
            <span>Jelajahi Menu</span>
            <div class="w-10 h-10 rounded-full bg-[#050505]/10 flex items-center justify-center group-hover:translate-x-1 group-hover:-translate-y-[1px] group-hover:scale-105 awwwards-transition">
                <i class="ph ph-arrow-up-right text-lg"></i>
            </div>
        </a>
    </div>

    <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-0">
        <div class="w-[60vw] h-[60vw] max-w-[600px] max-h-[600px] rounded-full bg-[#FF2E63] opacity-[0.04] blur-[100px] mix-blend-screen translate-x-32 -translate-y-32"></div>
    </div>
</section>

<!-- The Double-Bezel Bento Grid (Menu) -->
<section class="py-40 px-4 md:px-8 max-w-[1600px] mx-auto">
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-20 text-center">
        <div class="inline-block rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-semibold text-white/50 border border-white/10 mb-6">
            Katalog Presisi
        </div>
        <h2 class="font-display font-medium text-4xl md:text-6xl text-white tracking-tight">Koleksi Signature</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        @foreach($bestSellers->take(3) as $index => $product)
            <!-- Outer Shell -->
            <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 {{ $index === 0 ? 'md:col-span-8 md:row-span-2' : 'md:col-span-4' }} p-2 bg-white/5 rounded-[2rem] border border-white/5 ring-1 ring-black/5 shadow-2xl" style="transition-delay: {{ $index * 150 }}ms;">
                <!-- Inner Core -->
                <div class="relative h-full w-full bg-[#0A0A0A] rounded-[calc(2rem-0.5rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.08)] overflow-hidden flex flex-col justify-between group min-h-[400px]">
                    
                    <div class="relative z-10 p-10 flex justify-between items-start">
                        <div class="max-w-[70%]">
                            <h3 class="font-display font-medium text-3xl text-white mb-3">{{ $product->name }}</h3>
                            <p class="text-sm text-white/40 leading-relaxed">{{ $product->description }}</p>
                        </div>
                        <span class="font-display text-xl text-[#FF2E63]">{{ $product->formatted_price }}</span>
                    </div>

                    <div class="absolute inset-0 z-0 opacity-30 group-hover:opacity-70 group-hover:scale-105 awwwards-transition pointer-events-none mt-20">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover" style="mask-image: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 80%); -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 80%);">
                    </div>

                    <div class="relative z-10 p-8 flex justify-end">
                        <button onclick="window.quickAddToCart({{ $product->id }}, '{{ addslashes($product->name) }}')" class="w-14 h-14 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center hover:bg-white hover:text-black awwwards-transition active:scale-[0.98]">
                            <i class="ph ph-plus text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Outlets - Z-Axis Cascade -->
<section class="py-40 px-4 md:px-8 max-w-[1600px] mx-auto overflow-hidden">
    <div class="flex flex-col md:flex-row items-end justify-between mb-24 gap-8 reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0">
        <div>
            <div class="inline-block rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-semibold text-white/50 border border-white/10 mb-6">
                Jejak Spasial
            </div>
            <h2 class="font-display font-medium text-4xl md:text-6xl text-white tracking-tight">Eksplorasi Ruang</h2>
        </div>
        <a href="{{ route('outlets.index') }}" class="group flex items-center gap-3 text-sm font-semibold text-white/50 hover:text-white awwwards-transition">
            <span>Seluruh Lokasi</span>
            <div class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-black awwwards-transition">
                <i class="ph ph-arrow-right text-sm"></i>
            </div>
        </a>
    </div>

    <!-- The Cascade -->
    <div class="flex flex-col md:flex-row items-center justify-center relative min-h-[600px] md:min-h-[500px]">
        @foreach($outlets->take(3) as $index => $outlet)
            @php
                $rotations = ['md:-rotate-2', 'md:rotate-0', 'md:rotate-3'];
                $zIndexes = ['z-10', 'z-20', 'z-30'];
                $margins = ['md:-mr-12', 'md:-mt-12', 'md:-ml-12'];
            @endphp
            <!-- Outer Shell -->
            <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 relative {{ $rotations[$index] }} {{ $zIndexes[$index] }} {{ $margins[$index] }} mb-6 md:mb-0 w-full md:w-[400px] p-2 bg-white/5 rounded-[2rem] border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.5)] hover:z-40 hover:scale-105 hover:rotate-0 awwwards-transition cursor-pointer" style="transition-delay: {{ $index * 150 }}ms;">
                <!-- Inner Core -->
                <div class="relative h-[450px] w-full bg-[#050505] rounded-[calc(2rem-0.5rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)] overflow-hidden">
                    <img src="{{ $outlet->image_url }}" alt="{{ $outlet->name }}" class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale-[30%]">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
                    
                    <div class="absolute inset-x-0 bottom-0 p-8">
                        <span class="text-[10px] font-semibold text-[#FF2E63] uppercase tracking-[0.2em] block mb-2">{{ $outlet->city }}</span>
                        <h3 class="font-display font-medium text-2xl text-white mb-2">{{ $outlet->name }}</h3>
                        <p class="text-xs text-white/50">{{ $outlet->address }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection
