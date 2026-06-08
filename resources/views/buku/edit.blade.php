@extends('layouts.app')

@section('content')
<h3>Edit Buku</h3>

<form method="POST" action="{{ route('buku.update', $buku->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori_id" class="form-control" required>
            @foreach($kategori as $k)
                <option value="{{ $k->id }}"
                    {{ $buku->kategori_id == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Kode</label>
        <input type="text" name="kode" value="{{ $buku->kode }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" value="{{ $buku->judul }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Pengarang</label>
        <input type="text" name="pengarang" value="{{ $buku->pengarang }}" class="form-control" required>
    </div>

    <button class="btn btn-success mt-2">Update</button>
</form>
@endsection