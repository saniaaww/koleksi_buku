@extends('layouts.app')

@section('content')

<div class="page-header">

    <h3 class="page-title">

        <span class="page-title-icon bg-gradient-primary text-white me-2">

            <i class="mdi mdi-store"></i>

        </span>

        List Toko

    </h3>

</div>

<div class="row">

    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between mb-3">

                    <h4 class="card-title mb-0">
                        Data Toko
                    </h4>

                    <a href="/toko/create"
                       class="btn btn-gradient-primary btn-sm">

                        + Tambah Toko

                    </a>

                </div>

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>
                                    QR Code
                                </th>

                                <th>
                                    Nama Toko
                                </th>

                                <th>
                                    Latitude
                                </th>

                                <th>
                                    Longitude
                                </th>

                                <th>
                                    Accuracy
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($toko as $t)

                            <tr>

                                <!-- QR -->

                                <td>

                                    {!! DNS2D::getBarcodeHTML(
                                        $t->barcode,
                                        'QRCODE',
                                        4,
                                        4
                                    ) !!}

                                    <br>

                                    <small>
                                        {{ $t->barcode }}
                                    </small>

                                </td>

                                <!-- NAMA -->

                                <td>

                                    <b>
                                        {{ $t->nama_toko }}
                                    </b>

                                </td>

                                <!-- LAT -->

                                <td>

                                    {{ $t->latitude }}

                                </td>

                                <!-- LNG -->

                                <td>

                                    {{ $t->longitude }}

                                </td>

                                <!-- ACC -->

                                <td>

                                    {{ $t->accuracy }} m

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center">

                                    Belum ada data toko

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection