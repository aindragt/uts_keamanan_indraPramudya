@extends('layouts.bs')

@section('title', 'Tambah Mahasiswa')

@section('content')
<h3>Tambah Mahasiswa</h3>
<form method="POST" action="{{ route('mahasiswa.store') }}">
    @csrf
    @include('mahasiswa._form')
</form>
@endsection