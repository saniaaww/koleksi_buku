@extends('layouts.app')

@section('content')

<div class="page-header">

    <h3 class="page-title">

        <span class="page-title-icon bg-gradient-primary text-white me-2">

            <i class="mdi mdi-qrcode-scan"></i>

        </span>

        Kunjungan Toko

    </h3>

</div>

<div class="row">

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title mb-4">

                    Scan QR Toko

                </h4>

                <!-- SCANNER -->

                <div id="reader"
                     style="width:300px;">
                </div>

                <!-- HASIL -->

                <div id="hasil"
                     class="mt-4">
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<!-- LIBRARY QR -->

<script src="https://unpkg.com/html5-qrcode"></script>

<script>

// ====================================
// FUNCTION HAVERSINE
// ====================================

function haversine(
    lat1,
    lon1,
    lat2,
    lon2
){

    const R = 6371000;

    const dLat =
        (lat2 - lat1) *
        Math.PI / 180;

    const dLon =
        (lon2 - lon1) *
        Math.PI / 180;

    const a =

        Math.sin(dLat / 2) *
        Math.sin(dLat / 2)

        +

        Math.cos(lat1 * Math.PI / 180) *
        Math.cos(lat2 * Math.PI / 180)

        *

        Math.sin(dLon / 2) *
        Math.sin(dLon / 2);

    const c =

        2 *

        Math.atan2(
            Math.sqrt(a),
            Math.sqrt(1 - a)
        );

    return R * c;

}

// ====================================
// START SCANNER
// ====================================

let scanner =

    new Html5QrcodeScanner(

        "reader",

        {

            fps: 10,
            qrbox: 200

        }

    );

// ====================================
// SCAN SUCCESS
// ====================================

function onScanSuccess(decodedText){

    // stop scanner
    scanner.clear();

    // loading
    document.getElementById('hasil')
        .innerHTML =

        `
        <div class="alert alert-info">

            Mengambil data toko...

        </div>
        `;

    // ambil data toko
    fetch('/scan-toko/' + decodedText)

    .then(response => response.json())

    .then(response => {

        // toko tidak ditemukan
        if(response.status != 'success'){

            document.getElementById('hasil')
                .innerHTML =

                `
                <div class="alert alert-danger">

                    Toko tidak ditemukan

                </div>

                <button
                    onclick="location.reload()"
                    class="btn btn-primary">

                    Scan Lagi

                </button>
                `;

            return;

        }

        // data toko
        let toko = response.data;

        // ambil GPS sales
        navigator.geolocation.getCurrentPosition(

            function(position){

                let salesLat =
                    position.coords.latitude;

                let salesLng =
                    position.coords.longitude;

                let salesAcc =
                    position.coords.accuracy;

                // hitung jarak
                let jarak = haversine(

                    parseFloat(toko.latitude),
                    parseFloat(toko.longitude),

                    parseFloat(salesLat),
                    parseFloat(salesLng)

                );

                // threshold efektif
                let threshold =

                    300 +

                    parseFloat(toko.accuracy) +

                    parseFloat(salesAcc);

                // status
                let status =

                    jarak <= threshold

                    ? 'DITERIMA ✅'

                    : 'DITOLAK ❌';

                // tampil hasil
                document.getElementById('hasil')
                    .innerHTML =

                    `
                    <div class="alert alert-primary">

                        <h4 class="mb-4">

                            Hasil Kunjungan

                        </h4>

                        <table class="table table-bordered">

                            <tr>

                                <th width="35%">
                                    Nama Toko
                                </th>

                                <td>
                                    ${toko.nama_toko}
                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Barcode
                                </th>

                                <td>
                                    ${toko.barcode}
                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Latitude Toko
                                </th>

                                <td>
                                    ${toko.latitude}
                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Longitude Toko
                                </th>

                                <td>
                                    ${toko.longitude}
                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Accuracy Toko
                                </th>

                                <td>
                                    ${parseFloat(
                                        toko.accuracy
                                    ).toFixed(1)} meter
                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Latitude Sales
                                </th>

                                <td>
                                    ${salesLat}
                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Longitude Sales
                                </th>

                                <td>
                                    ${salesLng}
                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Accuracy Sales
                                </th>

                                <td>
                                    ${salesAcc.toFixed(1)} meter
                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Jarak Aktual
                                </th>

                                <td>
                                    ${jarak.toFixed(1)} meter
                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Threshold Efektif
                                </th>

                                <td>
                                    ${threshold.toFixed(1)} meter
                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Status
                                </th>

                                <td>

                                    <h4>
                                        ${status}
                                    </h4>

                                </td>

                            </tr>

                        </table>

                        <button
                            onclick="location.reload()"
                            class="btn btn-primary mt-3">

                            Scan Lagi

                        </button>

                    </div>
                    `;

            },

            function(error){

                document.getElementById('hasil')
                    .innerHTML =

                    `
                    <div class="alert alert-danger">

                        GPS Error :
                        ${error.message}

                    </div>

                    <button
                        onclick="location.reload()"
                        class="btn btn-primary">

                        Coba Lagi

                    </button>
                    `;

            },

            {

                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0

            }

        );

    });

}

// ====================================
// JALANKAN SCANNER
// ====================================

scanner.render(
    onScanSuccess
);

</script>

@endsection