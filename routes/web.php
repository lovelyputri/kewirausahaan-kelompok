<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PemasukanBarangController;
use App\Http\Controllers\KerugianController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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
| ROUTE KERUGIAN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('kerugian', KerugianController::class);
});
