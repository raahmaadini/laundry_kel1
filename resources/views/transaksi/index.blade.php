@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Transaksi</h1>
    <a href="{{ route('transaksi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Transaksi Baru</a>
</div>

<div class="bg-white p-4 rounded shadow">
    <table class="w-full">
        <thead><tr><th>Kode</th><th>Pelanggan</th><th>Layanan</th><th>Berat</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach($transaksis as $t)
            <tr class="border-t">
                <td class="p-2">{{ $t->kode }}</td>
                <td class="p-2">{{ $t->pelanggan->nama }}</td>
                <td class="p-2">{{ $t->layanan->nama }}</td>
                <td class="p-2">{{ $t->berat }} Kg</td>
                <td class="p-2">Rp {{ number_format($t->total,0,',','.') }}</td>
                <td class="p-2">{{ ucfirst($t->status) }}</td>
                <td class="p-2">
                    <a href="{{ route('transaksi.edit',$t) }}" class="text-yellow-600">Ubah Status</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $transaksis->links() }}</div>
</div>
@endsection
