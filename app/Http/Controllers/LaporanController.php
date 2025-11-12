<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan','layanan'])->get();
        return view('laporan.index', compact('transaksis'));
    }

    public function exportPdf()
    {
        $transaksis = Transaksi::with(['pelanggan','layanan'])->get();
        $pdf = Pdf::loadView('laporan.pdf', compact('transaksis'));
        return $pdf->download('laporan-transaksi.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new TransaksiExport, 'laporan-transaksi.xlsx');
    }
}
