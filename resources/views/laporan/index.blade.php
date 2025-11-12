@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Laporan</h1>
    <div>
        <a href="{{ route('laporan.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded mr-2">Export PDF</a>
        <a href="{{ route('laporan.excel') }}" class="bg-green-600 text-white px-4 py-2 rounded">Export Excel</a>
    </div>
</div>

<div class="bg-white p-4 rounded shadow">
    <table class="w-full">
        <thead><tr><th>Kode</th><th>Pelanggan</th><th>Layanan</th><th>Total</th><th>Status</th><th>Tanggal</th></tr></thead>
        <tbody>
            @foreach($transaksis as $t)
            <tr class="border-t">
                <td class="p-2">{{ $t->kode }}</td>
                <td class="p-2">{{ $t->pelanggan->nama }}</td>
                <td class="p-2">{{ $t->layanan->nama }}</td>
                <td class="p-2">Rp {{ number_format($t->total,0,',','.') }}</td>
                <td class="p-2">{{ ucfirst($t->status) }}</td>
                <td class="p-2">{{ $t->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
