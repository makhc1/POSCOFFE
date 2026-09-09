@extends('layouts.app')

@section('title', 'Daftar - Kopi Gacoan')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center relative overflow-hidden px-4 pt-16">
    <div class="w-full max-w-md relative z-10 p-1.5 bg-white/5 rounded-[2rem] border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.5)] awwwards-transition reveal-on-scroll translate-y-16 opacity-0 blur-md">
        <!-- Inner Core -->
        <div class="relative bg-[#0A0A0A] rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)] p-8 overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#FF2E63]/[0.05] via-[#050505]/0 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col items-center text-center mb-8">
                <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mb-4 shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
                    <i class="ph ph-user-plus text-xl text-[#FF2E63]"></i>
                </div>
                <h1 class="font-display font-medium text-3xl text-white mb-2">Registrasi Baru</h1>
                <p class="text-xs text-white/50">Buat identitas untuk bergabung.</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" class="relative z-10 space-y-5">
                @csrf
                <div>
                    <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <i class="ph ph-user absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-lg"></i>
                        <input type="text" name="name" required placeholder="John Doe" value="{{ old('name') }}" class="w-full bg-[#050505] border border-white/10 focus:border-white/30 focus:ring-0 rounded-xl pl-12 pr-4 py-3.5 text-sm text-white placeholder:text-white/20 awwwards-transition outline-none">
                    </div>
                    @error('name') <p class="text-[10px] text-red-400 mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Email</label>
                    <div class="relative">
                        <i class="ph ph-envelope-simple absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-lg"></i>
                        <input type="email" name="email" required placeholder="email@domain.com" value="{{ old('email') }}" class="w-full bg-[#050505] border border-white/10 focus:border-white/30 focus:ring-0 rounded-xl pl-12 pr-4 py-3.5 text-sm text-white placeholder:text-white/20 awwwards-transition outline-none">
                    </div>
                    @error('email') <p class="text-[10px] text-red-400 mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <i class="ph ph-key absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-lg"></i>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full bg-[#050505] border border-white/10 focus:border-white/30 focus:ring-0 rounded-xl pl-12 pr-4 py-3.5 text-sm text-white placeholder:text-white/20 awwwards-transition outline-none">
                    </div>
                    @error('password') <p class="text-[10px] text-red-400 mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-semibold text-white/60 uppercase tracking-widest mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <i class="ph ph-check-circle absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-lg"></i>
                        <input type="password" name="password_confirmation" required placeholder="••••••••" class="w-full bg-[#050505] border border-white/10 focus:border-white/30 focus:ring-0 rounded-xl pl-12 pr-4 py-3.5 text-sm text-white placeholder:text-white/20 awwwards-transition outline-none">
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <a href="{{ route('login') }}" class="text-xs text-white/50 hover:text-white awwwards-transition">Sudah punya akun? Masuk</a>
                </div>

                <button type="submit" class="w-full group relative inline-flex items-center justify-center gap-3 bg-[#FF2E63] text-white font-semibold rounded-xl px-6 py-4 text-sm active:scale-[0.98] awwwards-transition overflow-hidden">
                    <span>Buat Akun Baru</span>
                    <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center group-hover:translate-x-1 awwwards-transition">
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
