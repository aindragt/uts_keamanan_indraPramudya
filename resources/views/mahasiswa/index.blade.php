@extends('layouts.bs')
@section('title','Data Mahasiswa')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Mahasiswa</h3>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">+ Tambah</a>
</div>
<table class="table table-bordered bg-white">
    <tr><th>NIM</th><th>Nama</th><th>Email</th><th>Jurusan</th><th>No HP</th><th>Alamat</th><th>Aksi</th></tr>
    @foreach($mahasiswas as $m)
    <tr>
        <td>{{ $m->nim }}</td>
        <td>{{ $m->nama }}</td>
        <td>{{ $m->email }}</td>
        <td>{{ $m->jurusan }}</td>
        <td>{{ $m->no_hp }}</td>
        <td>{{ Crypt::decryptString($m->alamat) }}</td>
        <td>
            <a href="{{ route('mahasiswa.edit', $m) }}" class="btn btn-sm btn-warning">Edit</a>
            @can('delete-mahasiswa')
            <form method="POST" action="{{ route('mahasiswa.destroy', $m) }}" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
            @endcan
        </td>
    </tr>
    @endforeach
</table>
{{ $mahasiswas->links('pagination::bootstrap-5') }}
@endsection