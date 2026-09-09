@extends('layouts.app')

@section('title', 'Kemitraan - Kopi Gacoan')

@section('content')
<div class="pt-32 pb-40 px-4 md:px-8 max-w-[1000px] mx-auto min-h-[100dvh]">
    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 mb-20 text-center">
        <div class="inline-block rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-semibold text-white/50 border border-white/10 mb-6 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
            Ekspansi Bisnis
        </div>
        <h1 class="font-display font-medium text-5xl md:text-7xl lg:text-[7rem] leading-[0.9] tracking-tighter text-white mb-6">
            Peluang <span class="italic text-[#FF2E63] pr-2">Kemitraan</span>.
        </h1>
    </div>

    <div class="reveal-on-scroll awwwards-transition translate-y-16 blur-md opacity-0 p-1.5 bg-white/5 rounded-[2rem] border border-white/5 ring-1 ring-black/5 shadow-2xl">
        <div class="relative w-full bg-[#050505] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)] p-8 md:p-12">
            <form action="{{ route('kemitraan.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full bg-[#0A0A0A] border border-white/10 focus:border-white/30 rounded-xl px-4 py-3.5 text-sm text-white outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Email</label>
                        <input type="email" name="email" required class="w-full bg-[#0A0A0A] border border-white/10 focus:border-white/30 rounded-xl px-4 py-3.5 text-sm text-white outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Pesan/Lokasi Potensial</label>
                    <textarea name="message" rows="4" required class="w-full bg-[#0A0A0A] border border-white/10 focus:border-white/30 rounded-xl px-4 py-3.5 text-sm text-white outline-none"></textarea>
                </div>
                
                <div class="pt-4 text-center">
                    <button type="submit" class="group relative inline-flex items-center gap-3 bg-white text-[#050505] font-semibold rounded-full pl-6 pr-2 py-2 text-sm active:scale-[0.98] awwwards-transition shadow-[0_0_40px_rgba(255,255,255,0.1)]">
                        <span>Kirim Proposal</span>
                        <div class="w-8 h-8 rounded-full bg-[#050505]/10 flex items-center justify-center group-hover:translate-x-1 group-hover:scale-105 awwwards-transition">
                            <i class="ph ph-paper-plane-right text-sm"></i>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            const el = document.querySelectorAll('.reveal-on-scroll');
            el.forEach(e => {
                e.classList.remove('translate-y-16', 'opacity-0', 'blur-md');
                e.classList.add('translate-y-0', 'opacity-100', 'blur-0');
            });
        }, 100);
    });
</script>
@endpush
@endsection
