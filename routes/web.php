<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PemasukanBarangController;
use App\Http\Controllers\KerugianController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\LaporanLabaController;

/*
|--------------------------------------------------------------------------
| ROUTE UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});


/*
|--------------------------------------------------------------------------
| ROUTE AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| ROUTE DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| ROUTE PRODUK
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('produk', ProdukController::class);

    // Catat kerugian dari halaman produk
    Route::get('/kerugian/create', [ProdukController::class, 'catatKerugian'])
        ->name('kerugian.create');

    Route::post('/kerugian/store', [ProdukController::class, 'simpanKerugian'])
        ->name('kerugian.simpan');
});


/*
|--------------------------------------------------------------------------
| ROUTE KERUGIAN (resource)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('kerugian', KerugianController::class)->except(['create', 'store']);
});


/*
|--------------------------------------------------------------------------
| ROUTE RIWAYAT TRANSAKSI
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'index'])
        ->name('riwayat_transaksi.index');

    Route::get('/riwayat-transaksi/{id}', [RiwayatTransaksiController::class, 'show'])
        ->name('riwayat_transaksi.show');
});


/*
|--------------------------------------------------------------------------
| ROUTE PENJUALAN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('penjualan', PenjualanController::class);
});


/*
|--------------------------------------------------------------------------
| ROUTE PEMASUKAN BARANG
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('pemasukan_barang', PemasukanBarangController::class);
});


/*
|--------------------------------------------------------------------------
| ROUTE LAPORAN LABA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/laporan-laba', [LaporanLabaController::class, 'index'])
        ->name('laporan_laba.index');

    // ✅ Export Excel
    Route::get('/laporan-laba/export', [LaporanLabaController::class, 'export'])
        ->name('laporan_laba.export');
});
