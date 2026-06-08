<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'kode' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
        ]);

        Buku::create([
            'kategori_id' => $request->kategori_id,
            'kode' => $request->kode,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
        ]);

        return redirect()->route('buku.index')
                         ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        return view('buku.edit', compact('buku','kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required',
            'kode' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
        ]);

        $buku = Buku::findOrFail($id);

        $buku->update([
            'kategori_id' => $request->kategori_id,
            'kode' => $request->kode,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
        ]);

        return redirect()->route('buku.index')
                         ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')
                         ->with('success', 'Buku berhasil dihapus');
    }
}