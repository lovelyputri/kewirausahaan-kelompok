<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class RiwayatTransaksiController extends Controller
{
    // ============================
    // INDEX - Riwayat transaksi (filter range tanggal)
    // ============================
    public function index(Request $request)
    {
        $query = Penjualan::with('detailPenjualan.produk');

        // Filter tanggal (range)
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Search by nama produk / kode barang
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('id', 'LIKE', "%{$request->keyword}%")
                  ->orWhereHas('detailPenjualan.produk', function ($sub) use ($request) {
                      $sub->where('nama_produk', 'LIKE', "%{$request->keyword}%")
                          ->orWhere('kode_produk', 'LIKE', "%{$request->keyword}%");
                  });
            });
        }

        $penjualans = $query->orderBy('tanggal', 'desc')->get();

        return view('riwayat_transaksi.index', compact('penjualans'));
    }

    // ============================
    // SHOW - Detail transaksi (support JSON)
    // ============================
    public function show(Request $request, $id)
    {
        $penjualan = Penjualan::with('detailPenjualan.produk')->findOrFail($id);

        // Kalau request AJAX → balikin JSON untuk panel slide-in
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'id' => $penjualan->id,
                'no_struk' => 'INV-' . str_pad($penjualan->id, 4, '0', STR_PAD_LEFT),
                'tanggal' => $penjualan->tanggal->format('d-m-Y'),
                'total_pemasukan' => $penjualan->total_pemasukan,
                'total_item' => $penjualan->total_item,
                'status' => $penjualan->status,
                'label_status' => $penjualan->label_status,
                'warna_status' => $penjualan->warna_status,
                'detail' => $penjualan->detailPenjualan->map(function ($d) {
                    return [
                        'nama_produk' => $d->produk->nama_produk ?? '-',
                        'kode_produk' => $d->produk->kode_produk ?? '-',
                        'jumlah' => $d->jumlah,
                        'harga_jual' => $d->harga_jual,
                        'subtotal' => $d->subtotal,
                    ];
                }),
            ]);
        }

        // Request biasa → fallback view
        return view('riwayat_transaksi.show', compact('penjualan'));
    }
}
