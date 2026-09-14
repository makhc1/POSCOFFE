<!-- Fluid Island Navbar -->
<nav class="fixed top-0 left-0 right-0 z-[100] mt-6 mx-auto w-max bg-[#1A1412]/60 backdrop-blur-3xl border border-[#4E342E]/30 rounded-full px-6 py-2 flex items-center gap-10 awwwards-transition shadow-[0_8px_32px_rgba(0,0,0,0.1)]">
    
    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
        <div class="w-8 h-8 rounded-full bg-[#4E342E]/10 flex items-center justify-center group-hover:scale-110 awwwards-transition">
            <i class="ph-light ph-coffee text-xl text-[#FDFBF7]"></i>
        </div>
        <span class="font-editorial font-bold uppercase tracking-[0.2em] text-[11px] text-[#FDFBF7]">Bagelan</span>
    </a>

    <div class="hidden md:flex items-center gap-8 text-[12px] font-medium text-[#FDFBF7]/70 uppercase tracking-widest">
        <a href="{{ route('menu.index') }}" class="hover:text-[#FDFBF7] awwwards-transition">Katalog</a>
        <a href="{{ route('outlets.index') }}" class="hover:text-[#FDFBF7] awwwards-transition">Ruang Seduh</a>
        <a href="{{ route('promo.index') }}" class="hover:text-[#FDFBF7] awwwards-transition">Eksklusif</a>
    </div>

    <div class="flex items-center gap-3">
        @auth
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kasir' ? route('kasir.pos') : route('home')) }}" class="hidden md:flex items-center justify-center h-10 px-4 rounded-full bg-[#FDFBF7]/10 hover:bg-[#FDFBF7]/20 border border-[#FDFBF7]/10 text-[11px] font-semibold text-[#FDFBF7] uppercase tracking-widest awwwards-transition group">
                <i class="ph-light ph-user text-sm mr-2 group-hover:text-[#FDFBF7] awwwards-transition"></i>
                {{ explode(' ', Auth::user()->name)[0] }}
            </a>
            <form action="{{ route('logout') }}" method="POST" class="hidden md:block m-0">
                @csrf
                <button type="submit" class="w-10 h-10 rounded-full bg-[#FDFBF7]/10 hover:bg-[#4E342E]/40 flex items-center justify-center text-[#FDFBF7] border border-[#FDFBF7]/10 awwwards-transition" title="Logout">
                    <i class="ph-light ph-sign-out text-lg"></i>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="hidden md:flex items-center justify-center h-10 px-5 rounded-full bg-[#FDFBF7] text-[#1A1412] hover:bg-[#E0D8D0] text-[11px] font-bold uppercase tracking-widest awwwards-transition shadow-[0_0_20px_rgba(253,251,247,0.15)]">
                Masuk
            </a>
        @endauth

        <button onclick="window.openCartDrawer()" class="relative group w-10 h-10 rounded-full bg-[#FDFBF7]/10 hover:bg-[#FDFBF7]/20 flex items-center justify-center awwwards-transition">
            <i class="ph-light ph-shopping-bag text-lg text-[#FDFBF7]"></i>
            <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-[#8D6E63] rounded-full border-2 border-[#1A1412] hidden cart-badge-count"></span>
        </button>
        
        <!-- Hamburger Morph -->
        <button id="menu-toggle" class="md:hidden relative w-10 h-10 rounded-full bg-[#FDFBF7]/10 flex flex-col items-center justify-center gap-1.5 awwwards-transition z-[110]">
            <span class="block w-4 h-[1.5px] bg-[#FDFBF7] awwwards-transition transform origin-center transition-transform" id="line-1"></span>
            <span class="block w-4 h-[1.5px] bg-[#FDFBF7] awwwards-transition transform origin-center transition-transform" id="line-2"></span>
        </button>
    </div>
</nav>

<!-- Fullscreen Menu Modal Expansion -->
<div id="mobile-menu" class="fixed inset-0 z-[90] bg-[#1A1412]/95 backdrop-blur-3xl flex flex-col justify-center px-12 opacity-0 pointer-events-none awwwards-transition">
    <div class="flex flex-col gap-8 text-4xl font-editorial font-medium tracking-tight overflow-hidden">
        <div class="overflow-hidden"><a href="{{ route('home') }}" class="mobile-link text-[#FDFBF7] block transform translate-y-12 opacity-0 awwwards-transition delay-100 hover:text-[#8D6E63] italic">Beranda</a></div>
        <div class="overflow-hidden"><a href="{{ route('menu.index') }}" class="mobile-link text-[#FDFBF7] block transform translate-y-12 opacity-0 awwwards-transition delay-150 hover:text-[#8D6E63] italic">Katalog Kopi</a></div>
        <div class="overflow-hidden"><a href="{{ route('outlets.index') }}" class="mobile-link text-[#FDFBF7] block transform translate-y-12 opacity-0 awwwards-transition delay-200 hover:text-[#8D6E63] italic">Ruang Seduh</a></div>
        <div class="overflow-hidden"><a href="{{ route('promo.index') }}" class="mobile-link text-[#FDFBF7] block transform translate-y-12 opacity-0 awwwards-transition delay-300 hover:text-[#8D6E63] italic">Eksklusif</a></div>
        
        <div class="overflow-hidden mt-8 pt-8 border-t border-[#FDFBF7]/10">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kasir' ? route('kasir.pos') : route('home')) }}" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-[400ms] text-2xl hover:text-[#FDFBF7] text-[#FDFBF7]/50 mb-6">Profil Penikmat</a>
                <form action="{{ route('logout') }}" method="POST" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-[450ms]">
                    @csrf
                    <button type="submit" class="text-2xl hover:text-[#8D6E63] text-[#FDFBF7]/50 text-left">Tinggalkan Ruang</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-[400ms] text-2xl hover:text-[#FDFBF7] text-[#FDFBF7]/50 mb-6">Masuk ke Akun</a>
                <a href="{{ route('register') }}" class="mobile-link block transform translate-y-12 opacity-0 awwwards-transition delay-[450ms] text-2xl hover:text-[#FDFBF7] text-[#FDFBF7]/50">Daftar Akun Baru</a>
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
