@extends('layouts.app')

@section('content')

<div class="container">

<h3>DataTables</h3>

{{-- ================= FORM ================= --}}
<div class="card p-3 mb-3">
<form id="formBarang">

<label>Nama Barang</label>
<input type="text" id="nama" class="form-control" required>

<label class="mt-2">Harga</label>
<input type="number" id="harga" class="form-control" required>

<button type="button" id="btnSubmit" class="btn btn-primary mt-3">
Submit
</button>

</form>
</div>

{{-- ================= TABLE ================= --}}
<table id="tableDT" class="table table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Harga</th>
</tr>
</thead>
<tbody></tbody>
</table>

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

{{-- ================= SCRIPT ================= --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- DATATABLES --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<style>
#tableDT tbody tr:hover {
    cursor: pointer;
    background: #f2f2f2;
}
</style>

<script>

let id = 1;

// ================= INIT DATATABLE =================
let table = $('#tableDT').DataTable();

// ================= SUBMIT =================
$('#btnSubmit').click(function(){

let form = document.getElementById("formBarang");

if(!form.checkValidity()){
    form.reportValidity();
    return;
}

// loader
$('#btnSubmit').html("Loading...");
$('#btnSubmit').prop("disabled", true);

setTimeout(function(){

let nama = $('#nama').val();
let harga = $('#harga').val();

// tambah ke datatable
table.row.add([
    id,
    nama,
    harga
]).draw(false);

// reset input
$('#nama').val('');
$('#harga').val('');

$('#btnSubmit').html("Submit");
$('#btnSubmit').prop("disabled", false);

id++;

},800);

});

// ================= CLICK ROW =================
$('#tableDT tbody').on('click','tr',function(){

let data = table.row(this).data();

$('#edit_id').val(data[0]);
$('#edit_nama').val(data[1]);
$('#edit_harga').val(data[2]);

$('#modalEdit').modal('show');

});

// ================= UPDATE =================
$('#btnUpdate').click(function(){

let idEdit = $('#edit_id').val();

$('#tableDT tbody tr').each(function(){

let row = table.row(this);

if(row.data()[0] == idEdit){

row.data([
    idEdit,
    $('#edit_nama').val(),
    $('#edit_harga').val()
]).draw();

}

});

$('#modalEdit').modal('hide');

});

// ================= DELETE =================
$('#btnDelete').click(function(){

let idEdit = $('#edit_id').val();

$('#tableDT tbody tr').each(function(){

let row = table.row(this);

if(row.data()[0] == idEdit){
    row.remove().draw();
}

});

$('#modalEdit').modal('hide');

});

</script>

@endsection