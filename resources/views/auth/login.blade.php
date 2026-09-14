@extends('layouts.app')

@section('title', 'Masuk - Bagelan Coffee')

@section('content')
<div class="max-w-6xl mx-auto px-4 w-full flex items-center justify-center -mt-8">
    <div class="w-full bg-[#FAF7F2] rounded-none md:rounded-[1rem] shadow-[0_20px_50px_rgba(45,36,32,0.08)] border border-[#2D2420]/5 overflow-hidden flex flex-col md:flex-row min-h-[650px] reveal-on-scroll translate-y-16 opacity-0 awwwards-transition">
        
        <!-- Left Image Section -->
        <div class="hidden md:flex md:w-1/2 relative bg-[#2D2420] overflow-hidden group">
            <img src="https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&w=1200&q=80" alt="Coffee Pour" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 awwwards-transition duration-[2000ms]">
            <div class="absolute inset-0 bg-gradient-to-t from-[#2D2420] via-[#2D2420]/50 to-transparent"></div>
            
            <div class="relative z-10 flex flex-col justify-end p-12 h-full text-[#FDFBF7]">
                <div class="w-12 h-12 rounded-full border border-[#FDFBF7]/30 flex items-center justify-center mb-8 backdrop-blur-sm">
                    <i class="ph ph-coffee text-xl"></i>
                </div>
                <h2 class="font-editorial text-4xl leading-tight mb-4 text-[#FDFBF7]">Mahakarya <br>Nusantara.</h2>
                <p class="text-sm text-[#FDFBF7]/70 max-w-sm font-light leading-relaxed">
                    Setiap cangkir menceritakan perjalanan panjang dari biji pilihan hingga ke tangan Anda. Masuk untuk menikmati pengalaman eksklusif Bagelan.
                </p>
            </div>
        </div>

        <!-- Right Form Section -->
        <div class="w-full md:w-1/2 flex flex-col justify-center px-8 py-12 md:px-16 lg:px-20 relative bg-[#FDFBF7]">
            <div class="absolute top-0 right-0 p-8">
                <a href="{{ route('home') }}" class="w-10 h-10 rounded-full border border-[#2D2420]/10 flex items-center justify-center text-[#2D2420]/50 hover:bg-[#2D2420] hover:text-[#FDFBF7] awwwards-transition group">
                    <i class="ph ph-x group-hover:rotate-90 awwwards-transition"></i>
                </a>
            </div>

            <div class="mb-10">
                <h1 class="font-editorial text-3xl text-[#2D2420] mb-2">Selamat Datang.</h1>
                <p class="text-sm text-[#2D2420]/60">Masukkan kredensial Anda untuk melanjutkan.</p>
            </div>

            <!-- Demo Login -->
            <div class="mb-8 p-5 border border-[#2D2420]/10 bg-[#FAF7F2] relative">
                <div class="absolute -top-2.5 left-4 px-2 bg-[#FAF7F2] text-[10px] font-semibold uppercase tracking-[0.2em] text-[#2D2420]/40">
                    Akses Cepat Demo
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('quick-login', 'admin') }}" class="flex-1 flex items-center justify-center gap-2 bg-[#2D2420] hover:bg-[#4E342E] text-[#FDFBF7] py-3 text-xs font-medium awwwards-transition group">
                        <i class="ph ph-shield-check text-[#FDFBF7]/70 group-hover:scale-110 awwwards-transition"></i>
                        <span>Admin</span>
                    </a>
                    <a href="{{ route('quick-login', 'kasir') }}" class="flex-1 flex items-center justify-center gap-2 border border-[#2D2420]/20 hover:border-[#2D2420] text-[#2D2420] py-3 text-xs font-medium awwwards-transition group">
                        <i class="ph ph-receipt text-[#2D2420]/70 group-hover:scale-110 awwwards-transition"></i>
                        <span>Kasir</span>
                    </a>
                </div>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-1">
                    <label class="text-[11px] font-semibold text-[#2D2420]/60 uppercase tracking-widest">Email</label>
                    <div class="relative group">
                        <input type="email" name="email" required placeholder="nama@email.com" value="{{ old('email') }}" class="w-full bg-transparent border-b border-[#2D2420]/20 focus:border-[#2D2420] px-0 py-3 text-sm text-[#2D2420] placeholder:text-[#2D2420]/30 transition-colors outline-none ring-0">
                        <i class="ph ph-envelope-simple absolute right-0 top-1/2 -translate-y-1/2 text-[#2D2420]/30 text-lg group-focus-within:text-[#2D2420] transition-colors"></i>
                    </div>
                    @error('email') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <div class="flex items-center justify-between">
                        <label class="text-[11px] font-semibold text-[#2D2420]/60 uppercase tracking-widest">Password</label>
                        <a href="#" class="text-[10px] text-[#2D2420]/50 hover:text-[#2D2420] underline underline-offset-4 awwwards-transition">Lupa?</a>
                    </div>
                    <div class="relative group">
                        <input type="password" name="password" required placeholder="••••••••" class="w-full bg-transparent border-b border-[#2D2420]/20 focus:border-[#2D2420] px-0 py-3 text-sm text-[#2D2420] placeholder:text-[#2D2420]/30 transition-colors outline-none ring-0">
                        <i class="ph ph-key absolute right-0 top-1/2 -translate-y-1/2 text-[#2D2420]/30 text-lg group-focus-within:text-[#2D2420] transition-colors"></i>
                    </div>
                </div>

                <div class="pt-2">
                    <label class="flex items-center gap-3 cursor-pointer group w-max">
                        <div class="relative flex items-center justify-center">
                            <input type="checkbox" name="remember" class="peer appearance-none w-4 h-4 border border-[#2D2420]/20 rounded-none checked:bg-[#2D2420] checked:border-[#2D2420] cursor-pointer transition-colors">
                            <i class="ph ph-check text-white absolute text-[10px] opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                        </div>
                        <span class="text-xs text-[#2D2420]/60 group-hover:text-[#2D2420] awwwards-transition">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <button type="submit" class="w-full group bg-[#2D2420] text-[#FDFBF7] flex items-center justify-between px-6 py-4 mt-6 hover:bg-[#4E342E] awwwards-transition">
                    <span class="text-xs font-semibold uppercase tracking-widest">Masuk Sekarang</span>
                    <i class="ph ph-arrow-right group-hover:translate-x-2 awwwards-transition"></i>
                </button>
            </form>

            <p class="text-center mt-10 text-xs text-[#2D2420]/60">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="text-[#2D2420] font-semibold border-b border-[#2D2420] pb-0.5 hover:text-[#4E342E] hover:border-[#4E342E] awwwards-transition">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            const el = document.querySelector('.reveal-on-scroll');
            if(el) {
                el.classList.remove('translate-y-16', 'opacity-0');
                el.classList.add('translate-y-0', 'opacity-100');
            }
        }, 100);
    });
</script>
@endpush
@endsection
