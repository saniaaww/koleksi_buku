@extends('layouts.app')

@section('content')
<h3>Data Buku</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">
    Tambah Buku
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Kode</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($buku as $b)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $b->kategori->nama_kategori }}</td>
            <td>{{ $b->kode }}</td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->pengarang }}</td>
            <td>
                <a href="{{ route('buku.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('buku.destroy', $b->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection