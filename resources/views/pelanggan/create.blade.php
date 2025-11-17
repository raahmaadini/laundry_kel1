@extends('layouts.app')
@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Tambah Pelanggan Baru</h1>
    <p class="text-sm text-slate-500 mt-1">Isi data lengkap untuk menambah pelanggan ke sistem</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="lg:col-span-2">
        <form action="{{ route('pelanggan.store') }}" method="POST" class="bg-white rounded-2xl shadow-md p-8">
            @csrf

            <div class="space-y-5">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" placeholder="Contoh: Budi Santoso" required>
                    @error('nama')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">No HP</label>
                    <input type="text" name="no_hp" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" placeholder="Contoh: 081234567890" required>
                    @error('no_hp')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat</label>
                    <textarea name="alamat" rows="4" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" placeholder="Masukkan alamat lengkap pelanggan" required></textarea>
                    @error('alamat')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mt-8 pt-6 border-t border-slate-200">
                <button type="submit" class="flex-1 px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-sm">
                    Simpan Pelanggan
                </button>
                <a href="{{ route('pelanggan.index') }}" class="flex-1 px-6 py-2.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition font-semibold text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Info Box -->
    <div class="lg:col-span-1">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-md p-6 sticky top-8">
            <h3 class="font-semibold text-slate-900 mb-3">💡 Tips</h3>
            <ul class="text-sm text-slate-700 space-y-2">
                <li>• Pastikan nama pelanggan jelas dan mudah dikenal</li>
                <li>• Gunakan nomor HP yang dapat dihubungi</li>
                <li>• Alamat lengkap memudahkan pengiriman & penjemputan</li>
            </ul>
        </div>
    </div>
</div>

@endsection
