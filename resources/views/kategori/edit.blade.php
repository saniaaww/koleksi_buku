@extends('layouts.app')

@section('content')
<h3>Edit Kategori</h3>

<form method="POST" action="{{ route('kategori.update', $kategori->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" 
               value="{{ $kategori->nama_kategori }}" 
               class="form-control" required>
    </div>

    <button class="btn btn-success mt-2">Update</button>
</form>
@endsection