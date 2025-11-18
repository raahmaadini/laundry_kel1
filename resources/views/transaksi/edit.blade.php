@extends('layouts.app')
@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Ubah Status Transaksi</h1>
    <p class="text-sm text-slate-500 mt-1">Update status transaksi #{{ $transaksi->id }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="lg:col-span-2">
        <form action="{{ route('transaksi.update', $transaksi) }}" method="POST" class="bg-white rounded-2xl shadow-md p-8">
            @csrf 
            @method('PUT')

            <div class="space-y-5">
                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status Transaksi</label>
                    <select name="status" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" required>
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" {{ $s == $transaksi->status ? 'selected' : '' }}>
                                @if($s === 'selesai')
                                    ✓ Selesai
                                @elseif($s === 'proses')
                                    ⏳ Sedang Diproses
                                @elseif($s === 'pending')
                                    ⏸ Menunggu
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('status')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mt-8 pt-6 border-t border-slate-200">
                <button type="submit" class="flex-1 px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-sm">
                    Update Status
                </button>
                <a href="{{ route('transaksi.index') }}" class="flex-1 px-6 py-2.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition font-semibold text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Info Box -->
    <div class="lg:col-span-1">
        <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl shadow-md p-6 sticky top-8">
            <h3 class="font-semibold text-slate-900 mb-3">📊 Detail Transaksi</h3>
            <ul class="text-sm text-slate-700 space-y-2">
                <li><strong>ID:</strong> #{{ $transaksi->id }}</li>
                <li><strong>Pelanggan:</strong> {{ $transaksi->pelanggan->nama }}</li>
                <li><strong>Layanan:</strong> {{ $transaksi->layanan->nama }}</li>
                <li><strong>Total:</strong> Rp {{ number_format($transaksi->total, 0, ',', '.') }}</li>
                <li><strong>Dibuat:</strong> {{ $transaksi->created_at->format('d/m/Y H:i') }}</li>
            </ul>
        </div>
    </div>
</div>

@endsection
