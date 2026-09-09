@extends('layouts.app')

@section('title', 'Lokasi Cabang - Kopi Gacoan')
@section('meta_description', 'Temukan cabang outlet Kopi Gacoan terdekat di kotamu. Nikmati fasilitas dine-in nyaman, colokan, Wi-Fi gratis, buka hingga 24 jam.')

@section('content')
<div class="pt-32 pb-40 px-4 md:px-8 max-w-[1600px] mx-auto min-h-[100dvh]">
    
    <!-- Header -->
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-20 text-center">
        <div class="inline-block rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-semibold text-white/50 border border-white/10 mb-6 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
            Jejak Spasial
        </div>
        <h1 class="font-display font-medium text-5xl md:text-7xl lg:text-[7rem] leading-[0.9] tracking-tighter text-white mb-6">
            Eksplorasi <span class="italic text-[#FF2E63] pr-2">Ruang</span>.
        </h1>
        <p class="text-white/50 text-base md:text-lg max-w-2xl font-light mx-auto">
            Temukan arsitektur presisi Kopi Gacoan di kotamu. Ruang yang dirancang khusus untuk kenyamanan dan produktivitas tanpa batas waktu.
        </p>
    </div>

    <!-- The Z-Axis Masonry / Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($outlets as $index => $outlet)
            <!-- Double-Bezel Card with Hover Physics -->
            <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-white/5 rounded-[2rem] border border-white/5 ring-1 ring-black/5 shadow-2xl group hover:scale-[1.02] awwwards-transition" style="transition-delay: {{ ($index % 6) * 100 }}ms;">
                <div class="relative h-full w-full bg-[#0A0A0A] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)] overflow-hidden flex flex-col min-h-[500px]">
                    
                    <div class="relative h-64 w-full bg-black">
                        <img src="{{ $outlet->image_url }}" alt="{{ $outlet->name }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 awwwards-transition grayscale-[20%] group-hover:grayscale-0">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A0A0A] to-transparent pointer-events-none"></div>
                        
                        <div class="absolute top-6 left-6 flex gap-2">
                            <span class="px-3 py-1 rounded-full text-[9px] font-semibold bg-white/10 backdrop-blur-md border border-white/20 text-white uppercase tracking-widest shadow-lg">
                                {{ $outlet->status }}
                            </span>
                            @if($outlet->is_24_hours)
                                <span class="px-3 py-1 rounded-full text-[9px] font-semibold bg-[#FF2E63] text-white uppercase tracking-widest shadow-[0_0_15px_rgba(255,46,99,0.5)]">
                                    24 JAM
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-8 flex flex-col flex-grow">
                        <span class="text-[10px] font-semibold text-[#FF2E63] uppercase tracking-[0.2em] mb-2">{{ $outlet->city }}</span>
                        <h3 class="font-display font-medium text-3xl text-white mb-3">{{ $outlet->name }}</h3>
                        <p class="text-[13px] text-white/50 flex-grow mb-6">{{ $outlet->address }}</p>
                        
                        <!-- Tags / Amenities -->
                        <div class="flex flex-wrap gap-2 mb-8">
                            @if($outlet->has_wifi)
                                <span class="text-[9px] font-semibold uppercase tracking-widest bg-white/5 text-white/50 px-3 py-1.5 rounded-full border border-white/5"><i class="ph ph-wifi-high mr-1 text-[#FF9900]"></i> Fiber</span>
                            @endif
                            @if($outlet->has_colokan)
                                <span class="text-[9px] font-semibold uppercase tracking-widest bg-white/5 text-white/50 px-3 py-1.5 rounded-full border border-white/5"><i class="ph ph-plug mr-1 text-[#FF2E63]"></i> Stopkontak</span>
                            @endif
                            @if($outlet->has_drive_thru)
                                <span class="text-[9px] font-semibold uppercase tracking-widest bg-white/5 text-white/50 px-3 py-1.5 rounded-full border border-white/5"><i class="ph ph-car mr-1 text-white"></i> Drive-Thru</span>
                            @endif
                        </div>

                        <a href="{{ $outlet->google_maps_url }}" target="_blank" rel="noopener noreferrer" class="group/btn relative w-full flex items-center justify-between bg-white/5 hover:bg-white text-white hover:text-black text-[11px] font-semibold uppercase tracking-widest py-3 px-6 rounded-xl border border-white/10 awwwards-transition active:scale-[0.98]">
                            <span>Buka di Peta</span>
                            <i class="ph ph-arrow-right text-base group-hover/btn:translate-x-1 awwwards-transition"></i>
                        </a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
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
