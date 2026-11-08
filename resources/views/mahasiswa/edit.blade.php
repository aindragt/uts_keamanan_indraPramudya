@extends('layouts.bs')

@section('title', 'Edit Mahasiswa')

@section('content')
<h3>Edit Mahasiswa</h3>
<form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}">
    @csrf
    @method('PUT')
    @include('mahasiswa._form')
</form>
@endsection