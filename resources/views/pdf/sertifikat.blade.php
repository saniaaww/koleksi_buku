<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
@page {
    size: A4 landscape;
    margin: 0; /* hilangkan margin agar full kertas */
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center; /* center horizontal */
    align-items: center;     /* center vertical */
}

.frame {
    border: 0px solid #172498;
    width: 95%;   /* hampir penuh kertas */
    height: 90%;  /* hampir penuh kertas */
    padding: 40px;
    box-sizing: border-box;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* konten atas–tengah–bawah */
    align-items: center;
    text-align: center;
}

/* LOGO */
.logo-left {
    position: absolute;
    top: 30px;
    left: 40px;
    width: 90px;
}

.logo-right {
    position: absolute;
    top: 30px;
    right: 40px;
    width: 90px;
}

/* HEADER */
.instansi {
    font-size: 20px;
    font-weight: bold;
    margin-top: 60px;
}

/* TITLE */
.judul {
    font-size: 50px;
    font-weight: bold;
    letter-spacing: 6px;
    margin: 30px 0;
}

/* CONTENT */
.sub {
    font-size: 22px;
    margin: 10px 0;
}

.nama-buku {
    font-size: 32px;
    font-weight: bold;
    margin: 20px 0;
}

.pengarang {
    font-size: 22px;
    margin-bottom: 20px;
}

/* FOOTER */
.footer {
    width: 100%;
    display: flex;
    justify-content: space-between;
    font-size: 18px;
    margin-bottom: 40px;
}

.ttd img {
    width: 120px;
}
</style>
</head>

<body>

<div class="frame">

    <img src="{{ public_path('template/assets/images/logo_kampus.png') }}" class="logo-left">
    <img src="{{ public_path('template/assets/images/logo_perpus.jpg') }}" class="logo-right">

    <div class="instansi">
        UNIVERSITAS AIRLANGGA<br>
        PERPUSTAKAAN UNIVERSITAS AIRLANGGA
    </div>

    <div class="judul">SERTIFIKAT</div>

    <div class="sub">Diberikan kepada buku:</div>

    <div class="nama-buku">
        "{{ $buku->judul }}"
    </div>

    <div class="pengarang">
        Karya dari: {{ $buku->pengarang }}
    </div>

    <div class="sub">
        Sebagai Buku Terbaik Tahun {{ date('Y') }}
    </div>

    <div class="footer">
        <div>
            Surabaya, {{ date('d F Y') }}
        </div>

        <div class="ttd">
            <img src="{{ public_path('template/assets/images/ttd.jpg') }}"><br>
            <strong>Kepala Perpustakaan</strong>
        </div>
    </div>

</div>

</body>
</html>