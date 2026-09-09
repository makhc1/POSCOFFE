@extends('layouts.app')

@section('title', 'Tentang Kami - Kopi Gacoan')
@section('meta_description', 'Kisah di balik Kopi Gacoan: perpaduan biji kopi pilihan petani nusantara dengan konsep nongkrong modern, merakyat, dan selalu penuh energi.')

@section('content')
<div class="pt-32 pb-40 px-4 md:px-8 max-w-[1600px] mx-auto min-h-[100dvh]">
    
    <!-- Hero Header -->
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-32 text-center">
        <div class="inline-block rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-semibold text-white/50 border border-white/10 mb-6 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
            Filosofi Identitas
        </div>
        <h1 class="font-display font-medium text-5xl md:text-7xl lg:text-[7rem] leading-[0.9] tracking-tighter text-white mb-6">
            Rasa <span class="italic text-[#FF2E63] pr-2">Bintang</span>, <br class="hidden sm:block">Harga Merakyat.
        </h1>
        <p class="text-white/50 text-base md:text-lg max-w-2xl font-light mx-auto">
            Lahir dari manifesto generasi yang menuntut estetika ruang dan kualitas kafein yang kompromistis terhadap kantong.
        </p>
    </div>

    <!-- 3 Pillars Editorial Split -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-32">
        <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-white/5 rounded-[2rem] border border-white/5 ring-1 ring-black/5 shadow-xl hover:scale-[1.02] awwwards-transition group" style="transition-delay: 100ms;">
            <div class="relative h-full w-full bg-[#0A0A0A] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)] p-8 overflow-hidden min-h-[350px]">
                <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mb-12 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
                    <i class="ph ph-plant text-xl text-[#FF2E63]"></i>
                </div>
                <h3 class="font-display font-medium text-2xl text-white mb-4">DNA Nusantara</h3>
                <p class="text-[13px] text-white/50 leading-relaxed">
                    Kemitraan langsung dengan kurator kopi lokal dari Aceh hingga Bali untuk profil rasa ekstrem yang bold dan fresh.
                </p>
            </div>
        </div>

        <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-white/5 rounded-[2rem] border border-white/5 ring-1 ring-black/5 shadow-xl hover:scale-[1.02] awwwards-transition group" style="transition-delay: 200ms;">
            <div class="relative h-full w-full bg-[#0A0A0A] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)] p-8 overflow-hidden min-h-[350px]">
                <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mb-12 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
                    <i class="ph ph-lightning text-xl text-[#FF9900]"></i>
                </div>
                <h3 class="font-display font-medium text-2xl text-white mb-4">Intensitas Absolut</h3>
                <p class="text-[13px] text-white/50 leading-relaxed">
                    Racikan bergradasi mulai dari Level Manja (Mild) hingga Level Setan yang mendefinisikan ulang batas ekstraksi kopi.
                </p>
            </div>
        </div>

        <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-white/5 rounded-[2rem] border border-white/5 ring-1 ring-black/5 shadow-xl hover:scale-[1.02] awwwards-transition group" style="transition-delay: 300ms;">
            <div class="relative h-full w-full bg-[#0A0A0A] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)] p-8 overflow-hidden min-h-[350px]">
                <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mb-12 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
                    <i class="ph ph-users-three text-xl text-white"></i>
                </div>
                <h3 class="font-display font-medium text-2xl text-white mb-4">Ruang Produktif</h3>
                <p class="text-[13px] text-white/50 leading-relaxed">
                    Arsitektur gerai spasial yang mensupport workflow digital 24 jam dengan integrasi konektivitas penuh.
                </p>
            </div>
        </div>
    </div>

    <!-- Editorial Split Layout -->
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-white/5 rounded-[3rem] border border-white/5 ring-1 ring-black/5 shadow-2xl">
        <div class="grid grid-cols-1 md:grid-cols-2 relative w-full bg-[#050505] rounded-[calc(3rem-0.375rem)] overflow-hidden">
            <div class="p-12 md:p-20 flex flex-col justify-center">
                <span class="text-[10px] font-semibold text-[#FF2E63] uppercase tracking-[0.2em] mb-4">Standarisasi Kualitas</span>
                <h2 class="font-display font-medium text-4xl md:text-5xl text-white tracking-tight mb-6">Konsistensi Presisi.</h2>
                <p class="text-[14px] text-white/50 leading-relaxed mb-10">
                    Setiap barista Kopi Gacoan dikalibrasi melalui protokol ekstraksi standar industri profesional. Memastikan volume espresso, tekstur susu, dan gramasi bahan baku berpadu dalam keakuratan matematis di setiap cangkir.
                </p>
                
                <a href="{{ route('menu.index') }}" class="group relative inline-flex w-max items-center gap-4 bg-white text-[#050505] font-semibold rounded-full pl-6 pr-1.5 py-1.5 text-sm active:scale-[0.98] awwwards-transition shadow-[0_0_40px_rgba(255,255,255,0.1)]">
                    <span>Eksplorasi Menu</span>
                    <div class="w-8 h-8 rounded-full bg-[#050505]/10 flex items-center justify-center group-hover:translate-x-1 group-hover:-translate-y-[1px] group-hover:scale-105 awwwards-transition">
                        <i class="ph ph-arrow-up-right text-base"></i>
                    </div>
                </a>
            </div>
            
            <div class="h-64 md:h-auto bg-black relative">
                <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1000&q=80" alt="Outlet Suasana" class="absolute inset-0 w-full h-full object-cover grayscale-[30%] opacity-70 mask-image-gradient-left">
                <div class="absolute inset-0 bg-gradient-to-r from-[#050505] via-[#050505]/50 to-transparent"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<style>
    .mask-image-gradient-left {
        mask-image: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 50%);
        -webkit-mask-image: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 50%);
    }
    @media (max-width: 768px) {
        .mask-image-gradient-left {
            mask-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 50%);
            -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 50%);
        }
    }
</style>
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
