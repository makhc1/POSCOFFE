@extends('layouts.app')

@section('title', 'Masuk - Kopi Gacoan')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center relative overflow-hidden px-4 pt-16">
    <div class="w-full max-w-md relative z-10 p-1.5 bg-white/5 rounded-[2rem] border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.5)] awwwards-transition reveal-on-scroll translate-y-16 opacity-0 blur-md">
        <!-- Inner Core -->
        <div class="relative bg-[#0A0A0A] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)] p-8 overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#FF2E63]/[0.05] via-[#050505]/0 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col items-center text-center mb-8">
                <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mb-4 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
                    <i class="ph ph-lock-key text-xl text-[#FF2E63]"></i>
                </div>
                <h1 class="font-display font-medium text-3xl text-white mb-2">Autentikasi</h1>
                <p class="text-xs text-white/50">Akses kredensial untuk melanjutkan.</p>
            </div>

            <!-- Demo Login -->
            <div class="relative z-10 bg-[#050505] rounded-xl border border-white/5 p-4 mb-8">
                <span class="text-[9px] font-semibold uppercase tracking-[0.2em] text-white/40 block text-center mb-3">Akses Cepat Demo</span>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('quick-login', 'admin') }}" class="flex items-center justify-center gap-2 bg-white/5 hover:bg-white/10 text-white border border-white/5 py-2.5 rounded-lg text-xs font-medium awwwards-transition group">
                        <i class="ph ph-shield-check text-[#FF2E63] group-hover:scale-110 awwwards-transition"></i>
                        <span>Admin</span>
                    </a>
                    <a href="{{ route('quick-login', 'kasir') }}" class="flex items-center justify-center gap-2 bg-white/5 hover:bg-white/10 text-white border border-white/5 py-2.5 rounded-lg text-xs font-medium awwwards-transition group">
                        <i class="ph ph-receipt text-[#FF9900] group-hover:scale-110 awwwards-transition"></i>
                        <span>Kasir</span>
                    </a>
                </div>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="relative z-10 space-y-5">
                @csrf
                <div>
                    <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Email</label>
                    <div class="relative">
                        <i class="ph ph-envelope-simple absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-lg"></i>
                        <input type="email" name="email" required placeholder="admin@kopigacoan.com" value="{{ old('email') }}" class="w-full bg-[#050505] border border-white/10 focus:border-white/30 focus:ring-0 rounded-xl pl-12 pr-4 py-3.5 text-sm text-white placeholder:text-white/20 awwwards-transition outline-none">
                    </div>
                    @error('email') <p class="text-[10px] text-red-400 mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <i class="ph ph-key absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-lg"></i>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full bg-[#050505] border border-white/10 focus:border-white/30 focus:ring-0 rounded-xl pl-12 pr-4 py-3.5 text-sm text-white placeholder:text-white/20 awwwards-transition outline-none">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="rounded bg-[#050505] border-white/20 text-[#FF2E63] focus:ring-0 focus:ring-offset-0">
                        <span class="text-xs text-white/50 group-hover:text-white/80 awwwards-transition">Ingat Sesi</span>
                    </label>
                    <a href="{{ route('register') }}" class="text-xs text-[#FF2E63] hover:text-white awwwards-transition">Daftar Akun?</a>
                </div>

                <button type="submit" class="w-full group relative inline-flex items-center justify-center gap-3 bg-white text-[#050505] font-semibold rounded-xl px-6 py-4 text-sm active:scale-[0.98] awwwards-transition overflow-hidden">
                    <span>Masuk Sistem</span>
                    <div class="w-6 h-6 rounded-full bg-[#050505]/10 flex items-center justify-center group-hover:translate-x-1 awwwards-transition">
                        <i class="ph ph-arrow-right text-xs"></i>
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            const el = document.querySelector('.reveal-on-scroll');
            if(el) {
                el.classList.remove('translate-y-16', 'opacity-0', 'blur-md');
                el.classList.add('translate-y-0', 'opacity-100', 'blur-0');
            }
        }, 100);
    });
</script>
@endpush
@endsection
