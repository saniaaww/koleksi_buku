@extends('layouts.app')

@section('content')

<h3>Edit Barang</h3>

<form action="{{ route('barang.update',$barang->id_barang) }}" method="POST">
@csrf
@method('PUT')

Nama Barang:
<input type="text" name="nama_barang"
    value="{{ $barang->nama_barang }}" class="form-control"><br>

Harga:
<input type="number" name="harga"
    value="{{ $barang->harga }}" class="form-control"><br>

Stok:
<input type="number" name="stok"
    value="{{ $barang->stok }}" class="form-control"><br>

<button class="btn btn-primary">Update</button>
</form>

@endsection