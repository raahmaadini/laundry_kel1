@extends('layouts.app')
@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Edit Layanan</h1>
    <p class="text-sm text-slate-500 mt-1">Update informasi layanan: {{ $layanan->nama }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="lg:col-span-2">
        <form action="{{ route('layanan.update', $layanan) }}" method="POST" class="bg-white rounded-2xl shadow-md p-8">
            @csrf 
            @method('PUT')

            <div class="space-y-5">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Layanan</label>
                    <input type="text" name="nama" value="{{ $layanan->nama }}" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" placeholder="Contoh: Cuci Biasa" required>
                    @error('nama')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- Tipe -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tipe Layanan</label>
                    <select name="tipe" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="per_kg" {{ $layanan->tipe === 'per_kg' ? 'selected' : '' }}>Per Kilogram</option>
                        <option value="per_item" {{ $layanan->tipe === 'per_item' ? 'selected' : '' }}>Per Item</option>
                    </select>
                    @error('tipe')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Harga</label>
                    <div class="relative">
                        <span class="absolute left-4 top-2.5 text-slate-500 font-semibold">Rp</span>
                        <input type="number" name="harga" value="{{ $layanan->harga }}" class="w-full pl-12 pr-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" placeholder="0" step="0.01" required>
                    </div>
                    @error('harga')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mt-8 pt-6 border-t border-slate-200">
                <button type="submit" class="flex-1 px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-sm">
                    Update Layanan
                </button>
                <a href="{{ route('layanan.index') }}" class="flex-1 px-6 py-2.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition font-semibold text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Info Box -->
    <div class="lg:col-span-1">
        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-md p-6 sticky top-8">
            <h3 class="font-semibold text-slate-900 mb-3">📊 Informasi</h3>
            <ul class="text-sm text-slate-700 space-y-2">
                <li><strong>Dibuat:</strong> {{ $layanan->created_at->format('d/m/Y') }}</li>
                <li><strong>Tipe:</strong> {{ ucfirst(str_replace('_', ' ', $layanan->tipe)) }}</li>
                <li><strong>Harga Saat Ini:</strong> Rp {{ number_format($layanan->harga, 0, ',', '.') }}</li>
            </ul>
        </div>
    </div>
</div>

@endsection
