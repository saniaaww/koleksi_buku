<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Buku;

class DashboardController extends Controller
{
public function index()
{
    $totalKategori = Kategori::count();
    $totalBuku = Buku::count();

    // ambil buku pertama saja (tanpa order)
    $bukuTerbaru = Buku::first()?->judul;

    $buku = Buku::with('kategori')->get();

    return view('dashboard', compact(
        'totalKategori',
        'totalBuku',
        'bukuTerbaru',
        'buku'
    ));
}

}

