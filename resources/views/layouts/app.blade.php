<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'OneDry System' }}</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Sidebar animation styles -->
    <style>
        .nav-link {
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: rgb(37, 99, 235);
            border-radius: 0 4px 4px 0;
            transform: scaleY(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-link.active::before {
            transform: scaleY(1);
        }
        .nav-link:hover {
            transform: translateX(4px);
        }
        .nav-link.active {
            background-color: rgb(239, 246, 255);
            color: rgb(37, 99, 235);
            font-weight: 500;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-72 bg-white shadow-lg flex flex-col border-r border-slate-200">

        <!-- Logo Ganti Text -->
        <div class="p-6 border-b border-slate-100 flex flex-col items-center bg-gradient-to-b from-blue-50 to-white">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="w-20 h-20 object-contain">
            <p class="text-sm text-slate-600 mt-2 font-medium">Sistem Laundry</p>
            <div class="mt-3 inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-semibold">
                {{ auth()->user()->role === 'admin' ? 'Admin' : 'Pemilik' }}
            </div>
        </div>

        <nav class="p-3 space-y-2 flex-1">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} block px-4 py-2.5 rounded-lg text-slate-700 hover:bg-blue-50 transition-all">🏠 Dashboard</a>

            {{-- Menu hanya untuk Admin --}}
            @if(auth()->check() && auth()->user()->isAdmin())
                <div class="pt-2">
                    <div class="px-4 py-1.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Operasional</div>
                    <a href="{{ route('pelanggan.index') }}" class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }} block px-4 py-2.5 rounded-lg text-slate-700 hover:bg-blue-50 transition-all">👥 Pelanggan</a>
                    <a href="{{ route('layanan.index') }}" class="nav-link {{ request()->routeIs('layanan.*') ? 'active' : '' }} block px-4 py-2.5 rounded-lg text-slate-700 hover:bg-blue-50 transition-all">⚙️ Layanan</a>
                    <a href="{{ route('transaksi.index') }}" class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }} block px-4 py-2.5 rounded-lg text-slate-700 hover:bg-blue-50 transition-all">💸 Transaksi</a>
                </div>
            @endif

            {{-- Menu hanya untuk Owner --}}
            @if(auth()->check() && auth()->user()->isOwner())
                <div class="pt-2">
                    <div class="px-4 py-1.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Bisnis</div>
                    <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }} block px-4 py-2.5 rounded-lg text-slate-700 hover:bg-blue-50 transition-all">📊 Laporan</a>
                    <a href="{{ route('pengaturan.index') }}" class="nav-link {{ request()->routeIs('pengaturan.*') ? 'active' : '' }} block px-4 py-2.5 rounded-lg text-slate-700 hover:bg-blue-50 transition-all">🧑‍💼 Pengaturan</a>
                </div>
            @endif

            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }} block px-4 py-2.5 rounded-lg text-slate-700 hover:bg-blue-50 font-medium transition-all">
                👤 Profil Saya
            </a>
        </nav>

        <div class="p-4 border-t border-slate-100 bg-slate-50">
            <div class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-2">Akun</div>
            <div class="text-sm text-slate-700 mb-3 px-1">
                <span class="font-semibold">{{ auth()->user()->name }}</span>
                <div class="text-xs text-slate-500 mt-0.5">{{ auth()->user()->email }}</div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="w-full px-4 py-2.5 bg-red-500 text-white rounded-md shadow-sm hover:bg-red-600 transition-all font-medium text-sm">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                @yield('content')
            </div>
        </div>
    </main>

</div>

</body>
</html>
