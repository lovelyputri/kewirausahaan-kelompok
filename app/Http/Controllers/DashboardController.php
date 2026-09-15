<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Kerugian;
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

        // Penjualan hari ini
        $penjualanHariIni = Penjualan::whereDate('tanggal', today())
                                     ->where('status', 'selesai')
                                     ->sum('total_pemasukan');

        $totalItemHariIni = DetailPenjualan::whereHas('penjualan', function ($q) {
            $q->whereDate('tanggal', today())->where('status', 'selesai');
        })->sum('jumlah');

        // Laba hari ini (laba kotor - kerugian hari ini)
        $labaKotorHariIni = DetailPenjualan::whereHas('penjualan', function ($q) {
            $q->whereDate('tanggal', today())->where('status', 'selesai');
        })->sum('laba');

        $kerugianHariIni = Kerugian::whereDate('tanggal', today())->sum('nilai_rugi');
        $labaHariIni = $labaKotorHariIni - $kerugianHariIni;

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
                $totalTerjual = DetailPenjualan::whereHas('produk', function ($q) use ($kategori) {
                    $q->where('id_kategori', $kategori->id);
                })->sum('jumlah');

                $kategori->total_terjual = $totalTerjual;

                $produkPertama = Produk::where('id_kategori', $kategori->id)
                                       ->whereNotNull('gambar')
                                       ->first();
                $kategori->gambar_sample = $produkPertama->gambar ?? null;

                return $kategori;
            })
            ->sortByDesc('total_terjual')
            ->take(5)
            ->values();

        $maxTerjual = $kategoriTerlaris->max('total_terjual') ?: 1;

        // ============================
        // AKTIVITAS TERBARU
        // ============================
        $aktivitasTerbaru = DetailPenjualan::with(['produk', 'penjualan'])
            ->latest()
            ->limit(3)
            ->get();

        // ============================
        // GRAFIK PENJUALAN 6 HARI TERAKHIR
        // ============================
        $chartData = [];
        $chartLabels = [];
        $maxChart = 0;

        for ($i = 5; $i >= 0; $i--) {
            $tanggal = now()->subDays($i);
            $total = Penjualan::whereDate('tanggal', $tanggal)
                              ->where('status', 'selesai')
                              ->sum('total_pemasukan');

            $chartData[] = $total;
            $chartLabels[] = $tanggal->format('d M');
            if ($total > $maxChart) $maxChart = $total;
        }

        // Total chart 6 hari
        $totalChart = array_sum($chartData);

        // ============================
        // DOUGHNUT DATA
        // ============================
        $totalPenjualan6Hari = 0;
        $totalModal6Hari = 0;
        $totalLabaKotor6Hari = 0;
        $totalKerugian6Hari = 0;

        for ($i = 5; $i >= 0; $i--) {
            $tanggal = now()->subDays($i);

            $totalPenjualan6Hari += Penjualan::whereDate('tanggal', $tanggal)
                                              ->where('status', 'selesai')
                                              ->sum('total_pemasukan');

            $totalModal6Hari += DetailPenjualan::whereHas('penjualan', function ($q) use ($tanggal) {
                $q->whereDate('tanggal', $tanggal)->where('status', 'selesai');
            })->sum(DB::raw('harga_modal * jumlah'));

            $totalLabaKotor6Hari += DetailPenjualan::whereHas('penjualan', function ($q) use ($tanggal) {
                $q->whereDate('tanggal', $tanggal)->where('status', 'selesai');
            })->sum('laba');

            $totalKerugian6Hari += Kerugian::whereDate('tanggal', $tanggal)->sum('nilai_rugi');
        }

        $labaBersih6Hari = $totalLabaKotor6Hari - $totalKerugian6Hari;

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
            'aktivitasTerbaru',
            'chartData',
            'chartLabels',
            'maxChart',
            'totalChart',
            'totalPenjualan6Hari',
            'totalModal6Hari',
            'totalLabaKotor6Hari',
            'totalKerugian6Hari',
            'labaBersih6Hari'
        ));
    }
}
