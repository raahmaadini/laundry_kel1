<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- REMOVE VITE → karena kamu tidak pakai npm -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

        <!-- Tambahkan TAILWIND CDN agar tampilan langsung rapi -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Decorative background styles (animated blobs + gradient) -->
        <style>
            .bg-blob {
                position: absolute;
                inset: 0;
                overflow: hidden;
                pointer-events: none;
                z-index: 1;
            }
            .blob {
                position: absolute;
                filter: blur(80px);
                opacity: 0.25;
                transform-origin: center;
                will-change: transform;
            }
            @keyframes float-slow {
                0% { transform: translateY(0px) translateX(0px) scale(1); }
                50% { transform: translateY(-18px) translateX(12px) scale(1.05); }
                100% { transform: translateY(0px) translateX(0px) scale(1); }
            }
            .float-1 { animation: float-slow 18s ease-in-out infinite; }
            .float-2 { animation: float-slow 22s ease-in-out infinite reverse; }

            /* animated gradient layer under blobs */
            .animated-gradient {
                position: absolute;
                inset: 0;
                z-index: 0;
                pointer-events: none;
                background: linear-gradient(120deg, rgba(99,102,241,0.06), rgba(14,165,233,0.04), rgba(59,130,246,0.04));
                background-size: 300% 300%;
                mix-blend-mode: multiply;
                animation: gradientShift 12s ease infinite;
            }

            @keyframes gradientShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            /* logo float animation */
            @keyframes logoFloat {
                0% { transform: translateY(0); }
                50% { transform: translateY(-8px); }
                100% { transform: translateY(0); }
            }
            .logo-float { animation: logoFloat 6s ease-in-out infinite; }

            /* card entrance animation */
            @keyframes cardIn { from { opacity: 0; transform: translateY(12px) scale(.995); } to { opacity: 1; transform: translateY(0) scale(1); } }
            .animate-card-in { animation: cardIn .6s cubic-bezier(.2,.8,.2,1) forwards; }

            /* respect prefers-reduced-motion */
            @media (prefers-reduced-motion: reduce) {
                .float-1, .float-2, .logo-float, .animate-card-in, .animated-gradient { animation: none !important; }
            }
        </style>
    </head>


    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 via-white to-sky-50 min-h-screen relative">

    <!-- Animated gradient layer + Decorative SVG blobs behind content -->
    <div class="animated-gradient" aria-hidden="true"></div>
    <div class="bg-blob" aria-hidden="true">
            <svg class="blob float-1" width="600" height="600" viewBox="0 0 600 600" style="left:-140px;top:-80px;">
                <defs>
                    <linearGradient id="g1" x1="0%" x2="100%" y1="0%" y2="100%">
                        <stop offset="0%" stop-color="#60A5FA" />
                        <stop offset="100%" stop-color="#3B82F6" />
                    </linearGradient>
                </defs>
                <g fill="url(#g1)">
                    <path d="M421.6,362.4Q387,474,269.5,511Q152,548,85.4,430.1Q18.9,312.1,92.4,210.4Q165.9,108.7,279.6,101.6Q393.3,94.5,437.9,205.3Q482.5,316,421.6,362.4Z" />
                </g>
            </svg>

            <svg class="blob float-2" width="500" height="500" viewBox="0 0 600 600" style="right:-120px;bottom:-100px;">
                <defs>
                    <linearGradient id="g2" x1="0%" x2="100%" y1="0%" y2="100%">
                        <stop offset="0%" stop-color="#7DD3FC" />
                        <stop offset="100%" stop-color="#0EA5E9" />
                    </linearGradient>
                </defs>
                <g fill="url(#g2)">
                    <path d="M470.8,351.1Q444,452.2,358.1,498.8Q272.2,545.4,180.4,495.2Q88.6,445,66.4,351.9Q44.2,258.9,109.6,183.8Q174.9,108.8,266.1,96.3Q357.3,83.9,424.9,158.5Q492.6,233.1,470.8,351.1Z" />
                </g>
            </svg>
        </div>

        <div class="min-h-screen flex items-center justify-center px-4 py-12 relative z-10">

            <div class="max-w-4xl w-full grid md:grid-cols-2 gap-8 items-center">

                <!-- Left: illustration / logo + intro -->
                <div class="hidden md:flex flex-col items-start justify-center px-6">
                    <a href="/" class="mb-6 inline-flex items-center">
                        <x-application-logo class="w-24 h-24 fill-current text-blue-600 logo-float" />
                        <span class="ms-3 text-2xl font-bold text-blue-700">OneDry</span>
                    </a>

                    <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Selamat datang di OneDry</h2>
                    <p class="text-slate-600">Kelola pelanggan, transaksi, dan laporan laundry Anda dengan mudah dan cepat.</p>
                </div>

                <!-- Right: card -->
                <div class="w-full sm:max-w-md mx-auto bg-white/90 backdrop-blur-sm shadow-xl rounded-2xl p-8 transform opacity-0 translate-y-6 animate-card-in">
                    {{ $slot }}
                </div>

            </div>

        </div>

    </body>
</html>
