@extends('layouts.app')

@section('content')

<div class="container">

<h3>POS Kasir</h3>

<div class="card p-4">

    <div class="mb-2">
        <label>Kode Barang</label>
        <input type="text" id="kode" class="form-control">
    </div>

    <div class="mb-2">
        <label>Nama Barang</label>
        <input type="text" id="nama" class="form-control" readonly>
    </div>

    <div class="mb-2">
        <label>Harga</label>
        <input type="text" id="harga" class="form-control" readonly>
    </div>

    <div class="mb-2">
        <label>Jumlah</label>
        <input type="number" id="qty" class="form-control">
    </div>

    <button type="button" id="tambah" class="btn btn-success mt-2" disabled>
        Tambahkan
    </button>

</div>

<hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="keranjang"></tbody>
</table>

<h4>Total: Rp <span id="total">0</span></h4>

<button id="bayar" class="btn btn-primary mt-3">Bayar</button>

</div>

@endsection


@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

let keranjang = [];
let total = 0;

// 🔥 ENTER → AMBIL BARANG (FIX TOTAL)
$(document).on('keydown', '#kode', function(e){

    if(e.key === "Enter"){

        e.preventDefault();

        let kode = $(this).val();

        if(!kode){
            alert("Masukkan kode barang!");
            return;
        }

        $.get(`/get-barang/${kode}`, function(res){

            console.log(res);

            if(res){
                $('#nama').val(res.nama_barang);
                $('#harga').val(res.harga);
                $('#qty').val(1);

                $('#tambah').prop('disabled', false);
            }else{
                alert("Barang tidak ditemukan");
            }

        });

    }

});


// 🔥 TOMBOL TAMBAH
$(document).on('click', '#tambah', function(){

    let kode = $('#kode').val();
    let nama = $('#nama').val();
    let harga = parseInt($('#harga').val());
    let qty = parseInt($('#qty').val());

    if(!kode || !qty || qty <= 0){
        alert("Data belum lengkap!");
        return;
    }

    let subtotal = harga * qty;

    // cek barang sama
    let found = keranjang.find(item => item.kode == kode);

    if(found){
        found.qty += qty;
        found.subtotal = found.qty * found.harga;
    }else{
        keranjang.push({kode, nama, harga, qty, subtotal});
    }

    renderTable();

    // reset input
    $('#kode').val('');
    $('#nama').val('');
    $('#harga').val('');
    $('#qty').val('');
    $('#tambah').prop('disabled', true);
});


// 🔥 RENDER TABEL
function renderTable(){

    let html = '';
    total = 0;

    keranjang.forEach((item, index)=>{

        total += item.subtotal;

        html += `
        <tr>
            <td>${item.kode}</td>
            <td>${item.nama}</td>
            <td>${item.harga}</td>
            <td>
                <input type="number" value="${item.qty}" 
                       class="form-control editQty" 
                       data-index="${index}">
            </td>
            <td>${item.subtotal}</td>
            <td>
                <button class="btn btn-danger btn-sm hapus" data-index="${index}">
                    Hapus
                </button>
            </td>
        </tr>`;
    });

    $('#keranjang').html(html);
    $('#total').text(total);
}


// 🔥 EDIT QTY
$(document).on('change', '.editQty', function(){

    let index = $(this).data('index');
    let qty = parseInt($(this).val());

    if(qty <= 0){
        alert("Qty tidak boleh 0");
        renderTable();
        return;
    }

    keranjang[index].qty = qty;
    keranjang[index].subtotal = qty * keranjang[index].harga;

    renderTable();
});


// 🔥 HAPUS
$(document).on('click', '.hapus', function(){

    let index = $(this).data('index');
    keranjang.splice(index, 1);

    renderTable();
});


// ================== AJAX ==================
$('#bayar').click(function(){

    if(keranjang.length == 0){
        alert("Keranjang kosong!");
        return;
    }

    let btn = $(this);

    btn.prop('disabled', true);
    btn.html('Processing...');

    $.ajax({
        url: '/pos/simpan',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            total: total,
            items: keranjang
        },
        success: function(){

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Transaksi berhasil disimpan'
            });

            keranjang = [];
            total = 0;
            renderTable();

            $('#kode').val('');
            $('#nama').val('');
            $('#harga').val('');
            $('#qty').val('');
        },
        complete: function(){
            btn.prop('disabled', false);
            btn.html('Bayar');
        }
    });

});


// ================== AXIOS ==================
$('#bayarAxios').click(function(){

    if(keranjang.length == 0){
        alert("Keranjang kosong!");
        return;
    }

    let btn = $(this);

    btn.prop('disabled', true);
    btn.html('Processing...');

    axios.post('/pos/simpan', {
        total: total,
        items: keranjang
    },{
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(res => {

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Transaksi berhasil disimpan'
        });

        keranjang = [];
        total = 0;
        renderTable();

        $('#kode').val('');
        $('#nama').val('');
        $('#harga').val('');
        $('#qty').val('');

    })
    .finally(() => {
        btn.prop('disabled', false);
        btn.html('Bayar (Axios)');
    });

});

</script>

@endsection