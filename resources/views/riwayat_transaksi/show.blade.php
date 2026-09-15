@extends('layout')

@section('title', 'Detail Transaksi')

@section('content')

<div style="max-width:720px;margin:0 auto;font-family:'Inter',sans-serif;color:#4f3929;">

    <div style="background:#fff;border:1px solid #eee5dc;border-radius:14px;padding:24px;">

        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h1 style="font-family:'DM Serif Display',serif;font-size:24px;font-weight:400;color:#3f3025;margin:0;">
                Detail Transaksi
            </h1>
            <a href="{{ route('riwayat_transaksi.index') }}"
               style="color:#a89a8c;text-decoration:none;font-size:12px;">
                ← Kembali
            </a>
        </div>

        {{-- Info --}}
        <table style="width:100%;font-size:13px;margin-bottom:20px;">
            <tr style="border-bottom:1px solid #f4eee8;">
                <td style="padding:10px 0;color:#8a7a6a;width:160px;">No. Struk</td>
                <td style="padding:10px 0;font-family:'Courier New',monospace;font-weight:600;">
                    INV-{{ str_pad($penjualan->id, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
            <tr style="border-bottom:1px solid #f4eee8;">
                <td style="padding:10px 0;color:#8a7a6a;">Tanggal</td>
                <td style="padding:10px 0;font-weight:600;">{{ $penjualan->tanggal->format('d-m-Y') }}</td>
            </tr>
            <tr style="border-bottom:1px solid #f4eee8;">
                <td style="padding:10px 0;color:#8a7a6a;">Total Item</td>
                <td style="padding:10px 0;">{{ $penjualan->total_item }}</td>
            </tr>
            <tr style="border-bottom:1px solid #f4eee8;">
                <td style="padding:10px 0;color:#8a7a6a;">Status</td>
                <td style="padding:10px 0;">{{ $penjualan->label_status ?? 'Selesai' }}</td>
            </tr>
            <tr>
                <td style="padding:10px 0;color:#8a7a6a;">Total Harga</td>
                <td style="padding:10px 0;font-weight:700;">
                    Rp {{ number_format($penjualan->total_pemasukan, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        {{-- Detail Produk --}}
        <h3 style="font-size:13px;font-weight:700;color:#3f3025;margin-bottom:10px;">
            Daftar Produk
        </h3>

        <table style="width:100%;font-size:12px;border-collapse:collapse;">
            <thead>
                <tr style="background:#faf7f3;">
                    <th style="padding:8px;text-align:left;font-size:10px;color:#927e6c;text-transform:uppercase;">No</th>
                    <th style="padding:8px;text-align:left;font-size:10px;color:#927e6c;text-transform:uppercase;">Kode</th>
                    <th style="padding:8px;text-align:left;font-size:10px;color:#927e6c;text-transform:uppercase;">Produk</th>
                    <th style="padding:8px;text-align:right;font-size:10px;color:#927e6c;text-transform:uppercase;">Harga</th>
                    <th style="padding:8px;text-align:center;font-size:10px;color:#927e6c;text-transform:uppercase;">Jml</th>
                    <th style="padding:8px;text-align:right;font-size:10px;color:#927e6c;text-transform:uppercase;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualan->detailPenjualan as $i => $d)
                    <tr style="border-bottom:1px solid #f4eee8;">
                        <td style="padding:8px;">{{ $i + 1 }}</td>
                        <td style="padding:8px;font-family:'Courier New',monospace;font-size:11px;">
                            {{ $d->produk->kode_produk ?? '-' }}
                        </td>
                        <td style="padding:8px;">{{ $d->produk->nama_produk ?? '-' }}</td>
                        <td style="padding:8px;text-align:right;">
                            Rp {{ number_format($d->harga_jual, 0, ',', '.') }}
                        </td>
                        <td style="padding:8px;text-align:center;">{{ $d->jumlah }}</td>
                        <td style="padding:8px;text-align:right;font-weight:600;">
                            Rp {{ number_format($d->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:20px;text-align:center;color:#a89a8c;">
                            Tidak ada detail produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection
