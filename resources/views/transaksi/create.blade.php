@extends('layouts.app')
@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Tambah Transaksi Baru</h1>
    <p class="text-sm text-slate-500 mt-1">Buat transaksi cucian baru untuk pelanggan</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="lg:col-span-2">
        <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-md p-8">
            @csrf

            <div class="space-y-5">
                <!-- Pelanggan -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Pelanggan</label>
                    <select name="pelanggan_id" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                    @error('pelanggan_id')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- Layanan -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Layanan</label>
                    <select name="layanan_id" id="layananSelect" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($layanans as $l)
                            <option value="{{ $l->id }}" data-harga="{{ $l->harga }}">{{ $l->nama }} - Rp {{ number_format($l->harga,0,',','.') }}/kg</option>
                        @endforeach
                    </select>
                    @error('layanan_id')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- Berat -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Berat Cucian (Kg)</label>
                    <input type="number" step="0.1" name="berat" id="beratInput" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" placeholder="Contoh: 5.5" required>
                    @error('berat')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <!-- Foto -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Cucian (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" />
                    @error('foto')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Perkiraan Total -->
            <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-200">
                <p class="text-sm text-slate-600 mb-1">Perkiraan Total Biaya:</p>
                <p id="perkiraan" class="text-2xl font-bold text-blue-600">Rp 0</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mt-8 pt-6 border-t border-slate-200">
                <button type="submit" class="flex-1 px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-sm">
                    Simpan Transaksi
                </button>
                <a href="{{ route('transaksi.index') }}" class="flex-1 px-6 py-2.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition font-semibold text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Info Box -->
    <div class="lg:col-span-1">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-md p-6 sticky top-8">
            <h3 class="font-semibold text-slate-900 mb-3">💡 Cara Mengisi</h3>
            <ol class="text-sm text-slate-700 space-y-2 list-decimal list-inside">
                <li>Pilih pelanggan dari daftar</li>
                <li>Pilih jenis layanan cucian</li>
                <li>Masukkan berat cucian</li>
                <li>Total akan dihitung otomatis</li>
                <li>Foto bersifat opsional</li>
            </ol>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const layananSelect = document.getElementById('layananSelect');
    const beratInput = document.getElementById('beratInput');
    const perkiraan = document.getElementById('perkiraan');

    function hitung() {
        const selected = layananSelect.options[layananSelect.selectedIndex];
        const harga = parseFloat(selected.dataset.harga || 0);
        const berat = parseFloat(beratInput.value || 0);
        const total = harga * berat;
        perkiraan.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total.toFixed(0));
    }

    layananSelect.addEventListener('change', hitung);
    beratInput.addEventListener('input', hitung);
});
</script>
@endsection
