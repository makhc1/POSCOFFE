<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Kopi Gacoan')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .grain-overlay {
            position: fixed;
            inset: 0;
            z-index: 50;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #050505;
            color: #FAFAFA;
        }
        .awwwards-transition {
            transition: all 700ms cubic-bezier(0.32, 0.72, 0, 1);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex selection:bg-white selection:text-black">
    <div class="grain-overlay"></div>
    <div class="fixed inset-0 bg-[radial-gradient(circle_at_bottom_left,_var(--tw-gradient-stops))] from-[#FF2E63]/[0.02] via-[#050505]/0 to-transparent pointer-events-none z-[-1]"></div>

    <!-- Ethereal Sidebar -->
    <aside class="w-72 bg-[#050505]/80 backdrop-blur-3xl border-r border-white/5 flex flex-col justify-between shrink-0 hidden lg:flex sticky top-0 h-screen z-40 shadow-[4px_0_30px_rgba(0,0,0,0.5)]">
        <div class="p-8 space-y-12">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 group">
                <div class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-white/10 awwwards-transition shadow-[inset_0_1px_1px_rgba(255,255,255,0.1)]">
                    <i class="ph ph-shield-check text-[#FF2E63] text-xl"></i>
                </div>
                <div>
                    <span class="font-display font-semibold text-[13px] tracking-widest text-white uppercase block">Gacoan <span class="text-[#FF2E63]">Admin</span></span>
                    <span class="text-[9px] text-white/40 uppercase tracking-[0.2em] font-medium">Core Command</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white border border-white/10 shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)]' : 'text-white/50 hover:text-white hover:bg-white/5 border border-transparent' }}">
                    <i class="ph ph-squares-four text-lg"></i>
                    <span class="text-[11px] font-semibold uppercase tracking-widest">Dashboard</span>
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-colors {{ request()->routeIs('admin.products*') ? 'bg-white/10 text-white border border-white/10 shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)]' : 'text-white/50 hover:text-white hover:bg-white/5 border border-transparent' }}">
                    <i class="ph ph-coffee text-lg"></i>
                    <span class="text-[11px] font-semibold uppercase tracking-widest">Katalog Produk</span>
                </a>
                <a href="{{ route('admin.orders') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-colors {{ request()->routeIs('admin.orders*') ? 'bg-white/10 text-white border border-white/10 shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)]' : 'text-white/50 hover:text-white hover:bg-white/5 border border-transparent' }}">
                    <i class="ph ph-receipt text-lg"></i>
                    <span class="text-[11px] font-semibold uppercase tracking-widest">Manajemen Pesanan</span>
                </a>
                <a href="{{ route('admin.outlets') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-colors {{ request()->routeIs('admin.outlets*') ? 'bg-white/10 text-white border border-white/10 shadow-[inset_0_1px_1px_rgba(255,255,255,0.05)]' : 'text-white/50 hover:text-white hover:bg-white/5 border border-transparent' }}">
                    <i class="ph ph-storefront text-lg"></i>
                    <span class="text-[11px] font-semibold uppercase tracking-widest">Arsitektur Outlet</span>
                </a>
            </nav>
        </div>

        <div class="p-8 border-t border-white/5">
            <a href="{{ route('home') }}" class="w-full flex items-center justify-center gap-3 bg-[#0A0A0A] hover:bg-white/10 text-white/50 hover:text-white text-[10px] font-semibold uppercase tracking-[0.2em] py-4 rounded-2xl border border-white/5 shadow-[inset_0_1px_1px_rgba(255,255,255,0.02)] awwwards-transition active:scale-[0.98]">
                <i class="ph ph-arrow-left text-sm"></i>
                <span>Portal Publik</span>
            </a>
        </div>
    </aside>

    <!-- Main Workspace -->
    <div class="flex-grow flex flex-col min-w-0 z-10">
        
        <header class="h-20 bg-[#050505]/80 backdrop-blur-3xl border-b border-white/5 flex items-center justify-between px-8 sm:px-12 sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-semibold text-white/40 uppercase tracking-[0.3em] hidden sm:inline">Gacoan Control Center</span>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 bg-[#0A0A0A] pl-4 pr-2 py-2 rounded-full border border-white/5 shadow-[inset_0_1px_1px_rgba(255,255,255,0.02)]">
                    <div class="text-right hidden sm:block">
                        <span class="font-semibold text-white block text-[11px] leading-tight">{{ Auth::user()->name }}</span>
                        <span class="text-[9px] text-[#FF2E63] uppercase tracking-widest">System Admin</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="w-8 h-8 rounded-full bg-white/10 hover:bg-red-500/20 flex items-center justify-center text-white hover:text-red-400 awwwards-transition" title="Keluar">
                            <i class="ph ph-sign-out text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        @if(session('success'))
            <div id="flash-toast" class="fixed top-24 right-8 z-50 flex items-center gap-4 bg-white text-black px-6 py-4 rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.2)] text-[11px] font-semibold uppercase tracking-widest awwwards-transition">
                <i class="ph ph-check-circle text-lg text-green-600"></i>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-2 text-gray-400 hover:text-black"><i class="ph ph-x"></i></button>
            </div>
        @endif

        <main class="p-8 md:p-12 lg:p-16 flex-grow">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
