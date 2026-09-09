<!-- Fluid Island Navbar -->
<nav class="fixed top-0 left-0 right-0 z-[100] mt-6 mx-auto w-max bg-[#0A0A0A]/40 backdrop-blur-3xl border border-white/10 rounded-full px-6 py-2 flex items-center gap-10 awwwards-transition shadow-[0_8px_32px_rgba(0,0,0,0.4)]">
    
    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-hover:scale-110 awwwards-transition">
            <i class="ph ph-coffee text-xl text-[#FF2E63]"></i>
        </div>
        <span class="font-extrabold uppercase tracking-[0.2em] text-[10px] text-white">Gacoan</span>
    </a>

    <div class="hidden md:flex items-center gap-8 text-[13px] font-medium text-white/60 uppercase tracking-widest">
        <a href="{{ route('menu.index') }}" class="hover:text-white awwwards-transition">Menu</a>
        <a href="{{ route('outlets.index') }}" class="hover:text-white awwwards-transition">Lokasi</a>
        <a href="{{ route('promo.index') }}" class="hover:text-white awwwards-transition">Promo</a>
    </div>

    <div class="flex items-center gap-3">
        @auth
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kasir' ? route('kasir.pos') : route('home')) }}" class="hidden md:flex items-center justify-center h-10 px-4 rounded-full bg-white/5 hover:bg-white/10 border border-white/5 text-[11px] font-semibold text-white uppercase tracking-widest awwwards-transition group">
                <i class="ph ph-user text-sm mr-2 group-hover:text-[#FF2E63] awwwards-transition"></i>
                {{ explode(' ', Auth::user()->name)[0] }}
            </a>
            <form action="{{ route('logout') }}" method="POST" class="hidden md:block m-0">
                @csrf
                <button type="submit" class="w-10 h-10 rounded-full bg-white/5 hover:bg-[#FF2E63]/20 flex items-center justify-center text-[#FF2E63] border border-white/5 awwwards-transition" title="Logout">
                    <i class="ph ph-sign-out text-lg"></i>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="hidden md:flex items-center justify-center h-10 px-5 rounded-full bg-white text-black hover:bg-gray-200 text-[11px] font-bold uppercase tracking-widest awwwards-transition shadow-[0_0_20px_rgba(255,255,255,0.15)]">
                Masuk
            </a>
        @endauth

        <button onclick="window.openCartDrawer()" class="relative group w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center awwwards-transition">
            <i class="ph ph-shopping-cart text-lg text-white"></i>
            <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-[#FF2E63] rounded-full border-2 border-[#0A0A0A] hidden cart-badge-count"></span>
        </button>
        
        <!-- Hamburger Morph -->
        <button id="menu-toggle" class="md:hidden relative w-10 h-10 rounded-full bg-white/5 flex flex-col items-center justify-center gap-1.5 awwwards-transition z-[110]">
            <span class="block w-4 h-[1.5px] bg-white awwwards-transition transform origin-center transition-transform" id="line-1"></span>
            <span class="block w-4 h-[1.5px] bg-white awwwards-transition transform origin-center transition-transform" id="line-2"></span>
        </button>
    </div>
</nav>

<!-- Fullscreen Menu Modal Expansion -->
<div id="mobile-menu" class="fixed inset-0 z-[90] bg-[#050505]/95 backdrop-blur-3xl flex flex-col justify-center px-12 opacity-0 pointer-events-none awwwards-transition">
    <div class="flex flex-col gap-8 text-4xl font-display font-medium tracking-tight overflow-hidden">
        <div class="overflow-hidden"><a href="{{ route('home') }}" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-100 hover:text-[#FF2E63]">Beranda</a></div>
        <div class="overflow-hidden"><a href="{{ route('menu.index') }}" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-150 hover:text-[#FF2E63]">Katalog Menu</a></div>
        <div class="overflow-hidden"><a href="{{ route('outlets.index') }}" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-200 hover:text-[#FF2E63]">Lokasi Cabang</a></div>
        <div class="overflow-hidden"><a href="{{ route('promo.index') }}" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-300 hover:text-[#FF2E63]">Promo & Voucher</a></div>
        
        <div class="overflow-hidden mt-8 pt-8 border-t border-white/10">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kasir' ? route('kasir.pos') : route('home')) }}" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-[400ms] text-2xl hover:text-white text-white/50 mb-6">Dashboard Profil</a>
                <form action="{{ route('logout') }}" method="POST" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-[450ms]">
                    @csrf
                    <button type="submit" class="text-2xl hover:text-[#FF2E63] text-[#FF2E63]/70 text-left">Keluar Sistem</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-[400ms] text-2xl hover:text-white text-white/50 mb-6">Masuk ke Akun</a>
                <a href="{{ route('register') }}" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-[450ms] text-2xl hover:text-white text-white/50">Daftar Akun Baru</a>
            @endauth
        </div>
    </div>
</div>

<script>
    const toggleBtn = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');
    const line1 = document.getElementById('line-1');
    const line2 = document.getElementById('line-2');
    const links = document.querySelectorAll('.mobile-link');
    let isOpen = false;

    toggleBtn.addEventListener('click', () => {
        isOpen = !isOpen;
        if (isOpen) {
            menu.classList.remove('opacity-0', 'pointer-events-none');
            line1.classList.add('rotate-45', 'translate-y-[3px]');
            line2.classList.add('-rotate-45', '-translate-y-[4.5px]');
            links.forEach(link => {
                link.classList.remove('translate-y-12', 'opacity-0');
                link.classList.add('translate-y-0', 'opacity-100');
            });
        } else {
            menu.classList.add('opacity-0', 'pointer-events-none');
            line1.classList.remove('rotate-45', 'translate-y-[3px]');
            line2.classList.remove('-rotate-45', '-translate-y-[4.5px]');
            links.forEach(link => {
                link.classList.add('translate-y-12', 'opacity-0');
                link.classList.remove('translate-y-0', 'opacity-100');
            });
        }
    });
</script>
