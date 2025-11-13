@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Layanan</h1>
    <a href="{{ route('layanan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah</a>
</div>

<div class="bg-white p-4 rounded shadow">
    <table class="w-full">
        <thead><tr><th>Nama</th><th>Tipe</th><th>Harga</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach($layanans as $l)
            <tr class="border-t">
                <td class="p-2">{{ $l->nama }}</td>
                <td class="p-2">{{ $l->tipe }}</td>
                <td class="p-2">Rp {{ number_format($l->harga,0,',','.') }}</td>
                <td class="p-2">
                    <a href="{{ route('layanan.edit',$l) }}" class="text-yellow-600 mr-2">Edit</a>
                    <form action="{{ route('layanan.destroy',$l) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus?')" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $layanans->links() }}</div>
</div>
@endsection
