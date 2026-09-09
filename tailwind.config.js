/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    primary: '#FF2E63', // Signature Gacoan Magenta/Pink
                    secondary: '#FF9900', // Energetic Sunset Amber / Orange
                    yellow: '#FFDE59', // Vibrant Accent Yellow
                    dark: '#121216', // Deep Roast Charcoal
                    darker: '#0A0A0C', // Deep Black
                    card: '#16161C', // Card background
                    border: '#2A2A30',
                    muted: '#8E8E93',
                    cream: '#FDFBF7',
                }
            },
            backgroundImage: {
                'radial-hero': 'radial-gradient(circle at 50% 20%, rgba(255, 46, 99, 0.18) 0%, rgba(255, 153, 0, 0.08) 35%, transparent 70%)',
                'gradient-brand': 'linear-gradient(135deg, #FF2E63 0%, #E01E53 50%, #FF9900 100%)',
            },
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                display: ['"Outfit"', '"Plus Jakarta Sans"', 'sans-serif'],
            },
            boxShadow: {
                'neon-pink': '0 0 25px -5px rgba(255, 46, 99, 0.5)',
                'neon-amber': '0 0 25px -5px rgba(255, 153, 0, 0.5)',
                'glow': '0 10px 30px -10px rgba(255, 46, 99, 0.3)',
            },
            animation: {
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'float': 'float 3s ease-in-out infinite',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-8px)' },
                }
            },
            transitionTimingFunction: {
                'awwwards': 'cubic-bezier(0.32, 0.72, 0, 1)',
            }
        },
    },
    plugins: [],
}
