<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
@page {
    size: A4 portrait;
    margin: 30px;
}

body {
    font-family: "Times New Roman", serif;
    margin: 0;
    padding: 0;
}

/* FRAME */
.frame {
    border: 4px solid #000;
    padding: 40px 50px 60px 50px;
    position: relative;
}

/* LOGO */
.logo-left {
    position: absolute;
    top: 30px;
    left: 40px;
    width: 80px;
}

.logo-right {
    position: absolute;
    top: 30px;
    right: 40px;
    width: 80px;
}

/* HEADER */
.instansi {
    text-align: center;
    font-size: 16px;
    font-weight: bold;
}

.garis {
    border-top: 2px solid black;
    margin: 20px 0 30px 0;
}

/* TITLE */
.judul {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    text-decoration: underline;
    margin-bottom: 30px;
}

/* CONTENT */
.isi {
    font-size: 18px;
    line-height: 1.8;
    text-align: justify;
}

.detail {
    margin-top: 20px;
    font-size: 18px;
}

.footer {
    margin-top: 60px;
    text-align: right;
    font-size: 18px;
}

/* TTD */
.ttd {
    margin-top: 20px;
    text-align: right;
}

.ttd img {
    width: 120px;
    margin: 10px 0;
}

.nama-pejabat {
    font-weight: bold;
    text-align: right;
}

</style>
</head>

<body>

<div class="frame">

    <!-- LOGO -->
    <img src="{{ public_path('template/assets/images/logo_kampus.png') }}" class="logo-left">
    <img src="{{ public_path('template/assets/images/logo_perpus.jpg') }}" class="logo-right">

    <!-- INSTANSI -->
    <div class="instansi">
        UNIVERSITAS AIRLANGGA<br>
        PERPUSTAKAAN UNIVERSITAS AIRLANGGA
    </div>

    <div class="garis"></div>

    <!-- JUDUL -->
    <div class="judul">
        UNDANGAN KEGIATAN KOLEKSI BUKU
    </div>

    <!-- ISI -->
    <div class="isi">
        Dengan hormat,<br><br>

        Dalam rangka meningkatkan literasi serta apresiasi terhadap karya ilmiah dan koleksi buku terbaik,
        Perpustakaan Universitas Airlangga akan menyelenggarakan kegiatan 
        <strong>Pameran dan Apresiasi Koleksi Buku Terbaik Tahun {{ date('Y') }}</strong>.

        Sehubungan dengan hal tersebut, kami mengundang Bapak/Ibu/Saudara/i untuk hadir pada:
    </div>

    <div class="detail">
        <table width="100%" cellpadding="5">
            <tr>
                <td width="30%">Hari/Tanggal</td>
                <td>: Senin, {{ date('d F Y') }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>: 09.00 WIB - Selesai</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>: Aula Perpustakaan Universitas Airlangga</td>
            </tr>
        </table>
    </div>

    <div class="isi" style="margin-top:20px;">
        Demikian undangan ini kami sampaikan. Besar harapan kami atas kehadiran Bapak/Ibu/Saudara/i.
        Atas perhatian dan partisipasinya, kami ucapkan terima kasih.
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Surabaya, {{ date('d F Y') }}
    </div>

    <div class="ttd">
        <img src="{{ public_path('template/assets/images/ttd.jpg') }}">
        <div class="nama-pejabat">
            Kepala Perpustakaan
        </div>
    </div>

</div>

</body>
</html>