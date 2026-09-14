@php
$features = [
    ['title' => 'Signature Nusantara', 'description' => 'Biji kopi pilihan dari seluruh penjuru Indonesia', 'href' => route('menu.index')],
    ['title' => 'Robusta Klasik', 'description' => 'Intensitas absolut untuk penikmat sejati', 'href' => route('menu.index')],
    ['title' => 'Kopi Susu Aren', 'description' => 'Perpaduan manisnya gula aren murni', 'href' => route('menu.index')],
    ['title' => 'Kudapan Bagelen', 'description' => 'Teman setia pendamping secangkir kopi Anda', 'href' => route('menu.index')],
];
@endphp

<section class="py-4 bg-[#FDFBF7] text-[#2D2420] border-b border-[#2D2420]/10 w-full fixed top-0 z-[100] shadow-sm">
    <div class="container mx-auto px-4">
        <nav class="flex items-center justify-between" x-data="{ mobileMenuOpen: false, featuresOpen: false }">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-[#4E342E]/10 flex items-center justify-center">
                    <i class="ph-light ph-coffee text-xl text-[#4E342E]"></i>
                </div>
                <span class="text-lg font-editorial font-bold tracking-[0.2em] uppercase">Bagelan</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-6 relative">
                <a href="{{ route('menu.index') }}" class="text-sm font-medium hover:text-[#8D6E63] transition-colors">Katalog</a>
                
                <!-- Features Dropdown (Alpine) -->
                <div class="relative" @click.away="featuresOpen = false">
                    <button @click="featuresOpen = !featuresOpen" class="flex items-center gap-1 text-sm font-medium hover:text-[#8D6E63] transition-colors">
                        Spesialitas
                        <svg :class="{'rotate-180': featuresOpen}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div x-show="featuresOpen" x-transition class="absolute top-full mt-2 left-1/2 -translate-x-1/2 w-[600px] bg-[#FAF7F2] border border-[#2D2420]/10 shadow-xl rounded-md p-3 grid grid-cols-2 z-50">
                        @foreach($features as $feature)
                            <a href="{{ $feature['href'] }}" class="rounded-md p-3 transition-colors hover:bg-[#FDFBF7] group">
                                <p class="mb-1 font-semibold text-[#2D2420] group-hover:text-[#4E342E]">{{ $feature['title'] }}</p>
                                <p class="text-sm text-[#2D2420]/60">{{ $feature['description'] }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('outlets.index') }}" class="text-sm font-medium hover:text-[#8D6E63] transition-colors">Ruang Seduh</a>
                <a href="{{ route('promo.index') }}" class="text-sm font-medium hover:text-[#8D6E63] transition-colors">Eksklusif</a>
            </div>

            <!-- Desktop CTA -->
            <div class="hidden lg:flex items-center gap-4">
                <button onclick="window.openCartDrawer()" class="relative group w-10 h-10 rounded-full hover:bg-[#2D2420]/5 flex items-center justify-center transition-colors">
                    <i class="ph-light ph-shopping-bag text-xl text-[#2D2420]"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-[#8D6E63] rounded-full border-2 border-[#FDFBF7] hidden cart-badge-count"></span>
                </button>
                
                @auth
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kasir' ? route('kasir.pos') : route('home')) }}">
                        <x-ui.button variant="outline">Profil: {{ explode(' ', Auth::user()->name)[0] }}</x-ui.button>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <x-ui.button>Logout</x-ui.button>
                    </form>
                @else
                    <a href="{{ route('login') }}"><x-ui.button variant="outline">Sign in</x-ui.button></a>
                    <a href="{{ route('register') }}"><x-ui.button>Daftar</x-ui.button></a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="lg:hidden p-2 border border-[#2D2420]/10 rounded-md text-[#2D2420] hover:bg-[#2D2420]/5" @click="mobileMenuOpen = !mobileMenuOpen">
                <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg x-show="mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </nav>
        
        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenuOpen" x-transition class="lg:hidden mt-4 pt-4 border-t border-[#2D2420]/10 flex flex-col gap-4 pb-4">
            <a href="{{ route('menu.index') }}" class="text-sm font-medium hover:text-[#8D6E63] transition-colors">Katalog</a>
            <a href="{{ route('outlets.index') }}" class="text-sm font-medium hover:text-[#8D6E63] transition-colors">Ruang Seduh</a>
            <a href="{{ route('promo.index') }}" class="text-sm font-medium hover:text-[#8D6E63] transition-colors">Eksklusif</a>
            
            <hr class="border-[#2D2420]/10 my-2">
            
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kasir' ? route('kasir.pos') : route('home')) }}" class="text-sm font-medium">Profil: {{ explode(' ', Auth::user()->name)[0] }}</a>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-left w-full text-red-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium">Sign in</a>
                <a href="{{ route('register') }}" class="text-sm font-medium">Daftar Akun Baru</a>
            @endauth
        </div>
    </div>
</section>
