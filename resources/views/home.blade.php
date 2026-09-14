@extends('layouts.app')

@section('title', 'Bagelan Coffee - Mahakarya Kopi Nusantara')

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

<!-- Editorial Luxury Hero -->
<section class="relative min-h-[100dvh] flex flex-col justify-center items-center text-center px-4 overflow-hidden -mt-32 border-b border-[#4E342E]/10">
    <!-- Hero Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/hero_seni_menyeduh.jpg') }}" alt="Seni Menyeduh" class="w-full h-full object-cover opacity-[0.15] mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-b from-[#FDFBF7]/50 via-transparent to-[#FDFBF7]"></div>
    </div>
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 flex flex-col items-center z-10 w-full pt-32">
        
        <div class="rounded-full px-4 py-1.5 text-[10px] uppercase tracking-[0.2em] font-semibold text-[#8D6E63] border border-[#8D6E63]/30 mb-10 shadow-[inset_0_1px_1px_rgba(141,110,99,0.1)] bg-[#8D6E63]/5">
            Cita Rasa Nusantara
        </div>

        <h1 class="font-editorial text-7xl md:text-[9rem] lg:text-[11rem] leading-[0.9] tracking-tighter text-[#2D2420] mb-8 max-w-6xl">
            Seni <span class="italic text-[#4E342E] pr-2 font-light">Menyeduh</span>.
        </h1>
        
        <p class="text-lg md:text-xl text-[#2D2420]/60 max-w-2xl font-light tracking-wide mb-14 leading-relaxed">
            Eksplorasi mahakarya kopi dari tanah Indonesia. Dipadukan dengan tradisi dan disajikan dalam estetika modern untuk pengalaman yang tak terlupakan.
        </p>
        
        <!-- Button in Button CTA -->
        <a href="{{ route('menu.index') }}" class="group relative inline-flex items-center gap-4 bg-[#2D2420] text-[#FDFBF7] font-semibold rounded-full pl-8 pr-2 py-2 text-sm active:scale-[0.98] awwwards-transition shadow-[0_0_40px_rgba(45,36,32,0.15)]">
            <span>Jelajahi Rasa</span>
            <div class="w-10 h-10 rounded-full bg-[#FDFBF7]/10 flex items-center justify-center group-hover:translate-x-1 group-hover:-translate-y-[1px] group-hover:scale-105 awwwards-transition">
                <i class="ph-light ph-arrow-up-right text-lg"></i>
            </div>
        </a>
    </div>
</section>

<!-- The Editorial Split (Best Sellers) -->
<section class="py-40 px-4 md:px-8 max-w-[1600px] mx-auto">
    <div class="flex flex-col lg:flex-row items-center gap-20">
        
        <div class="w-full lg:w-1/2 reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 text-center lg:text-left">
            <div class="inline-block rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-semibold text-[#8D6E63] border border-[#8D6E63]/30 mb-8">
                Seleksi Utama
            </div>
            <h2 class="font-editorial text-5xl md:text-7xl lg:text-8xl text-[#2D2420] tracking-tight leading-[1.1] mb-8">
                Favorit <br/><span class="italic font-light text-[#4E342E]">Penikmat</span>
            </h2>
            <p class="text-[#2D2420]/60 text-lg max-w-md mx-auto lg:mx-0 font-light leading-relaxed mb-12">
                Koleksi kopi dan kudapan pilihan yang telah teruji memanjakan lidah. Dipilih karena keseimbangan rasa dan cerita di balik setiap cangkirnya.
            </p>
            <div class="hidden lg:flex items-center gap-4">
                <div class="h-[1px] w-16 bg-[#4E342E]/20"></div>
                <span class="text-xs uppercase tracking-widest text-[#2D2420]/40 font-semibold">Geser untuk melihat</span>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex overflow-x-auto hide-scrollbar gap-6 pb-12 snap-x snap-mandatory pt-10 px-4 md:px-0">
            @foreach($bestSellers as $index => $product)
                <!-- Double-Bezel Architecture -->
                <div class="snap-center shrink-0 w-[320px] md:w-[380px] p-2 bg-[#FDFBF7] rounded-[2rem] border border-[#2D2420]/10 shadow-[0_20px_40px_rgba(45,36,32,0.05)] reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 group" style="transition-delay: {{ $index * 150 }}ms;">
                    
                    <!-- Inner Core -->
                    <div class="relative h-[480px] bg-[#FAF7F2] rounded-[calc(2rem-0.5rem)] shadow-[inset_0_1px_2px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col justify-end">
                        <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-105 awwwards-transition duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1A1412]/90 via-[#1A1412]/30 to-transparent"></div>
                        
                        <div class="relative z-10 p-8 flex flex-col h-full justify-end">
                            <div class="mb-auto mt-2">
                                <span class="bg-[#FDFBF7] text-[#2D2420] text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">{{ $product->category->name }}</span>
                            </div>
                            
                            <h3 class="font-editorial text-3xl text-[#FDFBF7] mb-2">{{ $product->name }}</h3>
                            <p class="text-sm text-[#FDFBF7]/70 font-light mb-6 line-clamp-2">{{ $product->description }}</p>
                            
                            <div class="flex items-center justify-between">
                                <span class="font-editorial text-2xl text-[#E0D8D0]">{{ $product->formatted_price }}</span>
                                <button onclick="window.quickAddToCart({{ $product->id }}, '{{ addslashes($product->name) }}')" class="w-12 h-12 rounded-full bg-[#FDFBF7]/20 backdrop-blur-md border border-[#FDFBF7]/30 flex items-center justify-center hover:bg-[#FDFBF7] hover:text-[#1A1412] text-[#FDFBF7] awwwards-transition active:scale-[0.98]">
                                    <i class="ph-light ph-plus text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- The Asymmetrical Bento (Kategori) -->
<section class="py-32 px-4 md:px-8 bg-[#4E342E] text-[#FDFBF7] rounded-[3rem] mx-2 md:mx-6 mb-20 overflow-hidden relative">
    
    <div class="absolute inset-0 opacity-[0.05] grain-overlay mix-blend-overlay"></div>

    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-20 text-center relative z-10">
        <div class="inline-block rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-semibold text-[#E0D8D0] border border-[#E0D8D0]/30 mb-6">
            Katalog Spasial
        </div>
        <h2 class="font-editorial text-5xl md:text-7xl tracking-tight">Koleksi <span class="italic font-light">Nusantara</span></h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 relative z-10 max-w-[1400px] mx-auto">
        @foreach($categories->take(4) as $index => $category)
            @php
                $span = 'md:col-span-6';
                if($index === 0) $span = 'md:col-span-8 md:row-span-2';
                else if($index === 1) $span = 'md:col-span-4';
                else if($index === 2) $span = 'md:col-span-4';
                else if($index === 3) $span = 'md:col-span-8';
            @endphp
            
            <!-- Outer Shell -->
            <a href="{{ route('menu.index') }}#{{ $category->slug }}" class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 {{ $span }} p-2 bg-[#FDFBF7]/5 rounded-[2rem] border border-[#FDFBF7]/10 hover:border-[#FDFBF7]/30 group" style="transition-delay: {{ $index * 150 }}ms;">
                <!-- Inner Core -->
                <div class="relative h-full w-full bg-[#1A1412]/40 rounded-[calc(2rem-0.5rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)] overflow-hidden flex flex-col {{ $index === 0 ? 'min-h-[500px]' : 'min-h-[250px]' }} p-8 md:p-10">
                    
                    <!-- Background Image for Bento Box -->
                    <img src="{{ asset($category->products->first()?->image_url ?? 'images/hero_seni_menyeduh.jpg') }}" alt="{{ $category->name }}" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-70 group-hover:scale-105 awwwards-transition duration-1000 z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1A1412] via-[#1A1412]/40 to-transparent z-0"></div>

                    <div class="flex justify-between items-start z-10 relative">
                        <div class="w-14 h-14 rounded-full bg-[#1A1412]/40 backdrop-blur-md border border-[#FDFBF7]/20 flex items-center justify-center text-[#E0D8D0]">
                            <i class="ph-light ph-{{ $category->icon }} text-2xl"></i>
                        </div>
                        <div class="w-10 h-10 rounded-full border border-[#FDFBF7]/20 flex items-center justify-center group-hover:bg-[#FDFBF7] group-hover:text-[#1A1412] awwwards-transition -rotate-45 group-hover:rotate-0 bg-[#1A1412]/40 backdrop-blur-md">
                            <i class="ph-light ph-arrow-right text-sm"></i>
                        </div>
                    </div>

                    <div class="mt-auto relative z-10">
                        <span class="text-[10px] uppercase tracking-[0.2em] font-semibold text-[#8D6E63] mb-3 block">{{ $category->badge_text }}</span>
                        <h3 class="font-editorial text-3xl md:text-4xl text-[#FDFBF7] mb-3">{{ $category->name }}</h3>
                        <p class="text-[#FDFBF7]/60 font-light text-sm max-w-sm leading-relaxed">{{ $category->description }}</p>
                    </div>

                </div>
            </a>
        @endforeach
    </div>
</section>

<!-- Testimonial (Z-Axis Cascade adaptation) -->
<section class="py-40 px-4 md:px-8 max-w-[1200px] mx-auto text-center">
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-16">
         <h2 class="font-editorial text-4xl md:text-6xl text-[#2D2420] tracking-tight">Kisah <span class="italic font-light text-[#8D6E63]">Rasa</span></h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        @foreach($testimonials as $index => $testi)
            <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-2 bg-[#FDFBF7] border border-[#2D2420]/10 rounded-[2.5rem] shadow-xl {{ $index % 2 != 0 ? 'md:mt-16' : '' }}">
                <div class="bg-[#FAF7F2] rounded-[calc(2.5rem-0.5rem)] p-10 flex flex-col h-full shadow-[inset_0_1px_2px_rgba(0,0,0,0.03)] text-left relative overflow-hidden">
                    
                    <i class="ph-fill ph-quotes text-6xl text-[#8D6E63]/10 absolute top-8 right-8"></i>
                    
                    <div class="flex items-center gap-1 mb-8 text-[#8D6E63]">
                        @for($i=0; $i < $testi->rating; $i++)
                            <i class="ph-fill ph-star text-sm"></i>
                        @endfor
                    </div>

                    <p class="font-editorial text-xl md:text-2xl text-[#2D2420] leading-relaxed mb-10 italic">
                        "{{ $testi->comment }}"
                    </p>

                    <div class="mt-auto flex items-center gap-4">
                        <img src="{{ $testi->avatar_url }}" alt="{{ $testi->customer_name }}" class="w-14 h-14 rounded-full object-cover grayscale-[20%] border-2 border-[#E0D8D0]">
                        <div>
                            <h4 class="font-semibold text-sm text-[#2D2420]">{{ $testi->customer_name }}</h4>
                            <p class="text-xs text-[#2D2420]/50">{{ $testi->customer_handle }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection
