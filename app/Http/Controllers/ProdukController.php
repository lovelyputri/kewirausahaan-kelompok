<?php

namespace App\Http\Controllers;

use App\Helpers\helper;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Kerugian;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // ============================
    // INDEX - List produk + filter + statistik
    // ============================
    public function index(Request $request)
    {
        $query = Produk::with('kategori');

        $query = helper::search($query, $request->keyword);
        $query = helper::kategori($query, $request->id_kategori);

        if ($request->status == 'tersedia') {
            $query->where('stok', '>', 5);
        } elseif ($request->status == 'menipis') {
            $query->where('stok', '>', 0)->where('stok', '<=', 5);
        } elseif ($request->status == 'habis') {
            $query->where('stok', '<=', 0);
        }

        $produks = $query->get();
        $kategoris = Kategori::all();

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

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'id' => $produk->id,
                'kode_produk' => $produk->kode_produk,
                'nama_produk' => $produk->nama_produk,
                'kategori' => $produk->kategori->nama_kategori ?? '-',
                'harga_beli' => $produk->harga_beli,
                'harga_jual' => $produk->harga_jual,
                'laba' => $produk->laba,
                'stok' => $produk->stok,
                'label_status' => $produk->label_status,
                'warna_status' => $produk->warna_status,
                'gambar' => $produk->gambar ? asset('images/' . $produk->gambar) : null,
            ]);
        }

        return view('produk.show', compact('produk'));
    }

    // ============================
    // CREATE
    // ============================
    public function create()
    {
        $kategoris = Kategori::all();
        $gambarList = $this->getGambarList();

        return view('produk.create', compact('kategoris', 'gambarList'));
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
            'id_kategori' => 'required',
            'gambar' => 'nullable|string',
        ]);

        Produk::create([
            'kode_produk' => Produk::generateKodeProduk(),
            'nama_produk' => $request->nama_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori,
            'gambar' => $request->gambar,
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
        $gambarList = $this->getGambarList();

        return view('produk.edit', compact('produk', 'kategoris', 'gambarList'));
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
            'id_kategori' => 'required',
            'gambar' => 'nullable|string',
        ]);

        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori,
            'gambar' => $request->gambar,
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

    // ============================
    // FORM CATAT KERUGIAN
    // ============================
    public function catatKerugian()
    {
        $produks = Produk::orderBy('nama_produk')->get();

        return view('kerugian.create', compact('produks'));
    }

    // ============================
    // SIMPAN KERUGIAN
    // ============================
    public function simpanKerugian(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'alasan' => 'required|in:rusak,kedaluwarsa,hilang,lainnya',
            'catatan' => 'nullable|string',
        ]);

        $produk = Produk::findOrFail($request->id_produk);

        if ($produk->stok < $request->jumlah) {
            return redirect()->back()
                ->with('error', 'Stok tidak cukup! Stok tersedia: ' . $produk->stok . ' pcs')
                ->withInput();
        }

        $nilaiRugi = $produk->harga_beli * $request->jumlah;

        Kerugian::create([
            'id_produk' => $produk->id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'nilai_rugi' => $nilaiRugi,
            'alasan' => $request->alasan,
            'catatan' => $request->catatan,
        ]);

        $produk->stok -= $request->jumlah;
        $produk->save();

        return redirect()->route('produk.index')
            ->with('success', 'Kerugian berhasil dicatat! Stok berkurang ' . $request->jumlah . ' pcs.');
    }

    // ============================
    // HELPER
    // ============================
    private function getGambarList()
    {
        $gambarList = [];
        $path = public_path('images');

        if (is_dir($path)) {
            $files = scandir($path);
            foreach ($files as $file) {
                if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                    $gambarList[] = $file;
                }
            }
        }

        return $gambarList;
    }
}
