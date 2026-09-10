<?php

namespace App\Http\Controllers;

use App\Helpers\helper;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with('kategori');

        $query = helper::search(
            $query,
            $request->keyword
        );

        $query = helper::kategori(
            $query,
            $request->id_kategori
        );

        $produks = $query->get();

        $kategoris = Kategori::all();

        return view(
            'produk.index',
            compact('produks', 'kategoris')
        );
    }

    public function create()
    {
        $kategoris = Kategori::all();

        return view(
            'produk.create',
            compact('kategoris')
        );
    }

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

        return redirect()->route('produk.index');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        $kategoris = Kategori::all();

        return view(
            'produk.edit',
            compact('produk', 'kategoris')
        );
    }

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

        return redirect()->route('produk.index');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        $produk->delete();

        return redirect()->route('produk.index');
    }
}