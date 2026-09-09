<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kopi Gacoan - Elite Aesthetic')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons (Mandated for Awwwards-tier) -->
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
<body class="antialiased min-h-[100dvh] flex flex-col selection:bg-white selection:text-black">
    <div class="grain-overlay"></div>
    <div class="fixed inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#FF2E63]/[0.03] via-[#050505]/0 to-transparent pointer-events-none z-[-1]"></div>

    @include('components.navbar')

    <main class="flex-grow pt-32 pb-40">
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
</body>
</html>
