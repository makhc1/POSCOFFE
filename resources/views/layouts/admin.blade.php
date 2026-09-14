<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Bagelan Coffee')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .grain-overlay {
            position: fixed;
            inset: 0;
            z-index: 50;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.04'/%3E%3C/svg%3E");
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDFBF7;
            color: #2D2420;
        }
        .font-editorial {
            font-family: 'Playfair Display', serif;
        }
        .awwwards-transition {
            transition: all 700ms cubic-bezier(0.32, 0.72, 0, 1);
        }
    </style>
</head>
<body class="antialiased min-h-[100dvh] flex selection:bg-[#2D2420] selection:text-[#FDFBF7]">
    <div class="grain-overlay"></div>
    <div class="fixed inset-0 bg-[radial-gradient(circle_at_bottom_left,_var(--tw-gradient-stops))] from-[#8D6E63]/[0.05] via-[#FDFBF7]/0 to-transparent pointer-events-none z-[-1]"></div>

    <!-- Editorial Sidebar -->
    <aside class="w-72 bg-[#FDFBF7] border-r border-[#2D2420]/10 flex flex-col justify-between shrink-0 hidden lg:flex sticky top-0 h-screen z-40">
        <div class="p-8 space-y-12">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 group">
                <div class="w-10 h-10 rounded-full bg-[#FAF7F2] border border-[#2D2420]/10 flex items-center justify-center group-hover:bg-[#2D2420]/5 awwwards-transition shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
                    <i class="ph ph-shield-check text-[#4E342E] text-xl"></i>
                </div>
                <div>
                    <span class="font-editorial font-semibold text-lg tracking-wide text-[#2D2420] block leading-tight">Admin<br><span class="text-[#2D2420]/50 text-xs font-sans tracking-widest uppercase">Bagelan Coffee</span></span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="space-y-1.5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#2D2420] text-[#FDFBF7] shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]' : 'text-[#2D2420]/60 hover:text-[#2D2420] hover:bg-[#2D2420]/5 border border-transparent' }}">
                    <i class="ph ph-squares-four text-lg"></i>
                    <span class="text-[11px] font-semibold uppercase tracking-widest">Dashboard</span>
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-colors {{ request()->routeIs('admin.products*') ? 'bg-[#2D2420] text-[#FDFBF7] shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]' : 'text-[#2D2420]/60 hover:text-[#2D2420] hover:bg-[#2D2420]/5 border border-transparent' }}">
                    <i class="ph ph-coffee text-lg"></i>
                    <span class="text-[11px] font-semibold uppercase tracking-widest">Katalog Produk</span>
                </a>
                <a href="{{ route('admin.orders') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-colors {{ request()->routeIs('admin.orders*') ? 'bg-[#2D2420] text-[#FDFBF7] shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]' : 'text-[#2D2420]/60 hover:text-[#2D2420] hover:bg-[#2D2420]/5 border border-transparent' }}">
                    <i class="ph ph-receipt text-lg"></i>
                    <span class="text-[11px] font-semibold uppercase tracking-widest">Manajemen Pesanan</span>
                </a>
                <a href="{{ route('admin.outlets') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-colors {{ request()->routeIs('admin.outlets*') ? 'bg-[#2D2420] text-[#FDFBF7] shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]' : 'text-[#2D2420]/60 hover:text-[#2D2420] hover:bg-[#2D2420]/5 border border-transparent' }}">
                    <i class="ph ph-storefront text-lg"></i>
                    <span class="text-[11px] font-semibold uppercase tracking-widest">Arsitektur Outlet</span>
                </a>
                <a href="{{ route('kasir.pos') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-colors text-[#2D2420]/60 hover:text-[#2D2420] hover:bg-[#2D2420]/5 border border-transparent mt-4 bg-[#8D6E63]/10">
                    <i class="ph ph-terminal-window text-lg"></i>
                    <span class="text-[11px] font-semibold uppercase tracking-widest">Akses Kasir POS</span>
                </a>
            </nav>
        </div>

        <div class="p-8 border-t border-[#2D2420]/10">
            <a href="{{ route('home') }}" class="w-full flex items-center justify-center gap-3 bg-[#FAF7F2] hover:bg-[#2D2420]/5 text-[#2D2420]/60 hover:text-[#2D2420] text-[10px] font-semibold uppercase tracking-[0.2em] py-4 rounded-2xl border border-[#2D2420]/10 shadow-[inset_0_1px_1px_rgba(255,255,255,0.5)] awwwards-transition active:scale-[0.98]">
                <i class="ph ph-arrow-left text-sm"></i>
                <span>Portal Publik</span>
            </a>
        </div>
    </aside>

    <!-- Main Workspace -->
    <div class="flex-grow flex flex-col min-w-0 z-10 w-full">
        
        <header class="h-24 border-b border-[#2D2420]/5 flex items-center justify-between px-8 sm:px-12 sticky top-0 z-30 bg-[#FDFBF7]/80 backdrop-blur-xl">
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-semibold text-[#2D2420]/40 uppercase tracking-[0.3em] hidden sm:inline">Pusat Kendali</span>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 bg-[#FAF7F2] pl-5 pr-2 py-2 rounded-full border border-[#2D2420]/10 shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
                    <div class="text-right hidden sm:block">
                        <span class="font-semibold text-[#2D2420] block text-[11px] leading-tight">{{ Auth::user()->name }}</span>
                        <span class="text-[9px] text-[#4E342E] uppercase tracking-widest">System Admin</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="w-10 h-10 rounded-full bg-[#2D2420]/5 hover:bg-[#2D2420] flex items-center justify-center text-[#2D2420] hover:text-[#FDFBF7] awwwards-transition group" title="Keluar">
                            <i class="ph ph-sign-out text-sm group-hover:translate-x-0.5 awwwards-transition"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        @if(session('success'))
            <div id="flash-toast" class="fixed top-28 right-12 z-50 flex items-center gap-4 bg-[#2D2420] text-[#FDFBF7] px-6 py-4 rounded-2xl shadow-[0_20px_40px_rgba(45,36,32,0.2)] text-[11px] font-semibold uppercase tracking-widest awwwards-transition">
                <i class="ph ph-check-circle text-lg text-emerald-400"></i>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-2 text-[#FDFBF7]/50 hover:text-[#FDFBF7]"><i class="ph ph-x"></i></button>
            </div>
        @endif

        <main class="p-8 md:p-12 lg:p-16 flex-grow pb-32">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
