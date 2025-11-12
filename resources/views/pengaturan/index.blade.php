@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Pengaturan Sistem</h1>

<div class="bg-white p-4 rounded shadow">
    <table class="w-full">
        <thead><tr><th>Nama</th><th>Email</th><th>Role</th></tr></thead>
        <tbody>
            @foreach($users as $u)
            <tr class="border-t">
                <td class="p-2">{{ $u->name }}</td>
                <td class="p-2">{{ $u->email }}</td>
                <td class="p-2">{{ ucfirst($u->role) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
