<?php

namespace App\Http\Controllers;

use App\Helpers\helper;
use App\Models\Kerugian;
use App\Models\Produk;
use Illuminate\Http\Request;

class KerugianController extends Controller
{
    public function index(Request $request)
    {
        $query = Kerugian::with('produk');

        $query = helper::tanggal(
            $query,
            $request->start_date,
            $request->end_date
        );

        $query = helper::alasan(
            $query,
            $request->alasan
        );

        $kerugian = $query->get();

        return view(
            'kerugian.index',
            compact('kerugian')
        );
    }

    public function create()
    {
        $produks = Produk::all();

        return view(
            'kerugian.create',
            compact('produks')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'nilai_rugi' => 'required|numeric',
            'alasan' => 'required',
            'catatan' => 'nullable',
        ]);

        Kerugian::create([
            'id_produk' => $request->id_produk,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'nilai_rugi' => $request->nilai_rugi,
            'alasan' => $request->alasan,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kerugian.index');
    }

    public function edit($id)
    {
        $kerugian = Kerugian::findOrFail($id);

        $produks = Produk::all();

        return view(
            'kerugian.edit',
            compact('kerugian', 'produks')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_produk' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'nilai_rugi' => 'required|numeric',
            'alasan' => 'required',
            'catatan' => 'nullable',
        ]);

        $kerugian = Kerugian::findOrFail($id);

        $kerugian->update([
            'id_produk' => $request->id_produk,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'nilai_rugi' => $request->nilai_rugi,
            'alasan' => $request->alasan,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kerugian.index');
    }

    public function destroy($id)
    {
        $kerugian = Kerugian::findOrFail($id);

        $kerugian->delete();

        return redirect()->route('kerugian.index');
    }
}