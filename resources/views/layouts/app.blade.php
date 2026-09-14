<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bagelan Coffee - Mahakarya Nusantara')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons (Mandated for Awwwards-tier) -->
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
            background-color: #FDFBF7; /* Light cream */
            color: #2D2420; /* Dark espresso text */
        }
        .font-editorial {
            font-family: 'Playfair Display', serif;
        }
        .awwwards-transition {
            transition: all 700ms cubic-bezier(0.32, 0.72, 0, 1);
        }
        
        /* Smooth Scrollbar for horizontal scrolling */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="antialiased min-h-[100dvh] flex flex-col selection:bg-[#4E342E] selection:text-[#FDFBF7]">
    <div class="grain-overlay"></div>
    <div class="fixed inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#8D6E63]/[0.08] via-[#FDFBF7]/0 to-transparent pointer-events-none z-[-1]"></div>

    <x-ui.navbar-5 />

    <main class="flex-grow pt-32 pb-40 opacity-0 translate-y-4" id="page-content" style="animation: pageEnter 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;">
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Lenis Smooth Scroll -->
    <style>
        html.lenis, html.lenis body {
            height: auto;
        }
        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }
        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }
        .lenis.lenis-stopped {
            overflow: hidden;
        }
        .lenis.lenis-smooth iframe {
            pointer-events: none;
        }
        
        @keyframes pageEnter {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
    <script>
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // Add smooth scrolling to anchor links manually if needed
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                lenis.scrollTo(this.getAttribute('href'));
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
