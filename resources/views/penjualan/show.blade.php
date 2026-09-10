@extends('layout')

@section('title', 'Detail Transaksi')

@section('content')

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Transaksi</h1>
            <a href="{{ route('penjualan.index') }}"
               class="text-gray-500 hover:text-gray-700 text-sm">
                ← Kembali
            </a>
        </div>

        {{-- Info Transaksi --}}
        <table class="w-full text-sm mb-6">
            <tr class="border-b">
                <td class="py-3 text-gray-500 w-40">No. Struk</td>
                <td class="py-3 font-mono">
                    INV-{{ str_pad($penjualan->id, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
            <tr class="border-b">
                <td class="py-3 text-gray-500">Tanggal</td>
                <td class="py-3">{{ $penjualan->tanggal->format('d-m-Y') }}</td>
            </tr>
            <tr class="border-b">
                <td class="py-3 text-gray-500">Status</td>
                <td class="py-3">
                    <span class="px-2 py-1 rounded text-xs {{ $penjualan->warna_status }}">
                        {{ $penjualan->label_status }}
                    </span>
                </td>
            </tr>
            <tr class="border-b">
                <td class="py-3 text-gray-500">Total Item</td>
                <td class="py-3">{{ $penjualan->total_item }}</td>
            </tr>
            <tr class="border-b">
                <td class="py-3 text-gray-500">Total Harga</td>
                <td class="py-3 font-semibold">
                    Rp {{ number_format($penjualan->total_pemasukan, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        {{-- Detail Produk --}}
        <h3 class="font-semibold text-gray-800 mb-2">Detail Produk</h3>
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                    <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-3 py-2 text-center text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                    <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualan->detailPenjualan as $index => $d)
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $index + 1 }}</td>
                        <td class="px-3 py-2 font-mono">{{ $d->produk->kode_produk ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $d->produk->nama_produk ?? '-' }}</td>
                        <td class="px-3 py-2 text-right">Rp {{ number_format($d->harga_jual, 0, ',', '.') }}</td>
                        <td class="px-3 py-2 text-center">{{ $d->jumlah }}</td>
                        <td class="px-3 py-2 text-right">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-3 py-4 text-center text-gray-500">
                            Tidak ada detail produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

@endsection
