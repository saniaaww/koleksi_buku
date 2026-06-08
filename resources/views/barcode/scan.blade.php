<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<title>Scan Barcode Barang</title>

<!-- LIBRARY SCANNER -->
<script src="https://unpkg.com/html5-qrcode"></script>

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<style>

body{
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#667eea,#764ba2);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

.card{
    width:420px;
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 15px 35px rgba(0,0,0,0.2);
    text-align:center;
}

h2{
    margin-bottom:20px;
    color:#333;
}

#reader{
    width:100%;
}

.status{
    margin-top:15px;
    color:#666;
    font-size:14px;
}

.result{
    margin-top:20px;
    background:#f5f5f5;
    padding:15px;
    border-radius:15px;
    display:none;
    text-align:left;
}

.result p{
    margin:10px 0;
    font-size:15px;
}

button{
    width:100%;
    margin-top:15px;
    padding:12px;
    border:none;
    border-radius:10px;
    background:linear-gradient(45deg,#36d1dc,#5b86e5);
    color:white;
    font-weight:600;
    cursor:pointer;
    font-size:15px;
}

</style>

</head>

<body>

<div class="card">

    <h2>📦 Scan Barcode Barang</h2>

    <!-- CAMERA -->
    <div id="reader"></div>

    <!-- STATUS -->
    <div class="status" id="status">
        Arahkan barcode ke kamera
    </div>

    <!-- HASIL -->
    <div class="result" id="hasil">

        <h3>✅ Hasil Scan</h3>

        <p id="id_barang"></p>
        <p id="nama_barang"></p>
        <p id="harga_barang"></p>

    </div>

    <!-- BUTTON -->
    <button onclick="location.reload()">
        🔄 Scan Lagi
    </button>

</div>

<script>

// =======================
// SCAN BERHASIL
// =======================
function onScanSuccess(decodedText){

    // 🔊 BEEP
    let audio = new Audio('/beep.mp3');
    audio.play();

    // 🛑 STOP SCANNER
    html5QrcodeScanner.clear();

    // STATUS
    document.getElementById('status').innerHTML =
        "Barcode berhasil dibaca";

    // AMBIL DATA DARI DATABASE
    fetch('/scan/' + decodedText)

    .then(response => response.json())

    .then(response => {

        if(response.status == 'success'){

            let data = response.data;

            // TAMPILKAN DATA
            document.getElementById('id_barang').innerHTML =
                "<b>ID Barang:</b> " + data.id_barang;

            document.getElementById('nama_barang').innerHTML =
                "<b>Nama Barang:</b> " + data.nama_barang;

            document.getElementById('harga_barang').innerHTML =
                "<b>Harga:</b> Rp " + data.harga;

            // TAMPILKAN HASIL
            document.getElementById('hasil').style.display = 'block';

        } else {

            document.getElementById('status').innerHTML =
                "Barang tidak ditemukan";

        }

    });

}

// =======================
// START SCANNER
// =======================
let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    {
        fps:10,
        qrbox:250
    }
);

// JALANKAN SCANNER
html5QrcodeScanner.render(onScanSuccess);

</script>

</body>
</html>