<style>
@page {
    size: A5 landscape;
    margin: 0;
}

body {
    margin: 0;
    padding-top: 0.03cm;   /* ✅ margin atas */
    padding-left: 0.04cm;  /* ✅ margin kiri */
    padding-right: 0.04cm; /* ✅ margin kanan */
    font-family: Arial, sans-serif;
}

table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

td {
    width: 20%;      /* 5 kolom */
    height: 18mm;    /* sesuai label */
    text-align: center;
    vertical-align: middle;
    padding: 1mm;
}

.barcode img {
    width: 70px;
    height: 18px;
}

.kode {
    font-size: 8px;
    font-weight: bold;
}

.nama {
    font-size: 9px;
    line-height: 1;
}

.harga {
    font-size: 10px;
    font-weight: bold;
}
</style>

<table>
@for($row = 0; $row < 8; $row++)
    <tr>
        @for($col = 0; $col < 5; $col++)
            @php
                $index = ($row * 5) + $col;
                $label = $labels[$index] ?? null;
            @endphp

            <td>
                @if($label)

                    {{-- BARCODE --}}
                    <div class="barcode">
                        <img src="data:image/png;base64,{{ $label->barcode }}">
                    </div>

                    {{-- KODE --}}
                    <div class="kode">
                        {{ $label->id_barang }}
                    </div>

                    {{-- NAMA --}}
                    <div class="nama">
                        {{ strtoupper($label->nama_barang) }}
                    </div>

                    {{-- HARGA --}}
                    <div class="harga">
                        Rp {{ number_format($label->harga, 0, ',', '.') }}
                    </div>

                @endif
            </td>

        @endfor
    </tr>
@endfor
</table>