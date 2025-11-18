@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold">Daftar Transaksi</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola semua transaksi laundry Anda</p>
    </div>
    <a href="{{ route('transaksi.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">+ Transaksi Baru</a>
</div>

<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-slate-50 to-blue-50 border-b border-slate-200">
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Kode</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Pelanggan</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Layanan</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Berat</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Total</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-slate-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($transaksis as $t)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-mono font-semibold text-blue-600">{{ $t->kode }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-900">{{ $t->pelanggan->nama }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-slate-700">{{ $t->layanan->nama }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-slate-700">{{ $t->berat }} Kg</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-slate-900">Rp {{ number_format($t->total,0,',','.') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            @if($t->status === 'selesai') bg-green-100 text-green-700
                            @elseif($t->status === 'proses') bg-blue-100 text-blue-700
                            @else bg-yellow-100 text-yellow-700
                            @endif">
                            {{ ucfirst($t->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center">
                            <a href="{{ route('transaksi.edit',$t) }}" class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-700 rounded-md hover:bg-amber-200 transition text-sm font-medium">Ubah</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                        Belum ada transaksi — <a href="{{ route('transaksi.create') }}" class="text-blue-600 hover:underline">buat transaksi baru</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($transaksis->hasPages())
    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
        {{ $transaksis->links() }}
    </div>
    @endif
</div>
@endsection
