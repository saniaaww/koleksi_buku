@extends('layouts.app')

@section('content')

<div class="container">

<h3 class="mb-4">Wilayah Indonesia (AJAX & Axios)</h3>

<div class="card p-4">

    <label>Provinsi</label>
    <select id="provinsi" class="form-control mb-3">
        <option value="">Pilih Provinsi</option>
    </select>

    <label>Kota</label>
    <select id="kota" class="form-control mb-3">
        <option value="">Pilih Kota</option>
    </select>

    <label>Kecamatan</label>
    <select id="kecamatan" class="form-control mb-3">
        <option value="">Pilih Kecamatan</option>
    </select>

    <label>Kelurahan</label>
    <select id="kelurahan" class="form-control mb-3">
        <option value="">Pilih Kelurahan</option>
    </select>

</div>

<hr>

<h5>Versi Axios</h5>

<div class="card p-4">

    <select id="provinsi2" class="form-control mb-2">
        <option value="">Pilih Provinsi</option>
    </select>

    <select id="kota2" class="form-control mb-2">
        <option value="">Pilih Kota</option>
    </select>

    <select id="kecamatan2" class="form-control mb-2">
        <option value="">Pilih Kecamatan</option>
    </select>

    <select id="kelurahan2" class="form-control mb-2">
        <option value="">Pilih Kelurahan</option>
    </select>

</div>

</div>

@endsection


@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

$(document).ready(function(){

console.log("SCRIPT JALAN");

// =======================
// AJAX VERSION (FIX CORS)
// =======================

const baseURL = "https://www.emsifa.com/api-wilayah-indonesia/api";

// LOAD PROVINSI
$.get(baseURL + "/provinces.json", function(data){
    data.forEach(item=>{
        $('#provinsi').append(`<option value="${item.id}">${item.name}</option>`);
    });
});

// PROVINSI → KOTA
$('#provinsi').change(function(){

    let id = $(this).val();

    $('#kota').html('<option value="">Pilih Kota</option>');
    $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
    $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');

    if(id){
        $.get(`${baseURL}/regencies/${id}.json`, function(data){
            data.forEach(item=>{
                $('#kota').append(`<option value="${item.id}">${item.name}</option>`);
            });
        });
    }
});

// KOTA → KECAMATAN
$('#kota').change(function(){

    let id = $(this).val();

    $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
    $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');

    if(id){
        $.get(`${baseURL}/districts/${id}.json`, function(data){
            data.forEach(item=>{
                $('#kecamatan').append(`<option value="${item.id}">${item.name}</option>`);
            });
        });
    }
});

// KECAMATAN → KELURAHAN
$('#kecamatan').change(function(){

    let id = $(this).val();

    $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');

    if(id){
        $.get(`${baseURL}/villages/${id}.json`, function(data){
            data.forEach(item=>{
                $('#kelurahan').append(`<option value="${item.id}">${item.name}</option>`);
            });
        });
    }
});


// =======================
// AXIOS VERSION
// =======================

// LOAD PROVINSI
axios.get(baseURL + "/provinces.json")
.then(res=>{
    res.data.forEach(item=>{
        $('#provinsi2').append(`<option value="${item.id}">${item.name}</option>`);
    });
});

// PROVINSI → KOTA
$('#provinsi2').change(function(){

    let id = $(this).val();

    $('#kota2').html('<option value="">Pilih Kota</option>');
    $('#kecamatan2').html('<option value="">Pilih Kecamatan</option>');
    $('#kelurahan2').html('<option value="">Pilih Kelurahan</option>');

    if(id){
        axios.get(`${baseURL}/regencies/${id}.json`)
        .then(res=>{
            res.data.forEach(item=>{
                $('#kota2').append(`<option value="${item.id}">${item.name}</option>`);
            });
        });
    }
});

// KOTA → KECAMATAN
$('#kota2').change(function(){

    let id = $(this).val();

    $('#kecamatan2').html('<option value="">Pilih Kecamatan</option>');
    $('#kelurahan2').html('<option value="">Pilih Kelurahan</option>');

    if(id){
        axios.get(`${baseURL}/districts/${id}.json`)
        .then(res=>{
            res.data.forEach(item=>{
                $('#kecamatan2').append(`<option value="${item.id}">${item.name}</option>`);
            });
        });
    }
});

// KECAMATAN → KELURAHAN
$('#kecamatan2').change(function(){

    let id = $(this).val();

    $('#kelurahan2').html('<option value="">Pilih Kelurahan</option>');

    if(id){
        axios.get(`${baseURL}/villages/${id}.json`)
        .then(res=>{
            res.data.forEach(item=>{
                $('#kelurahan2').append(`<option value="${item.id}">${item.name}</option>`);
            });
        });
    }
});

});

</script>

@endsection