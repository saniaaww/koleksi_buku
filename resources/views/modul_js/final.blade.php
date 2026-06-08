@extends('layouts.app')

@section('content')

<div class="container">

<h3 class="mb-4">Modul Javascript & JQuery</h3>

{{-- ================= FORM ================= --}}
<div class="card p-3 mb-4">
<h5>Form Barang</h5>

<form id="formBarang">

<label>Nama Barang</label>
<input type="text" id="nama" class="form-control" required>

<label class="mt-2">Harga Barang</label>
<input type="number" id="harga" class="form-control" required>

<button type="button" id="submitBtn" class="btn btn-primary mt-3">
Submit
</button>

</form>
</div>

{{-- ================= TABLE ================= --}}
<table class="table table-bordered" id="tableBarang">
<thead>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Harga</th>
</tr>
</thead>
<tbody></tbody>
</table>

<hr>

{{-- ================= SELECT ================= --}}
<div class="row">

<div class="col-md-6">
<div class="card p-3">

<h5>Select</h5>

<input type="text" id="kota" class="form-control" placeholder="Masukkan kota">

<button id="tambahKota" class="btn btn-success mt-2">
Tambah
</button>

<select id="selectKota" class="form-control mt-2"></select>

<p class="mt-2">
Kota Terpilih: <span id="hasil"></span>
</p>

</div>
</div>

<div class="col-md-6">
<div class="card p-3">

<h5>Select2</h5>

<select id="selectKota2" class="form-control"></select>

</div>
</div>

</div>

</div>

{{-- ================= MODAL ================= --}}
<div class="modal fade" id="modalEdit">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5>Edit Data</h5>
</div>

<div class="modal-body">

<label>ID</label>
<input type="text" id="edit_id" class="form-control" readonly>

<label class="mt-2">Nama</label>
<input type="text" id="edit_nama" class="form-control" required>

<label class="mt-2">Harga</label>
<input type="number" id="edit_harga" class="form-control" required>

<button id="btnUpdate" class="btn btn-warning mt-3">Update</button>
<button id="btnDelete" class="btn btn-danger mt-3">Delete</button>

</div>

</div>
</div>
</div>

{{-- ================= SCRIPT LANGSUNG DI SINI ================= --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<style>
#tableBarang tbody tr:hover {
    cursor: pointer;
    background: #f2f2f2;
}
</style>

<script>

console.log("JS AKTIF");

// ================= SUBMIT =================
let id = 1;

$("#submitBtn").click(function(){

let form = document.getElementById("formBarang");

if(!form.checkValidity()){
    form.reportValidity();
    return;
}

$("#submitBtn").html("Loading...");
$("#submitBtn").prop("disabled", true);

setTimeout(function(){

let nama = $("#nama").val();
let harga = $("#harga").val();

let row = `
<tr>
<td>${id}</td>
<td>${nama}</td>
<td>${harga}</td>
</tr>
`;

$("#tableBarang tbody").append(row);

$("#nama").val("");
$("#harga").val("");

$("#submitBtn").html("Submit");
$("#submitBtn").prop("disabled", false);

id++;

},800);

});

// ================= CLICK ROW =================
$(document).on("click","#tableBarang tbody tr",function(){

let id = $(this).find("td:eq(0)").text();
let nama = $(this).find("td:eq(1)").text();
let harga = $(this).find("td:eq(2)").text();

$("#edit_id").val(id);
$("#edit_nama").val(nama);
$("#edit_harga").val(harga);

$("#modalEdit").modal("show");

});

// ================= UPDATE =================
$("#btnUpdate").click(function(){

let id = $("#edit_id").val();

$("#tableBarang tbody tr").each(function(){

if($(this).find("td:eq(0)").text()==id){
$(this).find("td:eq(1)").text($("#edit_nama").val());
$(this).find("td:eq(2)").text($("#edit_harga").val());
}

});

$("#modalEdit").modal("hide");

});

// ================= DELETE =================
$("#btnDelete").click(function(){

let id = $("#edit_id").val();

$("#tableBarang tbody tr").each(function(){

if($(this).find("td:eq(0)").text()==id){
$(this).remove();
}

});

$("#modalEdit").modal("hide");

});

// ================= SELECT =================
$("#tambahKota").click(function(){

let kota = $("#kota").val();

if(kota==""){
alert("Isi kota dulu");
return;
}

$("#selectKota").append(`<option value="${kota}">${kota}</option>`);
$("#selectKota2").append(`<option value="${kota}">${kota}</option>`);

$("#kota").val("");

});

$("#selectKota").change(function(){
$("#hasil").text($(this).val());
});

// ================= SELECT2 =================
$(document).ready(function(){
$("#selectKota2").select2();
});

</script>

@endsection