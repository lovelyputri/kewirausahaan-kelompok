<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    // ============================
    // INDEX - List penjualan + filter
    // ============================
    public function index(Request $request)
    {
        $query = Penjualan::with('detailPenjualan.produk');

        // Filter tanggal (1 hari)
        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
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

        $penjualans = $query->orderBy('tanggal', 'desc')->orderBy('id', 'desc')->get();

        return view('penjualan.index', compact('penjualans'));
    }

    // ============================
    // CREATE - Form tambah penjualan
    // ============================
    public function create()
    {
        $produks = Produk::orderBy('nama_produk')->get();

        return view('penjualan.create', compact('produks'));
    }

    // ============================
    // STORE - Simpan penjualan + detail
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'status' => 'required|in:selesai,pending,batal',
            'produk_id' => 'required|array|min:1',
            'produk_id.*' => 'required|exists:produk,id',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Buat header penjualan
            $penjualan = Penjualan::create([
                'tanggal' => $request->tanggal,
                'status' => $request->status,
                'total_pemasukan' => 0,
            ]);

            $totalPemasukan = 0;

            // Loop produk yang dibeli
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $jumlah = $request->jumlah[$index];

                $subtotal = $jumlah * $produk->harga_jual;
                $laba = $jumlah * ($produk->harga_jual - $produk->harga_beli);

                DetailPenjualan::create([
                    'id_penjualan' => $penjualan->id,
                    'id_produk' => $produk->id,
                    'jumlah' => $jumlah,
                    'harga_jual' => $produk->harga_jual,
                    'harga_modal' => $produk->harga_beli,
                    'subtotal' => $subtotal,
                    'laba' => $laba,
                ]);

                // ✅ Kurangi stok
                $produk->stok -= $jumlah;
                $produk->save();

                $totalPemasukan += $subtotal;
            }

            // Update total pemasukan
            $penjualan->update([
                'total_pemasukan' => $totalPemasukan,
            ]);

            DB::commit();

            return redirect()->route('penjualan.index')
                ->with('success', 'Transaksi penjualan berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage())
                ->withInput();
        }
    }

    // ============================
    // SHOW - Detail penjualan (support JSON)
    // ============================
    public function show(Request $request, $id)
    {
        $penjualan = Penjualan::with('detailPenjualan.produk')->findOrFail($id);

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
                        'gambar' => $d->produk->gambar ? asset('images/' . $d->produk->gambar) : null,
                        'jumlah' => $d->jumlah,
                        'harga_jual' => $d->harga_jual,
                        'subtotal' => $d->subtotal,
                    ];
                }),
            ]);
        }

        return view('penjualan.show', compact('penjualan'));
    }

    // ============================
    // DESTROY - Hapus penjualan + kembalikan stok
    // ============================
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $penjualan = Penjualan::with('detailPenjualan.produk')->findOrFail($id);

            // ✅ Kembalikan stok
            foreach ($penjualan->detailPenjualan as $detail) {
                if ($detail->produk) {
                    $detail->produk->stok += $detail->jumlah;
                    $detail->produk->save();
                }
            }

            // Hapus detail & header
            $penjualan->detailPenjualan()->delete();
            $penjualan->delete();

            DB::commit();

            return redirect()->route('penjualan.index')
                ->with('success', 'Transaksi penjualan berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }
}
