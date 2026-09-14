<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ============================
        // STATISTIK UTAMA
        // ============================
        $totalProduk = Produk::count();
        $totalStok = Produk::sum('stok');
        $stokMenipisCount = Produk::where('stok', '>', 0)->where('stok', '<=', 5)->count();
        $stokHabisCount = Produk::where('stok', '<=', 0)->count();

        // Penjualan hari ini (total pemasukan)
        $penjualanHariIni = Penjualan::whereDate('tanggal', today())
                                     ->where('status', 'selesai')
                                     ->sum('total_pemasukan');

        // Total item terjual hari ini
        $totalItemHariIni = DetailPenjualan::whereHas('penjualan', function ($q) {
            $q->whereDate('tanggal', today())->where('status', 'selesai');
        })->sum('jumlah');

        // Laba hari ini
        $labaHariIni = DetailPenjualan::whereHas('penjualan', function ($q) {
            $q->whereDate('tanggal', today())->where('status', 'selesai');
        })->sum('laba');

        // ============================
        // STOK MENIPIS (list produk)
        // ============================
        $stokMenipisList = Produk::with('kategori')
                                 ->where('stok', '>', 0)
                                 ->where('stok', '<=', 5)
                                 ->orderBy('stok', 'asc')
                                 ->limit(5)
                                 ->get();

        // ============================
        // KATEGORI TERLARIS
        // ============================
        $kategoriTerlaris = Kategori::all()
            ->map(function ($kategori) {
                // Hitung total terjual per kategori
                $totalTerjual = DetailPenjualan::whereHas('produk', function ($q) use ($kategori) {
                    $q->where('id_kategori', $kategori->id);
                })->sum('jumlah');

                $kategori->total_terjual = $totalTerjual;

                // Ambil gambar produk pertama di kategori ini (untuk thumbnail)
                $produkPertama = Produk::where('id_kategori', $kategori->id)
                                       ->whereNotNull('gambar')
                                       ->first();
                $kategori->gambar_sample = $produkPertama->gambar ?? null;

                return $kategori;
            })
            ->sortByDesc('total_terjual')
            ->take(5)
            ->values();

        // Max terjual (untuk progress bar)
        $maxTerjual = $kategoriTerlaris->max('total_terjual') ?: 1;

        // ============================
        // AKTIVITAS TERBARU
        // ============================
        $aktivitasTerbaru = DetailPenjualan::with(['produk', 'penjualan'])
            ->latest()
            ->limit(3)
            ->get();

        return view('dashboard', compact(
            'totalProduk',
            'totalStok',
            'stokMenipisCount',
            'stokHabisCount',
            'penjualanHariIni',
            'totalItemHariIni',
            'labaHariIni',
            'stokMenipisList',
            'kategoriTerlaris',
            'maxTerjual',
            'aktivitasTerbaru'
        ));
    }
}
