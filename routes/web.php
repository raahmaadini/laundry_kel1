<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaturanController;

Route::get('/', function(){ return redirect()->route('dashboard'); });

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::middleware(['role:admin'])->group(function(){
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('transaksi', TransaksiController::class)->except(['show']);
    });

    Route::middleware(['role:admin,owner'])->group(function(){
        Route::resource('layanan', LayananController::class)->except(['show']);
        Route::get('/laporan', [LaporanController::class,'index'])->name('laporan.index');
        Route::get('/laporan/export-pdf', [LaporanController::class,'exportPdf'])->name('laporan.pdf');
        Route::get('/laporan/export-excel', [LaporanController::class,'exportExcel'])->name('laporan.excel');
    });

    Route::middleware(['role:owner'])->group(function(){
        Route::get('/pengaturan', [PengaturanController::class,'index'])->name('pengaturan.index');
    });
});
