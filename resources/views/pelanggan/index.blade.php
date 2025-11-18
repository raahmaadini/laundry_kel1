@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold">Daftar Pelanggan</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola data pelanggan laundry Anda</p>
    </div>
    <a href="{{ route('pelanggan.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">+ Tambah Pelanggan</a>
</div>

<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-slate-50 to-blue-50 border-b border-slate-200">
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">No HP</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Alamat</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-slate-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($pelanggans as $p)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-900">{{ $p->nama }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-slate-700">{{ $p->no_hp }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-slate-600 line-clamp-2">{{ $p->alamat }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('pelanggan.edit',$p) }}" class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-700 rounded-md hover:bg-amber-200 transition text-sm font-medium">Edit</a>
                            <form action="{{ route('pelanggan.destroy',$p) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus pelanggan ini?')" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition text-sm font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                        Belum ada pelanggan — <a href="{{ route('pelanggan.create') }}" class="text-blue-600 hover:underline">tambah pelanggan baru</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pelanggans->hasPages())
    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
        {{ $pelanggans->links() }}
    </div>
    @endif
</div>
@endsection
