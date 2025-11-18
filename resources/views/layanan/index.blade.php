@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold">Daftar Layanan</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola layanan dan harga laundry Anda</p>
    </div>
    <a href="{{ route('layanan.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">+ Tambah Layanan</a>
</div>

<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-slate-50 to-blue-50 border-b border-slate-200">
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Nama Layanan</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Tipe</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Harga</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-slate-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($layanans as $l)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-900">{{ $l->nama }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                            {{ ucfirst($l->tipe) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-slate-900">Rp {{ number_format($l->harga,0,',','.') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('layanan.edit',$l) }}" class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-700 rounded-md hover:bg-amber-200 transition text-sm font-medium">Edit</a>
                            <form action="{{ route('layanan.destroy',$l) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus layanan ini?')" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition text-sm font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                        Belum ada layanan — <a href="{{ route('layanan.create') }}" class="text-blue-600 hover:underline">tambah layanan baru</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($layanans->hasPages())
    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
        {{ $layanans->links() }}
    </div>
    @endif
</div>
@endsection
