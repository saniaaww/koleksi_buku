@extends('layouts.app')

@section('content')

<h3>Tambah Barang</h3>

<form action="{{ route('barang.store') }}" method="POST">
@csrf

Nama Barang:
<input type="text" name="nama_barang" class="form-control"><br>

Harga:
<input type="number" name="harga" class="form-control"><br>

Stok:
<input type="number" name="stok" class="form-control"><br>

<button class="btn btn-primary">Simpan</button>
</form>

@endsection