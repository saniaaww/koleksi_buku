@extends('layouts.app')

@section('content')

<div class="container">

<div class="card">

<div class="card-body">

<h3 class="mb-4">
Tambah Toko
</h3>

<form method="POST"
      action="/toko/store">

@csrf

<div class="mb-3">

<label>Nama Toko</label>

<input type="text"
       name="nama_toko"
       class="form-control">

</div>

<div class="mb-3">

<label>Latitude</label>

<input type="text"
       name="latitude"
       id="latitude"
       class="form-control">

</div>

<div class="mb-3">

<label>Longitude</label>

<input type="text"
       name="longitude"
       id="longitude"
       class="form-control">

</div>

<div class="mb-3">
    <label>Accuracy</label>
    <input type="text"
           name="accuracy"
           id="accuracy"
           class="form-control"
           readonly>
</div>

<button type="button"
        onclick="ambilLokasi()"
        class="btn btn-info">

    📍 Ambil Lokasi

</button>

<button type="submit"
        class="btn btn-primary">

    Simpan

</button>

</form>

</div>

<script>

function ambilLokasi(){

    // cek support browser
    if(!navigator.geolocation){

        alert('Browser tidak support GPS');

        return;

    }

    // ambil lokasi
    navigator.geolocation.getCurrentPosition(

        function(position){

            // isi input
            document.getElementById('latitude').value =
                position.coords.latitude;

            document.getElementById('longitude').value =
                position.coords.longitude;

            document.getElementById('accuracy').value =
                position.coords.accuracy;

            alert('Lokasi berhasil diambil');

        },

        function(error){

            // tampilkan error detail
            alert(
                'GPS Error : ' + error.message
            );

            console.log(error);

        },

        {

            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0

        }

    );

}

</script>
@endsection