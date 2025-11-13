@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-600">Total Pelanggan</h3>
        <div class="text-4xl font-bold mt-3">{{ $totalPelanggan }}</div>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-600">Transaksi Hari Ini</h3>
        <div class="text-4xl font-bold mt-3">{{ $transaksiHariIni }}</div>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-600">Pendapatan Mingguan</h3>
        <div class="text-3xl font-semibold mt-3">Rp {{ number_format($pendapatanMingguan,0,',','.') }}</div>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-600">Pendapatan Bulanan</h3>
        <div class="text-3xl font-semibold mt-3">Rp {{ number_format($pendapatanBulanan,0,',','.') }}</div>
    </div>
</div>
@endsection
