@extends('layouts.app')

@section('title', 'Promo Spesial - Kopi Gacoan')
@section('meta_description', 'Klaim berbagai kode voucher dan promo eksklusif dari Kopi Gacoan khusus untukmu.')

@section('content')
<div class="pt-32 pb-40 px-4 md:px-8 max-w-[1600px] mx-auto min-h-[100dvh]">
    
    <!-- Hero Header -->
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-20 text-center">
        <div class="inline-block rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-semibold text-white/50 border border-white/10 mb-6 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
            Tawaran Terbatas
        </div>
        <h1 class="font-display font-medium text-5xl md:text-7xl lg:text-[7rem] leading-[0.9] tracking-tighter text-white mb-6">
            Akses <span class="italic text-[#FF2E63] pr-2">Eksklusif</span>.
        </h1>
        <p class="text-white/50 text-base md:text-lg max-w-2xl font-light mx-auto">
            Gunakan kode enkripsi di bawah untuk membuka akses harga khusus, bundel terbatas, dan penawaran spasial lainnya.
        </p>
    </div>

    @if($promotions->isEmpty())
        <div class="text-center py-32 bg-white/5 rounded-[2rem] border border-white/10 reveal-on-scroll">
            <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-6">
                <i class="ph ph-ticket text-2xl text-white/30"></i>
            </div>
            <h3 class="font-display font-medium text-2xl text-white mb-2">Belum Ada Akses</h3>
            <p class="text-sm text-white/40 mb-6">Semua penawaran eksklusif saat ini sedang dalam masa redaksi. Kembali lagi nanti.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($promotions as $index => $promo)
                <!-- Double-Bezel Promo Card -->
                <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-white/5 rounded-[2rem] border border-white/5 ring-1 ring-black/5 shadow-2xl hover:scale-[1.02] awwwards-transition group" style="transition-delay: {{ ($index % 6) * 100 }}ms;">
                    <div class="relative h-full w-full bg-[#050505] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)] p-8 flex flex-col justify-between min-h-[350px] overflow-hidden">
                        
                        <!-- Abstract Gradient Mesh -->
                        <div class="absolute inset-0 opacity-20 pointer-events-none group-hover:opacity-40 awwwards-transition">
                            <div class="absolute -right-20 -top-20 w-64 h-64 bg-{{ explode('-', $promo->banner_gradient)[2] ?? '[#FF2E63]' }} rounded-full blur-[80px]"></div>
                        </div>
                        
                        <div class="relative z-10">
                            <span class="inline-block px-3 py-1.5 rounded-full text-[9px] font-semibold bg-white/10 border border-white/20 text-white uppercase tracking-widest shadow-lg mb-6">
                                {{ $promo->badge_tag }}
                            </span>
                            <h3 class="font-display font-medium text-3xl text-white mb-3">{{ $promo->title }}</h3>
                            <p class="text-[13px] text-white/50 leading-relaxed">{{ $promo->description }}</p>
                        </div>

                        <div class="relative z-10 mt-12 bg-white/5 rounded-xl border border-white/10 p-4 flex flex-col gap-3">
                            <span class="text-[9px] font-semibold text-white/30 uppercase tracking-widest">Kunci Enkripsi</span>
                            <div class="flex items-center justify-between">
                                <span class="font-mono font-medium text-xl text-white tracking-widest">{{ $promo->code }}</span>
                                <button onclick="window.copyVoucherCode('{{ $promo->code }}')" class="w-10 h-10 rounded-full bg-white text-black flex items-center justify-center hover:bg-gray-200 awwwards-transition active:scale-95" title="Salin Kode">
                                    <i class="ph ph-copy text-lg"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
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
