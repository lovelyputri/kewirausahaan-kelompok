<?php

namespace App\Http\Controllers;

use App\Helpers\helper;
use App\Models\PemasukanBarang;
use App\Models\Produk;
use Illuminate\Http\Request;

class PemasukanBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = PemasukanBarang::with('produk');

        $query = helper::tanggal(
            $query,
            $request->start_date,
            $request->end_date
        );

        $pemasukanBarang = $query->get();

        return view(
            'pemasukan_barang.index',
            compact('pemasukanBarang')
        );
    }

    public function create()
    {
        $produks = Produk::all();

        return view(
            'pemasukan_barang.create',
            compact('produks')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'harga_per_item' => 'required|numeric',
        ]);

        $totalModal = $request->jumlah * $request->harga_per_item;

        PemasukanBarang::create([
            'id_produk' => $request->id_produk,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'harga_per_item' => $request->harga_per_item,
            'total_modal' => $totalModal,
        ]);

        return redirect()->route('pemasukan_barang.index');
    }

    public function edit($id)
    {
        $pemasukanBarang = PemasukanBarang::findOrFail($id);

        $produks = Produk::all();

        return view(
            'pemasukan_barang.edit',
            compact('pemasukanBarang', 'produks')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_produk' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'harga_per_item' => 'required|numeric',
        ]);

        $pemasukanBarang = PemasukanBarang::findOrFail($id);

        $totalModal = $request->jumlah * $request->harga_per_item;

        $pemasukanBarang->update([
            'id_produk' => $request->id_produk,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'harga_per_item' => $request->harga_per_item,
            'total_modal' => $totalModal,
        ]);

        return redirect()->route('pemasukan_barang.index');
    }

    public function destroy($id)
    {
        $pemasukanBarang = PemasukanBarang::findOrFail($id);

        $pemasukanBarang->delete();

        return redirect()->route('pemasukan_barang.index');
    }
}