<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function cetakLabel(Request $request)
{
    $ids = $request->barang_id ?? [];
    $x = (int)$request->x; // kolom
    $y = (int)$request->y; // baris

    $rows = 8;
    $cols = 5;

    $barang = \App\Models\Barang::whereIn('id_barang', $ids)->get()->values();

    $totalSlots = $rows * $cols; // 40
    $labels = array_fill(0, $totalSlots, null);

    // 🔥 posisi awal (X,Y)
    $startIndex = (($y - 1) * $cols) + ($x - 1);

    // 🔥 masukkan barang dulu
    foreach ($barang as $i => $item) {
        $currentIndex = $startIndex + $i;

        if ($currentIndex < $totalSlots) {
            $labels[$currentIndex] = $item;
        }
    }

    // 🔥 BARU generate barcode (INI YANG BENAR)
    $generator = new BarcodeGeneratorPNG();

    foreach ($labels as $key => $label) {
        if ($label) {
            $labels[$key]->barcode = base64_encode(
                $generator->getBarcode($label->id_barang, $generator::TYPE_CODE_128)
            );
        }
    }

    $pdf = Pdf::loadView('pdf.label', compact('labels'))
              ->setPaper('a5', 'landscape');

    return $pdf->stream('label.pdf');
}
    public function pos()
    {
        $barang = \App\Models\Barang::all();
        return view('modul_js.pos', compact('barang'));
    }
 
    // ambil barang berdasarkan kode
        public function getBarang($kode)
    {
        return \App\Models\Barang::where('id_barang', $kode)->first();
    }

    // simpan transaksi
    public function simpanTransaksi(Request $request)
    {
        $penjualan = Penjualan::create([
            'total' => $request->total
        ]);

        foreach ($request->items as $item) {
            PenjualanDetail::create([
                'id_penjualan' => $penjualan->id_penjualan,
                'id_barang' => $item['kode'],
                'jumlah' => $item['qty'],
                'subtotal' => $item['subtotal']
            ]);
        }

        return response()->json(['status' => 'success']);
    }
        
        }

    