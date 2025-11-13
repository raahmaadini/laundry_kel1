@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Pelanggan</h1>
    <a href="{{ route('pelanggan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah</a>
</div>

<div class="bg-white p-4 rounded shadow">
    <table class="w-full table-auto">
        <thead>
            <tr class="text-left">
                <th class="p-2">Nama</th>
                <th class="p-2">No HP</th>
                <th class="p-2">Alamat</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelanggans as $p)
            <tr class="border-t">
                <td class="p-2">{{ $p->nama }}</td>
                <td class="p-2">{{ $p->no_hp }}</td>
                <td class="p-2">{{ $p->alamat }}</td>
                <td class="p-2">
                    <a href="{{ route('pelanggan.edit',$p) }}" class="text-yellow-600 mr-2">Edit</a>
                    <form action="{{ route('pelanggan.destroy',$p) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus?')" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $pelanggans->links() }}</div>
</div>
@endsection
