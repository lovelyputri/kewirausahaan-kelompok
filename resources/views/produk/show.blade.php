@extends('layout')

@section('title', 'Detail Produk')

@section('content')

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Produk</h1>
            <a href="{{ route('produk.index') }}"
               class="text-gray-500 hover:text-gray-700 text-sm">
                ← Kembali
            </a>
        </div>

        <table class="w-full text-sm">
            <tr class="border-b">
                <td class="py-3 text-gray-500 w-40">Nama Produk</td>
                <td class="py-3 font-medium">{{ $produk->nama_produk }}</td>
            </tr>
            <tr class="border-b">
                <td class="py-3 text-gray-500">Kategori</td>
                <td class="py-3">{{ $produk->kategori->nama_kategori ?? '-' }}</td>
            </tr>
            <tr class="border-b">
                <td class="py-3 text-gray-500">Harga Beli</td>
                <td class="py-3">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</td>
            </tr>
            <tr class="border-b">
                <td class="py-3 text-gray-500">Harga Jual</td>
                <td class="py-3">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
            </tr>
            <tr class="border-b">
                <td class="py-3 text-gray-500">Laba per Unit</td>
                <td class="py-3 text-green-600 font-medium">
                    Rp {{ number_format($produk->laba, 0, ',', '.') }}
                </td>
            </tr>
            <tr class="border-b">
                <td class="py-3 text-gray-500">Stok</td>
                <td class="py-3">{{ $produk->stok }}</td>
            </tr>
            <tr>
                <td class="py-3 text-gray-500">Status</td>
                <td class="py-3">
                    <span class="px-2 py-1 rounded text-xs {{ $produk->warna_status }}">
                        {{ $produk->label_status }}
                    </span>
                </td>
            </tr>
        </table>

        <div class="flex gap-3 mt-6">
            <a href="{{ route('produk.edit', $produk->id) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg text-sm">
                Edit
            </a>
            <form method="POST"
                  action="{{ route('produk.destroy', $produk->id) }}"
                  onsubmit="return confirm('Yakin hapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg text-sm">
                    Hapus
                </button>
            </form>
        </div>

    </div>

@endsection
