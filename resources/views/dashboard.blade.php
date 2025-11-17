@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold">Dashboard</h1>
            <p class="text-sm text-slate-500 mt-1">Ringkasan singkat kinerja laundry Anda</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('transaksi.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">+ Transaksi Baru</a>
            <a href="{{ route('pelanggan.create') }}" class="inline-flex items-center px-4 py-2 bg-white border rounded-md shadow-sm hover:shadow-md transition">+ Pelanggan</a>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-2xl shadow p-5 transform hover:-translate-y-1 transition">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white shadow">👥</div>
                <div class="ms-4">
                    <div class="text-sm text-slate-500">Total Pelanggan</div>
                    <div class="text-2xl font-bold"><span class="counter" data-target="{{ $totalPelanggan }}">0</span></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 transform hover:-translate-y-1 transition">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-teal-400 to-sky-500 flex items-center justify-center text-white shadow">💸</div>
                <div class="ms-4">
                    <div class="text-sm text-slate-500">Transaksi Hari Ini</div>
                    <div class="text-2xl font-bold"><span class="counter" data-target="{{ $transaksiHariIni }}">0</span></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 transform hover:-translate-y-1 transition">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-emerald-400 to-green-600 flex items-center justify-center text-white shadow">📈</div>
                <div class="ms-4">
                    <div class="text-sm text-slate-500">Pendapatan Mingguan</div>
                    <div class="text-2xl font-bold">Rp <span class="counter" data-target="{{ $pendapatanMingguan }}">0</span></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 transform hover:-translate-y-1 transition">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white shadow">📅</div>
                <div class="ms-4">
                    <div class="text-sm text-slate-500">Pendapatan Bulanan</div>
                    <div class="text-2xl font-bold">Rp <span class="counter" data-target="{{ $pendapatanBulanan }}">0</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content: recent transactions or placeholder -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Transaksi Terbaru</h3>
            @if(isset($latestTransaksis) && count($latestTransaksis))
                <div class="divide-y">
                    @foreach($latestTransaksis as $t)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <div class="font-medium">{{ $t->kode ?? ('#' . $t->id) }}</div>
                                <div class="text-sm text-slate-500">{{ $t->pelanggan->nama ?? 'Pelanggan' }} • {{ $t->status }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-semibold">Rp {{ number_format($t->total ?? 0,0,',','.') }}</div>
                                <div class="text-sm text-slate-400">{{ $t->created_at->format('d M H:i') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-slate-500 py-12">
                    Belum ada transaksi terbaru — buat transaksi baru untuk melihat ringkasan di sini.
                </div>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Revenue 7 Hari Terakhir</h3>
            <div style="position: relative; height: 200px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="bg-white rounded-2xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold mb-4">Cepat Aksi</h3>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('transaksi.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">+ Buat Transaksi</a>
            <a href="{{ route('pelanggan.create') }}" class="inline-flex items-center px-4 py-2 bg-white border rounded-md shadow-sm hover:shadow-md transition">+ Tambah Pelanggan</a>
            <a href="{{ route('layanan.index') }}" class="inline-flex items-center px-4 py-2 bg-white border rounded-md shadow-sm hover:shadow-md transition">Kelola Layanan</a>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Counter animation + Revenue chart script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Counter animation
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const isCurrency = counter.parentElement.textContent.trim().startsWith('Rp');
                let duration = 900;
                let start = 0;
                const stepTime = Math.max(Math.floor(duration / (target || 1)), 20);
                const formatter = new Intl.NumberFormat('id-ID');
                const timer = setInterval(() => {
                    start += Math.ceil(target / (duration / stepTime));
                    if (start >= target) {
                        start = target;
                        clearInterval(timer);
                    }
                    counter.textContent = isCurrency ? formatter.format(start) : formatter.format(start);
                }, stepTime);
            });

            // Revenue chart
            const ctx = document.getElementById('revenueChart');
            if (ctx) {
                const data = {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: [
                            {{ isset($dailyRevenue) && isset($dailyRevenue[0]) ? $dailyRevenue[0] : '250000' }},
                            {{ isset($dailyRevenue) && isset($dailyRevenue[1]) ? $dailyRevenue[1] : '480000' }},
                            {{ isset($dailyRevenue) && isset($dailyRevenue[2]) ? $dailyRevenue[2] : '320000' }},
                            {{ isset($dailyRevenue) && isset($dailyRevenue[3]) ? $dailyRevenue[3] : '550000' }},
                            {{ isset($dailyRevenue) && isset($dailyRevenue[4]) ? $dailyRevenue[4] : '420000' }},
                            {{ isset($dailyRevenue) && isset($dailyRevenue[5]) ? $dailyRevenue[5] : '680000' }},
                            {{ isset($dailyRevenue) && isset($dailyRevenue[6]) ? $dailyRevenue[6] : '750000' }}
                        ],
                        borderColor: 'rgb(37, 99, 235)',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgb(37, 99, 235)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                };

                new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>

@endsection
