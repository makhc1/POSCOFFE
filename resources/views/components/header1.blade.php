@php
$navigationItems = [
    [
        "title" => "Beranda",
        "href" => route('home'),
        "description" => "",
        "items" => null
    ],
    [
        "title" => "Menu & Promo",
        "href" => null,
        "description" => "Nikmati hidangan mie pedas terbaik dengan harga terjangkau.",
        "items" => [
            ["title" => "Katalog Menu", "href" => route('menu.index'), "icon" => "ph-bowl-food"],
            ["title" => "Promo & Voucher", "href" => route('promo.index'), "icon" => "ph-ticket"],
        ]
    ],
    [
        "title" => "Perusahaan",
        "href" => null,
        "description" => "Kenali lebih dekat tentang Mie Gacoan dan peluang karir bersama kami.",
        "items" => [
            ["title" => "Tentang Kami", "href" => route('about'), "icon" => "ph-info"],
            ["title" => "Lokasi Cabang", "href" => route('outlets.index'), "icon" => "ph-map-pin"],
            ["title" => "Karir", "href" => route('karir'), "icon" => "ph-briefcase"],
            ["title" => "Kemitraan", "href" => route('kemitraan'), "icon" => "ph-handshake"],
        ]
    ]
];
@endphp

<header class="w-full z-50 fixed top-0 left-0 bg-[#FDFBF7]/80 backdrop-blur-md border-b border-[#2D2420]/10 text-[#2D2420] transition-all duration-300">
    <div class="container mx-auto px-6 relative min-h-[4.5rem] flex gap-4 flex-row lg:grid lg:grid-cols-3 items-center">
        <!-- Desktop Nav -->
        <div class="justify-start items-center gap-4 lg:flex hidden flex-row">
            <nav class="flex justify-start items-center gap-2">
                @foreach($navigationItems as $item)
                    <div class="relative group">
                        @if($item['href'])
                            <a href="{{ $item['href'] }}" class="inline-flex h-10 w-max items-center justify-center rounded-md bg-transparent px-4 py-2 text-sm font-medium transition-colors hover:bg-[#2D2420]/5 hover:text-[#2D2420] focus:bg-[#2D2420]/5 focus:text-[#2D2420] text-[#2D2420]/80">
                                {{ $item['title'] }}
                            </a>
                        @else
                            <button type="button" class="group inline-flex h-10 w-max items-center justify-center rounded-md bg-transparent px-4 py-2 text-sm font-medium transition-colors hover:bg-[#2D2420]/5 hover:text-[#2D2420] focus:bg-[#2D2420]/5 focus:text-[#2D2420] text-[#2D2420]/80">
                                {{ $item['title'] }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="relative top-[1px] ml-1 h-3 w-3 transition duration-300 group-hover:rotate-180">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <!-- Dropdown -->
                            <div class="absolute left-0 top-full hidden w-[450px] group-hover:block bg-[#FAF7F2] border border-[#2D2420]/10 rounded-xl shadow-[0_8px_32px_rgba(0,0,0,0.6)] p-4 mt-2 z-50">
                                <div class="flex flex-col lg:grid grid-cols-2 gap-4">
                                    <div class="flex flex-col h-full justify-between bg-[#FDFBF7] rounded-lg p-4 border border-[#2D2420]/10">
                                        <div class="flex flex-col">
                                            <p class="text-base font-bold text-[#2D2420]">{{ $item['title'] }}</p>
                                            <p class="text-[#2D2420]/50 text-xs mt-2 leading-relaxed">
                                                {{ $item['description'] }}
                                            </p>
                                        </div>
                                        <a href="{{ route('menu.index') }}" class="mt-6 inline-flex items-center justify-center whitespace-nowrap rounded-full text-xs font-bold transition-colors bg-[#4E342E] text-[#2D2420] hover:bg-[#4E342E]/80 h-9 px-3 shadow-[0_0_15px_rgba(255,46,99,0.3)]">
                                            Pesan Sekarang
                                        </a>
                                    </div>
                                    <div class="flex flex-col text-sm h-full justify-center space-y-1">
                                        @foreach($item['items'] as $subItem)
                                            <a href="{{ $subItem['href'] }}" class="flex flex-row items-center gap-3 hover:bg-[#FDFBF7] py-2.5 px-3 rounded-lg transition-colors group/link">
                                                <div class="w-8 h-8 rounded-full bg-[#FDFBF7] flex items-center justify-center group-hover/link:bg-[#4E342E]/20 group-hover/link:text-[#4E342E] transition-colors">
                                                    <i class="ph {{ $subItem['icon'] }} text-lg"></i>
                                                </div>
                                                <span class="font-medium text-[#2D2420]/80 group-hover/link:text-[#2D2420]">{{ $subItem['title'] }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </nav>
        </div>

        <!-- Logo -->
        <div class="flex lg:justify-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-full bg-[#FDFBF7] flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                    <i class="ph ph-coffee text-xl text-[#4E342E]"></i>
                </div>
                <span class="font-extrabold uppercase tracking-[0.2em] text-xs text-[#2D2420]">Gacoan</span>
            </a>
        </div>

        <!-- Desktop Actions -->
        <div class="hidden lg:flex justify-end w-full gap-4 items-center">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kasir' ? route('kasir.pos') : route('home')) }}" class="inline-flex items-center justify-center h-10 px-4 rounded-full bg-[#FDFBF7] hover:bg-[#2D2420]/5 border border-[#2D2420]/10 text-[11px] font-semibold text-[#2D2420] uppercase tracking-widest transition-all group">
                    <i class="ph ph-user text-sm mr-2 group-hover:text-[#4E342E] transition-colors"></i>
                    {{ explode(' ', Auth::user()->name)[0] }}
                </a>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="w-10 h-10 rounded-full bg-[#FDFBF7] hover:bg-[#4E342E]/20 flex items-center justify-center text-[#4E342E] border border-[#2D2420]/10 transition-all" title="Logout">
                        <i class="ph ph-sign-out text-lg"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center h-10 px-5 rounded-full bg-white text-black hover:bg-gray-200 text-[11px] font-bold uppercase tracking-widest transition-all shadow-[0_0_20px_rgba(255,255,255,0.15)]">
                    Masuk
                </a>
            @endauth

            <!-- Cart Toggle -->
            <div class="border-l h-6 border-[#2D2420]/10 ml-2 mr-2"></div>
            
            <button onclick="window.openCartDrawer()" class="relative group w-10 h-10 rounded-full bg-[#FDFBF7] hover:bg-[#2D2420]/5 flex items-center justify-center transition-all">
                <i class="ph ph-shopping-cart text-lg text-[#2D2420]"></i>
                <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-[#4E342E] rounded-full border-2 border-[#0A0A0A] hidden cart-badge-count"></span>
            </button>
        </div>

        <!-- Mobile Menu Toggle & Cart -->
        <div class="flex shrink lg:hidden items-center justify-end ml-auto gap-4">
            <button onclick="window.openCartDrawer()" class="relative w-9 h-9 rounded-full bg-[#FDFBF7] flex items-center justify-center">
                <i class="ph ph-shopping-cart text-base text-[#2D2420]"></i>
                <span class="absolute top-0 right-0 w-2 h-2 bg-[#4E342E] rounded-full hidden cart-badge-count"></span>
            </button>
            <button id="mobile-menu-btn" class="inline-flex items-center justify-center rounded-full p-2 bg-[#FDFBF7] hover:bg-[#2D2420]/5 transition-colors w-9 h-9">
                <i id="icon-menu" class="ph ph-list text-lg"></i>
                <i id="icon-close" class="ph ph-x text-lg hidden"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Content -->
    <div id="mobile-menu-content" class="hidden absolute top-[4.5rem] left-0 border-t border-[#2D2420]/10 flex-col w-full bg-[#FDFBF7]/95 backdrop-blur-xl shadow-2xl py-6 px-6 gap-6 max-h-[calc(100vh-4.5rem)] overflow-y-auto">
        @foreach($navigationItems as $item)
            <div class="flex flex-col gap-2">
                @if($item['href'])
                    <a href="{{ $item['href'] }}" class="flex justify-between items-center py-2 border-b border-[#2D2420]/10">
                        <span class="text-lg font-bold uppercase tracking-wider text-[#2D2420]/90">{{ $item['title'] }}</span>
                        <i class="ph ph-caret-right text-[#2D2420]/30"></i>
                    </a>
                @else
                    <p class="text-lg font-bold uppercase tracking-wider py-2 border-b border-[#2D2420]/10 text-[#2D2420]/90">{{ $item['title'] }}</p>
                @endif

                @if($item['items'])
                    <div class="flex flex-col pl-4 gap-1 mt-2">
                        @foreach($item['items'] as $subItem)
                            <a href="{{ $subItem['href'] }}" class="flex items-center gap-3 py-2 hover:bg-[#FDFBF7] rounded-lg px-2 transition-colors">
                                <i class="ph {{ $subItem['icon'] }} text-[#2D2420]/50 text-lg"></i>
                                <span class="text-[#2D2420]/70 font-medium">{{ $subItem['title'] }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
        
        <div class="flex flex-col gap-3 mt-4 pt-6 border-t border-[#2D2420]/10">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kasir' ? route('kasir.pos') : route('home')) }}" class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-full text-xs font-bold uppercase tracking-wider transition-colors border border-[#2D2420]/10 bg-[#FDFBF7] text-[#2D2420] hover:bg-[#2D2420]/5 h-11 px-4 py-2">
                    Dashboard Profil
                </a>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-full text-xs font-bold uppercase tracking-wider transition-colors bg-[#FDFBF7] text-[#4E342E] hover:bg-[#4E342E]/10 border border-[#2D2420]/10 h-11 px-4 py-2">
                        Keluar
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-full text-xs font-bold uppercase tracking-wider transition-colors hover:bg-gray-200 border border-transparent bg-white text-black shadow-[0_0_20px_rgba(255,255,255,0.15)] h-11 px-4 py-2">
                    Masuk ke Akun
                </a>
                <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-full text-xs font-bold uppercase tracking-wider transition-colors bg-[#FDFBF7] text-[#2D2420] hover:bg-[#2D2420]/5 border border-[#2D2420]/10 h-11 px-4 py-2">
                    Daftar Akun Baru
                </a>
            @endauth
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenuContent = document.getElementById('mobile-menu-content');
        const iconMenu = document.getElementById('icon-menu');
        const iconClose = document.getElementById('icon-close');

        if (mobileMenuBtn && mobileMenuContent) {
            mobileMenuBtn.addEventListener('click', () => {
                const isHidden = mobileMenuContent.classList.contains('hidden');
                if (isHidden) {
                    mobileMenuContent.classList.remove('hidden');
                    mobileMenuContent.classList.add('flex');
                    iconMenu.classList.add('hidden');
                    iconClose.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    mobileMenuContent.classList.add('hidden');
                    mobileMenuContent.classList.remove('flex');
                    iconMenu.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        }
    });
</script>
