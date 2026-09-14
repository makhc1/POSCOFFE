<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Terminal Kasir - Bagelan Coffee')</title>
    
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
<body class="antialiased h-[100dvh] flex flex-col selection:bg-[#2D2420] selection:text-[#FDFBF7] overflow-hidden">
    <div class="grain-overlay"></div>
    <div class="fixed inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-[#8D6E63]/[0.05] via-[#FDFBF7]/0 to-transparent pointer-events-none z-[-1]"></div>

    <header class="bg-[#FDFBF7]/80 backdrop-blur-2xl border-b border-[#2D2420]/5 px-6 py-4 flex items-center justify-between shrink-0 sticky top-0 z-40">
        <div class="flex items-center gap-8">
            <a href="{{ route('kasir.pos') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-full bg-[#FAF7F2] border border-[#2D2420]/10 flex items-center justify-center group-hover:bg-[#2D2420]/5 awwwards-transition shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
                    <i class="ph ph-desktop text-[#4E342E] text-xl"></i>
                </div>
                <div class="hidden sm:block">
                    <span class="font-editorial font-semibold text-lg tracking-wide text-[#2D2420] block leading-tight">Terminal<br><span class="text-[#2D2420]/50 text-xs font-sans tracking-widest uppercase">Kasir Bagelan</span></span>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-1 bg-[#FAF7F2] p-1.5 rounded-full border border-[#2D2420]/10 shadow-[inset_0_1px_1px_rgba(255,255,255,0.5)]">
                <a href="{{ route('kasir.pos') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-full text-[10px] font-semibold uppercase tracking-widest transition-colors {{ request()->routeIs('kasir.pos') ? 'bg-[#2D2420] text-[#FDFBF7] shadow-sm' : 'text-[#2D2420]/60 hover:text-[#2D2420] hover:bg-[#2D2420]/5' }}">
                    <i class="ph ph-terminal-window text-base"></i>
                    <span>Sistem POS</span>
                </a>

                <a href="{{ route('kasir.recap') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-full text-[10px] font-semibold uppercase tracking-widest transition-colors {{ request()->routeIs('kasir.recap') ? 'bg-[#2D2420] text-[#FDFBF7] shadow-sm' : 'text-[#2D2420]/60 hover:text-[#2D2420] hover:bg-[#2D2420]/5' }}">
                    <i class="ph ph-receipt text-base"></i>
                    <span>Rekapitulasi</span>
                </a>
            </nav>
        </div>

        <div class="flex items-center gap-4">
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="hidden lg:flex items-center justify-center h-10 px-5 rounded-full bg-[#FAF7F2] hover:bg-[#2D2420]/5 border border-[#2D2420]/10 text-[10px] font-semibold text-[#2D2420]/70 uppercase tracking-widest awwwards-transition group shadow-[inset_0_1px_1px_rgba(255,255,255,0.5)]">
                    <i class="ph ph-shield-check text-sm mr-2 text-[#4E342E]"></i>
                    Admin
                </a>
            @endif

            <a href="{{ route('home') }}" target="_blank" class="hidden md:flex items-center justify-center w-10 h-10 rounded-full bg-[#FAF7F2] hover:bg-[#2D2420]/5 border border-[#2D2420]/10 text-[#2D2420]/70 awwwards-transition shadow-[inset_0_1px_1px_rgba(255,255,255,0.5)]" title="Buka Toko Public">
                <i class="ph ph-storefront text-lg"></i>
            </a>

            <div class="flex items-center gap-3 bg-[#FAF7F2] pl-4 pr-1.5 py-1.5 rounded-full border border-[#2D2420]/10 shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)]">
                <div class="text-right hidden sm:block">
                    <span class="font-semibold text-[#2D2420] block text-[11px] leading-tight">{{ Auth::user()->name }}</span>
                    <span class="text-[9px] text-[#4E342E] uppercase tracking-widest">{{ Auth::user()->role }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="w-8 h-8 rounded-full bg-[#2D2420]/5 hover:bg-[#2D2420] flex items-center justify-center text-[#2D2420] hover:text-[#FDFBF7] awwwards-transition" title="Keluar">
                        <i class="ph ph-sign-out text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    @if(session('success'))
        <div id="flash-toast" class="fixed top-24 right-6 z-50 flex items-center gap-3 bg-[#2D2420] text-[#FDFBF7] px-5 py-3 rounded-2xl shadow-[0_10px_30px_rgba(45,36,32,0.2)] text-xs font-semibold awwwards-transition">
            <i class="ph ph-check-circle text-lg text-emerald-400"></i>
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="ml-2 text-[#FDFBF7]/50 hover:text-[#FDFBF7]"><i class="ph ph-x"></i></button>
        </div>
    @endif

    <main class="flex-grow flex flex-col min-h-0 relative z-10 p-4 sm:p-6 pb-0">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
