<?php

namespace App\Http\Controllers;

use App\Helpers\helper;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    // ============================
    // INDEX - Riwayat transaksi
    // ============================
    public function index(Request $request)
    {
        $query = Penjualan::with('detailPenjualan.produk');

        // Filter tanggal (pakai helper)
        $query = helper::tanggal($query, $request->start_date, $request->end_date);

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Search by kode barang / no invoice (opsional)
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

        return view('penjualan.index', compact('penjualans'));
    }

    // ============================
    // SHOW - Detail transaksi (support JSON untuk panel)
    // ============================
    public function show(Request $request, $id)
    {
        $penjualan = Penjualan::with('detailPenjualan.produk')->findOrFail($id);

        // Kalau request AJAX → balikin JSON
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
        return view('penjualan.show', compact('penjualan'));
    }

    // ============================
    // CREATE
    // ============================
    public function create()
    {
        return view('penjualan.create');
    }

    // ============================
    // STORE
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'total_pemasukan' => 'required|numeric',
            'status' => 'required|in:pending,selesai,batal',
        ]);

        Penjualan::create([
            'tanggal' => $request->tanggal,
            'total_pemasukan' => $request->total_pemasukan,
            'status' => $request->status,
        ]);

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    // ============================
    // EDIT
    // ============================
    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        return view('penjualan.edit', compact('penjualan'));
    }

    // ============================
    // UPDATE (fix typo!)
    // ============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'total_pemasukan' => 'required|numeric',
            'status' => 'required|in:pending,selesai,batal',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        $penjualan->update([
            'tanggal' => $request->tanggal,
            'total_pemasukan' => $request->total_pemasukan,   // ✅ FIX TYPO
            'status' => $request->status,
        ]);

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diupdate!');
    }

    // ============================
    // DESTROY
    // ============================
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
