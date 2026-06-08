@extends('layouts.app')

@section('content')
<h3>Tambah Buku</h3>

<form method="POST" action="{{ route('buku.store') }}">
    @csrf

    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Kode</label>
        <input type="text" name="kode" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Pengarang</label>
        <input type="text" name="pengarang" class="form-control" required>
    </div>

    <button class="btn btn-success mt-2">Simpan</button>
</form>
@endsection