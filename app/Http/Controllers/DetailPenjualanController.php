<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $detailPenjualans = DetailPenjualan::with([
            'penjualan',
            'produk'
        ])->get();

        return view(
            'detail_penjualan.index',
            compact('detailPenjualans')
        );
    }

    public function create()
    {
        $penjualans = Penjualan::all();
        $produks = Produk::all();

        return view(
            'detail_penjualan.create',
            compact('penjualans', 'produks')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penjualan' => 'required',
            'id_produk' => 'required',
            'jumlah' => 'required|integer',
            'harga_jual' => 'required|numeric',
            'harga_modal' => 'required|numeric',
        ]);

        $subtotal = $request->jumlah * $request->harga_jual;

        $laba = $request->jumlah *
                ($request->harga_jual - $request->harga_modal);

        DetailPenjualan::create([
            'id_penjualan' => $request->id_penjualan,
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual,
            'harga_modal' => $request->harga_modal,
            'subtotal' => $subtotal,
            'laba' => $laba,
        ]);

        return redirect()->route('detail_penjualan.index');
    }

    public function edit($id)
    {
        $detailPenjualan = DetailPenjualan::findOrFail($id);

        $penjualans = Penjualan::all();
        $produks = Produk::all();

        return view(
            'detail_penjualan.edit',
            compact(
                'detailPenjualan',
                'penjualans',
                'produks'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_penjualan' => 'required',
            'id_produk' => 'required',
            'jumlah' => 'required|integer',
            'harga_jual' => 'required|numeric',
            'harga_modal' => 'required|numeric',
        ]);

        $detailPenjualan = DetailPenjualan::findOrFail($id);

        $subtotal = $request->jumlah * $request->harga_jual;

        $laba = $request->jumlah *
                ($request->harga_jual - $request->harga_modal);

        $detailPenjualan->update([
            'id_penjualan' => $request->id_penjualan,
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual,
            'harga_modal' => $request->harga_modal,
            'subtotal' => $subtotal,
            'laba' => $laba,
        ]);

        return redirect()->route('detail_penjualan.index');
    }

    public function destroy($id)
    {
        $detailPenjualan = DetailPenjualan::findOrFail($id);

        $detailPenjualan->delete();

        return redirect()->route('detail_penjualan.index');
    }
}