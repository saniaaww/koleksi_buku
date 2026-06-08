<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BarangController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\TokoController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();


Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');


Route::get('/auth/google/callback', function () {

    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'id_google' => $googleUser->getId(),
            'password' => bcrypt('password123'),
        ]);
    }

    // 🔥 Generate OTP
    $otp = rand(100000, 999999);

    // 🔥 Set manual dan save
    $user->otp = $otp;
    $user->save();

    // Debug sementara
    // dd($user->fresh());

    session(['otp_user_id' => $user->id]);

    Mail::raw("Kode OTP Anda adalah: $otp", function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Kode OTP Login');
    });

    return redirect('/otp');
});

Route::get('/otp', function () {
    return view('auth.otp');
})->name('otp.form');


Route::post('/otp', function (Request $request) {

    $request->validate([
        'otp' => 'required|digits:6'
    ]);

    $user = User::find(session('otp_user_id'));

    if (!$user) {
        return redirect('/login');
    }

    if ((string)$user->otp === (string)$request->otp) {

        Auth::login($user);

        $user->update(['otp' => null]);

        session()->forget('otp_user_id');

        return redirect()->route('dashboard');
    }

    return back()->with('error', 'Kode OTP salah!');

})->name('otp.verify');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');


Route::middleware(['auth'])->group(function () {

    Route::get('/cetak-sertifikat', function () {

    $buku = \App\Models\Buku::first(); // ambil buku pertama untuk demo

    $pdf = Pdf::loadView('pdf.sertifikat', compact('buku'))
                ->setPaper('a4', 'landscape');

    return $pdf->download('sertifikat.pdf');

})->name('cetak.sertifikat');

    Route::get('/cetak-undangan', function () {

        $data = [
            'judul' => 'Undangan Seminar Nasional',
            'isi' => 'Kami mengundang seluruh mahasiswa untuk menghadiri seminar nasional yang akan dilaksanakan pada tanggal 10 Oktober 2026.'
        ];

        $pdf = Pdf::loadView('pdf.undangan', $data)
                    ->setPaper('a4', 'portrait');

        return $pdf->download('undangan.pdf');

    })->name('cetak.undangan');

});

    Route::resource('kategori', KategoriController::class);
    Route::resource('buku', BukuController::class);
});

Route::resource('barang', BarangController::class);
Route::get('/cetak-label', [BarangController::class, 'cetakLabel']) ->name('barang.cetak');
    
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::get('/modul-js', function () {
    return view('modul_js.final');
})->name('modul.js');

Route::get('/modul-datatables', function () {
    return view('modul_js.datatables');
});

    Route::get('/modul-ajax', function () {
    return view('modul_js.ajax');
})->name('modul.ajax');

Route::get('/modul-pos', function () {
    return view('modul_js.pos');
})->name('modul.pos');

Route::get('/modul-pos', [BarangController::class, 'pos'])->name('modul.pos');
Route::get('/pos', [App\Http\Controllers\BarangController::class, 'pos'])->name('pos');
Route::get('/get-barang/{kode}', [App\Http\Controllers\BarangController::class, 'getBarang']);
Route::post('/pos/simpan', [App\Http\Controllers\BarangController::class, 'simpanTransaksi']);
Route::get('/scan-barcode', function () {
    return view('barcode.scan');
})->name('barcode.scan');

use App\Models\Barang;

Route::get('/scan/{id}', function($id){

    $barang = Barang::where('id_barang', $id)->first();

    if($barang){

        return response()->json([
            'status' => 'success',
            'data' => $barang
        ]);

    }

        return response()->json([
            'status' => 'error'
        ]);

});
    Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
    Route::get('/toko/create', [TokoController::class, 'create']);

    Route::post('/toko/store', [TokoController::class, 'store']);
    Route::get('/kunjungan',
    [TokoController::class, 'kunjungan']
);

    Route::get('/toko/{barcode}',
        [TokoController::class, 'getToko']
    );


    Route::get('/scan-toko/{barcode}',
        [TokoController::class, 'getToko']
    );


    