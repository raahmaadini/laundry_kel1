<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'OneDry System' }}</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-72 bg-white shadow-md flex flex-col">

        <!-- Logo Ganti Text -->
        <div class="p-6 border-b flex flex-col items-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="w-20 h-20 object-contain">
            <p class="text-sm text-gray-500 mt-2">Sistem Laundry</p>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🏠 Dashboard</a>
            <a href="{{ route('pelanggan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">👥 Pelanggan</a>
            <a href="{{ route('layanan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">⚙️ Layanan</a>
            <a href="{{ route('transaksi.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">💸 Transaksi</a>
            <a href="{{ route('laporan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">📊 Laporan</a>

            @if(auth()->user()->role == 'owner')
                <a href="{{ route('pengaturan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">🧑‍💼 Pengaturan</a>
            @endif

            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded hover:bg-gray-100 text-blue-600 font-semibold">
                👤 Profil Saya
            </a>
        </nav>

        <div class="mt-auto p-4 border-t">
            <div class="text-sm text-gray-600 mb-2">Logged in as: {{ auth()->user()->name }}</div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-500 text-white w-full py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
