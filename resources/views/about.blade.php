@extends('layouts.app')

@section('title', 'Filosofi - Bagelan Coffee')
@section('meta_description', 'Kisah di balik Bagelan Coffee: perpaduan biji kopi pilihan petani nusantara dengan konsep menyeduh presisi tinggi yang elegan.')

@section('content')
<div class="pt-32 pb-40 px-4 md:px-8 max-w-[1600px] mx-auto min-h-[100dvh]">
    
    <!-- Hero Header -->
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-32 text-center">
        <div class="inline-block rounded-full px-4 py-1.5 text-[10px] uppercase tracking-[0.2em] font-semibold text-[#8D6E63] border border-[#8D6E63]/30 mb-8 shadow-[inset_0_1px_1px_rgba(141,110,99,0.1)] bg-[#8D6E63]/5">
            Filosofi Identitas
        </div>
        <h1 class="font-editorial text-6xl md:text-[8rem] lg:text-[10rem] leading-[0.9] tracking-tighter text-[#2D2420] mb-8">
            Rasa <span class="italic text-[#4E342E] pr-2 font-light">Juara</span>, <br class="hidden sm:block">Harga Merakyat.
        </h1>
        <p class="text-[#2D2420]/60 text-lg md:text-xl max-w-2xl font-light mx-auto leading-relaxed">
            Lahir dari apresiasi mendalam terhadap kekayaan bumi pertiwi. Kami membawa kopi Nusantara ke tingkat presisi tertinggi tanpa kompromi kualitas.
        </p>
    </div>

    <!-- 3 Pillars Editorial Split -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-32">
        <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-[#FDFBF7] rounded-[2rem] border border-[#2D2420]/10 shadow-[0_20px_40px_rgba(45,36,32,0.05)] hover:scale-[1.02] awwwards-transition group" style="transition-delay: 100ms;">
            <div class="relative h-full w-full bg-[#FAF7F2] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_2px_rgba(0,0,0,0.03)] p-10 overflow-hidden min-h-[350px]">
                <div class="w-14 h-14 rounded-full bg-[#FDFBF7] border border-[#2D2420]/10 flex items-center justify-center mb-12 shadow-sm">
                    <i class="ph-light ph-plant text-2xl text-[#8D6E63]"></i>
                </div>
                <h3 class="font-editorial text-3xl text-[#2D2420] mb-4">DNA Nusantara</h3>
                <p class="text-sm text-[#2D2420]/60 font-light leading-relaxed">
                    Kemitraan langsung dengan kurator kopi lokal dari Aceh hingga Bali untuk profil rasa ekstrem yang murni dan otentik.
                </p>
            </div>
        </div>

        <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-[#FDFBF7] rounded-[2rem] border border-[#2D2420]/10 shadow-[0_20px_40px_rgba(45,36,32,0.05)] hover:scale-[1.02] awwwards-transition group" style="transition-delay: 200ms;">
            <div class="relative h-full w-full bg-[#FAF7F2] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_2px_rgba(0,0,0,0.03)] p-10 overflow-hidden min-h-[350px]">
                <div class="w-14 h-14 rounded-full bg-[#FDFBF7] border border-[#2D2420]/10 flex items-center justify-center mb-12 shadow-sm">
                    <i class="ph-light ph-drop text-2xl text-[#8D6E63]"></i>
                </div>
                <h3 class="font-editorial text-3xl text-[#2D2420] mb-4">Ekstraksi Presisi</h3>
                <p class="text-sm text-[#2D2420]/60 font-light leading-relaxed">
                    Setiap tetes dikalibrasi. Menyajikan perpaduan sains dan seni untuk menghasilkan keseimbangan aroma dan acidity yang sempurna.
                </p>
            </div>
        </div>

        <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-[#FDFBF7] rounded-[2rem] border border-[#2D2420]/10 shadow-[0_20px_40px_rgba(45,36,32,0.05)] hover:scale-[1.02] awwwards-transition group" style="transition-delay: 300ms;">
            <div class="relative h-full w-full bg-[#FAF7F2] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_2px_rgba(0,0,0,0.03)] p-10 overflow-hidden min-h-[350px]">
                <div class="w-14 h-14 rounded-full bg-[#FDFBF7] border border-[#2D2420]/10 flex items-center justify-center mb-12 shadow-sm">
                    <i class="ph-light ph-armchair text-2xl text-[#8D6E63]"></i>
                </div>
                <h3 class="font-editorial text-3xl text-[#2D2420] mb-4">Ruang Kontemplasi</h3>
                <p class="text-sm text-[#2D2420]/60 font-light leading-relaxed">
                    Arsitektur gerai spasial yang dirancang eksklusif, memberikan kedamaian untuk berdiskusi, merenung, dan menikmati mahakarya.
                </p>
            </div>
        </div>
    </div>

    <!-- Editorial Split Layout -->
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-[#FDFBF7] rounded-[3rem] border border-[#2D2420]/10 shadow-[0_30px_60px_rgba(45,36,32,0.08)]">
        <div class="grid grid-cols-1 md:grid-cols-2 relative w-full bg-[#FAF7F2] rounded-[calc(3rem-0.375rem)] overflow-hidden">
            <div class="p-12 md:p-20 flex flex-col justify-center">
                <span class="text-[10px] font-semibold text-[#8D6E63] uppercase tracking-[0.2em] mb-4">Standarisasi Kualitas</span>
                <h2 class="font-editorial text-4xl md:text-5xl text-[#2D2420] tracking-tight mb-8">Konsistensi <br/><span class="italic font-light text-[#4E342E]">Presisi.</span></h2>
                <p class="text-[15px] text-[#2D2420]/60 font-light leading-relaxed mb-12">
                    Setiap barista Bagelan Coffee dikalibrasi melalui protokol ekstraksi standar industri profesional. Memastikan volume air, suhu, dan gramasi biji kopi berpadu dalam keakuratan matematis di setiap cangkir.
                </p>
                
                <a href="{{ route('menu.index') }}" class="group relative inline-flex w-max items-center gap-4 bg-[#2D2420] text-[#FDFBF7] font-semibold rounded-full pl-6 pr-1.5 py-1.5 text-sm active:scale-[0.98] awwwards-transition shadow-[0_0_20px_rgba(45,36,32,0.2)]">
                    <span>Eksplorasi Menu</span>
                    <div class="w-8 h-8 rounded-full bg-[#FDFBF7]/10 flex items-center justify-center group-hover:translate-x-1 group-hover:-translate-y-[1px] group-hover:scale-105 awwwards-transition">
                        <i class="ph-light ph-arrow-up-right text-base"></i>
                    </div>
                </a>
            </div>
            
            <div class="h-64 md:h-auto bg-[#2D2420] relative">
                <img src="https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&w=1000&q=80" alt="Seni Menyeduh" class="absolute inset-0 w-full h-full object-cover opacity-80 mask-image-gradient-left">
                <div class="absolute inset-0 bg-gradient-to-r from-[#FAF7F2] via-[#FAF7F2]/20 to-transparent"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<style>
    .mask-image-gradient-left {
        mask-image: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 30%);
        -webkit-mask-image: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 30%);
    }
    @media (max-width: 768px) {
        .mask-image-gradient-left {
            mask-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 30%);
            -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 30%);
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
