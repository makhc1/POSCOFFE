@extends('layouts.app')

@section('title', 'Daftar - Bagelan Coffee')

@section('content')
<div class="max-w-6xl mx-auto px-4 w-full flex items-center justify-center -mt-8">
    <div class="w-full bg-[#FAF7F2] rounded-none md:rounded-[1rem] shadow-[0_20px_50px_rgba(45,36,32,0.08)] border border-[#2D2420]/5 overflow-hidden flex flex-col md:flex-row-reverse min-h-[650px] reveal-on-scroll translate-y-16 opacity-0 awwwards-transition">
        
        <!-- Right Image Section (reversed) -->
        <div class="hidden md:flex md:w-1/2 relative bg-[#2D2420] overflow-hidden group">
            <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=1200&q=80" alt="Coffee Setup" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 awwwards-transition duration-[2000ms]">
            <div class="absolute inset-0 bg-gradient-to-t from-[#2D2420] via-[#2D2420]/50 to-transparent"></div>
            
            <div class="relative z-10 flex flex-col justify-end p-12 h-full text-[#FDFBF7]">
                <div class="w-12 h-12 rounded-full border border-[#FDFBF7]/30 flex items-center justify-center mb-8 backdrop-blur-sm">
                    <i class="ph ph-seal-check text-xl"></i>
                </div>
                <h2 class="font-editorial text-4xl leading-tight mb-4 text-[#FDFBF7]">Bergabung <br>Bersama Kami.</h2>
                <p class="text-sm text-[#FDFBF7]/70 max-w-sm font-light leading-relaxed">
                    Dapatkan penawaran eksklusif, akses prioritas, dan cerita di balik setiap racikan kopi Nusantara kami.
                </p>
            </div>
        </div>

        <!-- Left Form Section -->
        <div class="w-full md:w-1/2 flex flex-col justify-center px-8 py-12 md:px-16 lg:px-20 relative bg-[#FDFBF7]">
            <div class="absolute top-0 left-0 p-8">
                <a href="{{ route('home') }}" class="w-10 h-10 rounded-full border border-[#2D2420]/10 flex items-center justify-center text-[#2D2420]/50 hover:bg-[#2D2420] hover:text-[#FDFBF7] awwwards-transition group">
                    <i class="ph ph-arrow-left group-hover:-translate-x-1 awwwards-transition"></i>
                </a>
            </div>

            <div class="mb-10 mt-6">
                <h1 class="font-editorial text-3xl text-[#2D2420] mb-2">Registrasi Baru.</h1>
                <p class="text-sm text-[#2D2420]/60">Lengkapi identitas Anda di bawah ini.</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-1">
                    <label class="text-[11px] font-semibold text-[#2D2420]/60 uppercase tracking-widest">Nama Lengkap</label>
                    <div class="relative group">
                        <input type="text" name="name" required placeholder="John Doe" value="{{ old('name') }}" class="w-full bg-transparent border-b border-[#2D2420]/20 focus:border-[#2D2420] px-0 py-3 text-sm text-[#2D2420] placeholder:text-[#2D2420]/30 transition-colors outline-none ring-0">
                        <i class="ph ph-user absolute right-0 top-1/2 -translate-y-1/2 text-[#2D2420]/30 text-lg group-focus-within:text-[#2D2420] transition-colors"></i>
                    </div>
                    @error('name') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-[11px] font-semibold text-[#2D2420]/60 uppercase tracking-widest">Email Address</label>
                    <div class="relative group">
                        <input type="email" name="email" required placeholder="nama@email.com" value="{{ old('email') }}" class="w-full bg-transparent border-b border-[#2D2420]/20 focus:border-[#2D2420] px-0 py-3 text-sm text-[#2D2420] placeholder:text-[#2D2420]/30 transition-colors outline-none ring-0">
                        <i class="ph ph-envelope-simple absolute right-0 top-1/2 -translate-y-1/2 text-[#2D2420]/30 text-lg group-focus-within:text-[#2D2420] transition-colors"></i>
                    </div>
                    @error('email') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-[11px] font-semibold text-[#2D2420]/60 uppercase tracking-widest">Password</label>
                        <div class="relative group">
                            <input type="password" name="password" required placeholder="••••••••" class="w-full bg-transparent border-b border-[#2D2420]/20 focus:border-[#2D2420] px-0 py-3 text-sm text-[#2D2420] placeholder:text-[#2D2420]/30 transition-colors outline-none ring-0">
                        </div>
                        @error('password') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-[11px] font-semibold text-[#2D2420]/60 uppercase tracking-widest">Ulangi Password</label>
                        <div class="relative group">
                            <input type="password" name="password_confirmation" required placeholder="••••••••" class="w-full bg-transparent border-b border-[#2D2420]/20 focus:border-[#2D2420] px-0 py-3 text-sm text-[#2D2420] placeholder:text-[#2D2420]/30 transition-colors outline-none ring-0">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full group bg-[#2D2420] text-[#FDFBF7] flex items-center justify-between px-6 py-4 mt-8 hover:bg-[#4E342E] awwwards-transition">
                    <span class="text-xs font-semibold uppercase tracking-widest">Daftar Akun</span>
                    <i class="ph ph-arrow-right group-hover:translate-x-2 awwwards-transition"></i>
                </button>
            </form>

            <p class="text-center mt-10 text-xs text-[#2D2420]/60">
                Sudah menjadi member? 
                <a href="{{ route('login') }}" class="text-[#2D2420] font-semibold border-b border-[#2D2420] pb-0.5 hover:text-[#4E342E] hover:border-[#4E342E] awwwards-transition">Masuk di sini</a>
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
