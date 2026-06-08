<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;

class TokoController extends Controller
{

    // LIST TOKO
    public function index()
    {

        $toko = Toko::all();

        return view(
            'toko.index',
            compact('toko')
        );

    }

    // FORM TAMBAH TOKO
    public function create()
    {

        return view(
            'toko.create'
        );

    }

    // SIMPAN TOKO
    public function store(Request $request)
    {

        Toko::create([

            'barcode' =>
                'TOKO-' . time(),

            'nama_toko' =>
                $request->nama_toko,

            'latitude' =>
                $request->latitude,

            'longitude' =>
                $request->longitude,

            'accuracy' =>
                $request->accuracy

        ]);

        return redirect('/toko');

    }

    // HALAMAN KUNJUNGAN
    public function kunjungan()
    {

        return view(
            'toko.kunjungan'
        );

    }

    // GET DATA TOKO
    public function getToko($barcode)
    {

        $toko = Toko::where(
            'barcode',
            $barcode
        )->first();

        if(!$toko){

            return response()->json([

                'status' => 'error'

            ]);

        }

        return response()->json([

            'status' => 'success',

            'data' => $toko

        ]);

    }

}