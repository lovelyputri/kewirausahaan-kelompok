<?php

namespace App\Http\Controllers;

use App\Helpers\helper;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // ============================
    // INDEX - List produk + filter + statistik
    // ============================
    public function index(Request $request)
    {
        $query = Produk::with('kategori');

        // Search (pakai helper)
        $query = helper::search($query, $request->keyword);

        // Filter kategori (pakai helper)
        $query = helper::kategori($query, $request->id_kategori);

        // Filter status stok
        if ($request->status == 'tersedia') {
            $query->where('stok', '>', 5);
        } elseif ($request->status == 'menipis') {
            $query->where('stok', '>', 0)->where('stok', '<=', 5);
        } elseif ($request->status == 'habis') {
            $query->where('stok', '<=', 0);
        }

        $produks = $query->get();

        // Data dropdown kategori (dari seeder)
        $kategoris = Kategori::all();

        // Statistik 4 kotak
        $totalProduk = Produk::count();
        $totalStok = Produk::sum('stok');
        $stokMenipis = Produk::where('stok', '>', 0)->where('stok', '<=', 5)->count();
        $stokHabis = Produk::where('stok', '<=', 0)->count();

        return view('produk.index', compact(
            'produks',
            'kategoris',
            'totalProduk',
            'totalStok',
            'stokMenipis',
            'stokHabis'
        ));
    }

    // ============================
    // SHOW - Detail produk (support JSON)
    // ============================
    public function show(Request $request, $id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);

        // Kalau request AJAX → balikin JSON untuk panel slide-in
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'id' => $produk->id,
                'nama_produk' => $produk->nama_produk,
                'kategori' => $produk->kategori->nama_kategori ?? '-',
                'harga_beli' => $produk->harga_beli,
                'harga_jual' => $produk->harga_jual,
                'laba' => $produk->laba,
                'stok' => $produk->stok,
                'label_status' => $produk->label_status,
                'warna_status' => $produk->warna_status,
            ]);
        }

        // Request biasa → balikin view
        return view('produk.show', compact('produk'));
    }

    // ============================
    // CREATE
    // ============================
    public function create()
    {
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    // ============================
    // STORE
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'id_kategori' => 'required'
        ]);

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    // ============================
    // EDIT
    // ============================
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();

        return view('produk.edit', compact('produk', 'kategoris'));
    }

    // ============================
    // UPDATE
    // ============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'id_kategori' => 'required'
        ]);

        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    // ============================
    // DESTROY
    // ============================
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
