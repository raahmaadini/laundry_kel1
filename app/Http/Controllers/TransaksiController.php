<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan','layanan'])->latest()->paginate(12);
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $layanans = Layanan::all();
        return view('transaksi.create', compact('pelanggans','layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id'=>'required|exists:pelanggans,id',
            'layanan_id'=>'required|exists:layanans,id',
            'berat'=>'required|numeric|min:0.1',
            'foto'=>'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $layanan = Layanan::findOrFail($request->layanan_id);
        $total = $layanan->harga * $request->berat;

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_cucian','public');
        }

        Transaksi::create([
            'kode' => 'TRX-'.strtoupper(Str::random(6)),
            'pelanggan_id' => $request->pelanggan_id,
            'layanan_id' => $request->layanan_id,
            'berat' => $request->berat,
            'total' => $total,
            'status' => 'baru',
            'foto' => $fotoPath,
            'kasir' => auth()->user()->name,
        ]);

        return redirect()->route('transaksi.index')->with('success','Transaksi berhasil dibuat.');
    }

    public function edit(Transaksi $transaksi)
    {
        $statuses = ['baru','proses','selesai','diambil'];
        return view('transaksi.edit', compact('transaksi','statuses'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status'=>'required|in:baru,proses,selesai,diambil'
        ]);

        $transaksi->update([
            'status'=>$request->status
        ]);

        return redirect()->route('transaksi.index')->with('success','Status transaksi diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        if ($transaksi->foto) {
            Storage::disk('public')->delete($transaksi->foto);
        }
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success','Transaksi dihapus.');
    }
}
