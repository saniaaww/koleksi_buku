@extends('layouts.app')

@section('content')

<h3>Data Barang (Koleksi Buku)</h3>

<a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">
    Tambah Data
</a>

{{-- FORM CETAK (BERDIRI SENDIRI) --}}
<form id="formCetak"
      method="GET"
      action="{{ route('barang.cetak') }}"
      target="_blank">

    <div class="mb-3">
        X: <input type="number" name="x" min="1" max="5" required>
        Y: <input type="number" name="y" min="1" max="8" required>
    </div>

    <button type="submit" class="btn btn-success mb-3">
        Preview Label
    </button>
</form>

{{-- TABEL TIDAK DIBUNGKUS FORM --}}
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Pilih</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barang as $item)
        <tr>
            <td>
                <input type="checkbox"
                       name="barang_id[]"
                       value="{{ $item->id_barang }}"
                       form="formCetak">
            </td>

            <td>{{ $item->id_barang }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
            <td>{{ $item->stok }}</td>

            <td>
                <a href="{{ route('barang.edit',$item->id_barang) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('barang.destroy',$item->id_barang) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection