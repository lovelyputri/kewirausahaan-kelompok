@extends('layout')

@section('title', 'Detail Penjualan')

@section('content')

<div style="max-width:720px;margin:0 auto;font-family:'Inter',sans-serif;color:#4f3929;">

    <div style="background:#fff;border:1px solid #eee5dc;border-radius:14px;padding:24px;">

        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h1 style="font-family:'DM Serif Display',serif;font-size:24px;font-weight:400;color:#3f3025;margin:0;">
                Detail Penjualan
            </h1>
            <a href="{{ route('penjualan.index') }}"
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
            <tr>
                <td style="padding:10px 0;color:#8a7a6a;">Total Harga</td>
                <td style="padding:10px 0;font-weight:700;">
                    Rp {{ number_format($penjualan->total_pemasukan, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        {{-- Detail Produk --}}
        <h3 style="font-size:13px;font-weight:700;color:#3f3025;margin-bottom:10px;">
            Produk yang Dibeli
        </h3>

        @foreach($penjualan->detailPenjualan as $d)
            <div style="display:flex;gap:12px;padding:12px 0;border-bottom:1px dashed #f4eee8;">
                <div style="width:50px;height:50px;border-radius:8px;overflow:hidden;background:#f7f2ed;border:1px solid #eee5dc;flex-shrink:0;">
                    @if($d->produk && $d->produk->gambar)
                        <img src="{{ asset('images/' . $d->produk->gambar) }}"
                             style="width:100%;height:100%;object-fit:cover;"
                             alt="{{ $d->produk->nama_produk }}">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#a89a8c;">
                            <i data-lucide="package" style="width:18px;height:18px;"></i>
                        </div>
                    @endif
                </div>
                <div style="flex:1;">
                    <div style="font-size:13px;font-weight:700;color:#3f3025;">
                        {{ $d->produk->nama_produk ?? '-' }}
                    </div>
                    <div style="font-family:'Courier New',monospace;font-size:10px;color:#a89a8c;">
                        {{ $d->produk->kode_produk ?? '-' }}
                    </div>
                    <div style="font-size:11px;color:#6b4d38;margin-top:4px;">
                        {{ $d->jumlah }} x Rp {{ number_format($d->harga_jual, 0, ',', '.') }}
                    </div>
                </div>
                <div style="font-size:13px;font-weight:700;color:#3f3025;white-space:nowrap;">
                    Rp {{ number_format($d->subtotal, 0, ',', '.') }}
                </div>
            </div>
        @endforeach

        <div style="display:flex;justify-content:space-between;padding-top:14px;margin-top:8px;border-top:2px solid #eee5dc;font-size:14px;font-weight:700;">
            <span>Total</span>
            <span>Rp {{ number_format($penjualan->total_pemasukan, 0, ',', '.') }}</span>
        </div>

    </div>

</div>

<script>
    if (typeof lucide !== 'undefined') lucide.createIcons();
</script>

@endsection
