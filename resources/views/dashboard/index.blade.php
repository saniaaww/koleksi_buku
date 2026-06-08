@extends('layouts.app')

@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        Dashboard
    </h3>
</div>

<div class="row">

    <!-- TOTAL KATEGORI -->
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-primary text-white">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">
                    Total Kategori
                    <i class="mdi mdi-format-list-bulleted mdi-24px float-end"></i>
                </h4>
                <h2 class="mb-4">{{ \App\Models\Kategori::count() }}</h2>
                <p class="mb-0">
                    <a href="{{ route('kategori.index') }}" class="text-white">
                        Lihat Detail
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- TOTAL BUKU -->
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger text-white">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">
                    Total Buku
                    <i class="mdi mdi-book-open-page-variant mdi-24px float-end"></i>
                </h4>
                <h2 class="mb-4">{{ \App\Models\Buku::count() }}</h2>
                <p class="mb-0">
                    <a href="{{ route('buku.index') }}" class="text-white">
                        Lihat Detail
                    </a>
                </p>
            </div>
        </div>
    </div>

</div>

@endsection