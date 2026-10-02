<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Kategori;
use App\Models\Kerugian;
use App\Exports\LabaSpreadsheetExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanLabaController extends Controller
{
    // ============================
    // INDEX - Laporan laba rugi
    // ============================
    public function index(Request $request)
    {
        $laporans = $this->getQuery($request)->get();

        // Statistik
        $totalPenjualan = $laporans->sum('total_jual');
        $totalModal = $laporans->sum('total_modal');
        $labaKotor = $laporans->sum('total_untung');

        $totalKerugian = $this->getTotalKerugian($request);
        $labaBersih = $labaKotor - $totalKerugian;

        $kategoris = Kategori::all();

        // ✅ REKAP KERUGIAN (dengan pagination)
        $kerugians = $this->getKerugianQuery($request)->paginate(10);

        return view('laporan_laba.index', compact(
            'laporans',
            'kerugians',
            'kategoris',
            'totalPenjualan',
            'totalModal',
            'totalKerugian',
            'labaBersih'
        ));
    }

    // ============================
    // EXPORT - Download Excel
    // ============================
    public function export(Request $request)
    {
        $laporans = $this->getQuery($request)->get();

        $filename = 'laporan-laba-' . date('Y-m-d') . '.xlsx';

        return (new LabaSpreadsheetExport($laporans))->download($filename);
    }

    // ============================
    // HELPER: Query laporan laba
    // ============================
    private function getQuery(Request $request)
    {
        $query = DetailPenjualan::query()
            ->join('penjualan', 'detail_penjualan.id_penjualan', '=', 'penjualan.id')
            ->join('produk', 'detail_penjualan.id_produk', '=', 'produk.id')
            ->join('kategori', 'produk.id_kategori', '=', 'kategori.id')
            ->select(
                'produk.kode_produk',
                'produk.nama_produk',
                'kategori.nama_kategori',
                DB::raw('SUM(detail_penjualan.jumlah) as total_terjual'),
                DB::raw('SUM(detail_penjualan.harga_modal * detail_penjualan.jumlah) as total_modal'),
                DB::raw('SUM(detail_penjualan.harga_jual * detail_penjualan.jumlah) as total_jual'),
                DB::raw('SUM(detail_penjualan.laba) as total_untung')
            )
            ->groupBy('produk.id', 'produk.kode_produk', 'produk.nama_produk', 'kategori.nama_kategori');

        // Filter tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('penjualan.tanggal', [$request->start_date, $request->end_date]);
        }

        // Filter search
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('produk.nama_produk', 'LIKE', "%{$request->keyword}%")
                  ->orWhere('produk.kode_produk', 'LIKE', "%{$request->keyword}%");
            });
        }

        // Filter kategori
        if ($request->id_kategori) {
            $query->where('produk.id_kategori', $request->id_kategori);
        }

        return $query;
    }

    // ============================
    // HELPER: Query rekap kerugian
    // ============================
    private function getKerugianQuery(Request $request)
    {
        $query = Kerugian::query()
            ->join('produk', 'kerugian.id_produk', '=', 'produk.id')
            ->join('kategori', 'produk.id_kategori', '=', 'kategori.id')
            ->select(
                'kerugian.id',
                'kerugian.tanggal',
                'produk.kode_produk',
                'produk.nama_produk',
                'kategori.nama_kategori',
                'kerugian.jumlah',
                'kerugian.nilai_rugi',
                'kerugian.alasan',
                'kerugian.catatan'
            )
            ->orderBy('kerugian.tanggal', 'desc')
            ->orderBy('kerugian.id', 'desc');

        // Filter tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('kerugian.tanggal', [$request->start_date, $request->end_date]);
        }

        // Filter search
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('produk.nama_produk', 'LIKE', "%{$request->keyword}%")
                  ->orWhere('produk.kode_produk', 'LIKE', "%{$request->keyword}%");
            });
        }

        // Filter kategori
        if ($request->id_kategori) {
            $query->where('produk.id_kategori', $request->id_kategori);
        }

        return $query;
    }

    // ============================
    // HELPER: Total kerugian
    // ============================
    private function getTotalKerugian(Request $request)
    {
        $query = Kerugian::query();

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        if ($request->keyword) {
            $query->whereHas('produk', function ($q) use ($request) {
                $q->where('nama_produk', 'LIKE', "%{$request->keyword}%")
                  ->orWhere('kode_produk', 'LIKE', "%{$request->keyword}%");
            });
        }

        if ($request->id_kategori) {
            $query->whereHas('produk', function ($q) use ($request) {
                $q->where('id_kategori', $request->id_kategori);
            });
        }

        return $query->sum('nilai_rugi');
    }
}
