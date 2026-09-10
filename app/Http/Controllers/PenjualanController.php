<?php

namespace App\Http\Controllers;

use App\Helpers\helper;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with('detailPenjualans');

        $query = helper::tanggal(
            $query,
            $request->start_date,
            $request->end_date
        );

        $penjualans = $query->get();

        return view(
            'penjualan.index',
            compact('penjualans')
        );
    }

    public function create()
    {
        return view('penjualan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'total_pemasukan' => 'required|numeric',
        ]);

        Penjualan::create([
            'tanggal' => $request->tanggal,
            'total_pemasukan' => $request->total_pemasukan,
        ]);

        return redirect()->route('penjualan.index');
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        return view(
            'penjualan.edit',
            compact('penjualan')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'total_pemasukan' => 'required|numeric',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        $penjualan->update([
            'tanggal' => $request->tanggal,
            'total_pemasukan_pemasukan' => $request->total_pemasukan,
        ]);

        return redirect()->route('penjualan.index');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $penjualan->delete();

        return redirect()->route('penjualan.index');
    }
}