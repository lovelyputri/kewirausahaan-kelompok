<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PemasukanBarangController;
use App\Http\Controllers\KerugianController;
use App\Http\Controllers\RiwayatTransaksiController;

/*
|--------------------------------------------------------------------------
| ROUTE UTAMA
|--------------------------------------------------------------------------
| Redirect halaman utama ke login
*/

Route::get('/', function () {
    return redirect('/login');
});


/*
|--------------------------------------------------------------------------
| ROUTE AUTH (LOGIN & LOGOUT)
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
});


/*
|--------------------------------------------------------------------------
| ROUTE RIWAYAT TRANSAKSI
|--------------------------------------------------------------------------
| Halaman untuk melihat riwayat transaksi (read-only + filter)
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
| Halaman untuk input transaksi penjualan baru (kasir)
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
| ROUTE KERUGIAN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('kerugian', KerugianController::class);
});
