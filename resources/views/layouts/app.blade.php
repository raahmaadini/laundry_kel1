<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OneDry - Sistem Laundry</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
<div class="flex min-h-screen">
    <aside class="w-72 bg-white shadow-md">
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold">🧺 OneDry</h1>
            <p class="text-sm text-gray-500">Sistem Laundry</p>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-100">🏠 Dashboard</a>
            <a href="{{ route('pelanggan.index') }}" class="block py-2 px-4 rounded hover:bg-gray-100">👥 Pelanggan</a>
            <a href="{{ route('layanan.index') }}" class="block py-2 px-4 rounded hover:bg-gray-100">⚙️ Layanan</a>
            <a href="{{ route('transaksi.index') }}" class="block py-2 px-4 rounded hover:bg-gray-100">💸 Transaksi</a>
            <a href="{{ route('laporan.index') }}" class="block py-2 px-4 rounded hover:bg-gray-100">📊 Laporan</a>
            @if(auth()->user()->role == 'owner')
                <a href="{{ route('pengaturan.index') }}" class="block py-2 px-4 rounded hover:bg-gray-100">🧑‍💼 Pengaturan</a>
            @endif
        </nav>

        <div class="mt-auto p-4 border-t">
            <div class="text-sm text-gray-600 mb-2">Logged in as: {{ auth()->user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded">Logout</button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 mb-4 rounded">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>
