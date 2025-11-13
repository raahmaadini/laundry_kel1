<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProfileController;

Route::get('/', function(){ 
    return redirect()->route('dashboard'); 
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function(){

    // ===== Dashboard =====
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');


    // *****************************************************************
    // ⭐⭐ ROUTE PROFIL (WAJIB AGAR MENU PROFIL SAYA TIDAK ERROR) ⭐⭐
    // *****************************************************************
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // *****************************************************************


    // ===== Admin only =====
    Route::middleware(['role:admin'])->group(function(){
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('transaksi', TransaksiController::class)->except(['show']);
    });

    // ===== Admin & Owner =====
    Route::middleware(['role:admin,owner'])->group(function(){
        Route::resource('layanan', LayananController::class)->except(['show']);
        Route::get('/laporan', [LaporanController::class,'index'])->name('laporan.index');
        Route::get('/laporan/export-pdf', [LaporanController::class,'exportPdf'])->name('laporan.pdf');
        Route::get('/laporan/export-excel', [LaporanController::class,'exportExcel'])->name('laporan.excel');
    });

    // ===== Owner only =====
    Route::middleware(['role:owner'])->group(function(){
        Route::get('/pengaturan', [PengaturanController::class,'index'])->name('pengaturan.index');
    });

});
