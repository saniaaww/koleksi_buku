@extends('layouts.app')

@section('content')
<h3>Tambah Kategori</h3>

<form method="POST" action="{{ route('kategori.store') }}">
    @csrf

    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" required>
    </div>

    <button class="btn btn-success mt-2">Simpan</button>
</form>
@endsection