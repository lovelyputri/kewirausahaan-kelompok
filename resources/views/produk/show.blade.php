@extends('layout')

@section('title', 'Detail Produk')

@section('content')

<style>
    /* =====================================================
       SCOPE KHUSUS HALAMAN DETAIL PRODUK
    ===================================================== */
    .produk-detail-page * { box-sizing: border-box; }

    /* ---------- BREADCRUMB ---------- */
    .produk-detail-page .breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: "Inter", sans-serif;
        font-size: 12px;
        color: #a89a8c;
        margin-bottom: 14px;
        max-width: 720px;
        margin-left: auto;
        margin-right: auto;
    }
    .produk-detail-page .breadcrumb a {
        color: #a89a8c;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: color .2s;
    }
    .produk-detail-page .breadcrumb a:hover { color: #6b4d38; }
    .produk-detail-page .breadcrumb .sep { color: #d6c9bb; font-size: 14px; }
    .produk-detail-page .breadcrumb .current { color: #3f3025; font-weight: 600; }

    /* ---------- HEADER ---------- */
    .produk-detail-page .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
        flex-wrap: wrap;
        max-width: 720px;
        margin-left: auto;
        margin-right: auto;
    }
    .produk-detail-page .page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .produk-detail-page .page-icon {
        width: 48px;
        height: 48px;
        background: #6b4d38;
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(107,77,56,.28);
    }
    .produk-detail-page .page-icon i { width: 24px; height: 24px; stroke-width: 2; }
    .produk-detail-page .page-title {
        font-family: "DM Serif Display", serif;
        font-size: 26px;
        font-weight: 400;
        color: #3f3025;
        margin: 0 0 2px 0;
        letter-spacing: .3px;
        line-height: 1.1;
    }
    .produk-detail-page .page-subtitle {
        font-family: "Inter", sans-serif;
        font-size: 12px;
        color: #a89a8c;
        margin: 0;
    }
    .produk-detail-page .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f5efe8;
        color: #6b4d38;
        padding: 10px 18px;
        border-radius: 10px;
        font-family: "Inter", sans-serif;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: background .2s;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }
    .produk-detail-page .btn-back:hover { background: #e8ded3; }
    .produk-detail-page .btn-back i { width: 15px; height: 15px; stroke-width: 2.2; }

    /* ---------- DETAIL CARD (CENTER) ---------- */
    .produk-detail-page .detail-card {
        background: #fff;
        border: 1px solid #f0e8de;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 1px 4px rgba(107,77,56,.04);
        max-width: 720px;
        margin: 0 auto;
    }

    /* ---------- HERO (Gambar + Nama) ---------- */
    .produk-detail-page .detail-hero {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-bottom: 22px;
        margin-bottom: 22px;
        border-bottom: 1px solid #f0e8de;
    }
    .produk-detail-page .detail-hero-img {
        width: 100px;
        height: 100px;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #f0e8de;
        background: #faf7f3;
        flex-shrink: 0;
    }
    .produk-detail-page .detail-hero-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .produk-detail-page .detail-hero-info {
        flex: 1;
        min-width: 0;
    }
    .produk-detail-page .detail-hero-name {
        font-family: "DM Serif Display", serif;
        font-size: 24px;
        font-weight: 400;
        color: #3f3025;
        margin: 0 0 6px 0;
        line-height: 1.2;
        letter-spacing: .3px;
    }
    .produk-detail-page .detail-hero-kode {
        font-family: "Courier New", monospace;
        font-size: 12px;
        font-weight: 600;
        color: #a89a8c;
        letter-spacing: .5px;
        margin-bottom: 10px;
    }
    .produk-detail-page .detail-hero-badges {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    /* ---------- BADGE KATEGORI ---------- */
    .produk-detail-page .badge-kategori {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 999px;
        font-family: "Inter", sans-serif;
        font-size: 11.5px;
        font-weight: 600;
        line-height: 1.4;
        white-space: nowrap;
    }
    .produk-detail-page .cat-roti    { background: #e0f2fe; color: #0369a1; }
    .produk-detail-page .cat-pastry  { background: #d1fae5; color: #047857; }
    .produk-detail-page .cat-donat   { background: #fce7f3; color: #be185d; }
    .produk-detail-page .cat-kue     { background: #ede9fe; color: #6d28d9; }
    .produk-detail-page .cat-cookies { background: #fef3c7; color: #b45309; }
    .produk-detail-page .cat-default { background: #f5efe8; color: #6b4d38; }

    /* ---------- BADGE STATUS ---------- */
    .produk-detail-page .badge-status {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 999px;
        font-family: "Inter", sans-serif;
        font-size: 11.5px;
        font-weight: 600;
        line-height: 1.4;
        white-space: nowrap;
    }
    .produk-detail-page .status-tersedia { background: #d1fae5; color: #047857; }
    .produk-detail-page .status-menipis  { background: #fef3c7; color: #b45309; }
    .produk-detail-page .status-kosong   { background: #ffe4e6; color: #be123c; }

    /* ---------- DETAIL LIST ---------- */
    .produk-detail-page .detail-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: "Inter", sans-serif;
        font-size: 12px;
        font-weight: 700;
        color: #6b4d38;
        text-transform: uppercase;
        letter-spacing: .8px;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0e8de;
    }
    .produk-detail-page .detail-section-title i {
        width: 15px; height: 15px;
        stroke-width: 2.2;
        color: #a89a8c;
    }

    .produk-detail-page .detail-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 24px;
    }
    .produk-detail-page .detail-item {
        background: #faf7f3;
        border: 1px solid #f0e8de;
        border-radius: 12px;
        padding: 14px 16px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .produk-detail-page .detail-item-label {
        font-family: "Inter", sans-serif;
        font-size: 11px;
        font-weight: 600;
        color: #a89a8c;
        text-transform: uppercase;
        letter-spacing: .5px;
    }
    .produk-detail-page .detail-item-value {
        font-family: "Inter", sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #3f3025;
        line-height: 1.3;
    }
    .produk-detail-page .detail-item-value.laba {
        color: #047857;
    }

    /* ---------- BUTTONS ---------- */
    .produk-detail-page .form-actions {
        display: flex;
        gap: 10px;
        padding-top: 20px;
        border-top: 1px solid #f0e8de;
    }
    .produk-detail-page .btn-edit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #6b4d38;
        color: #fff;
        padding: 12px 26px;
        border-radius: 10px;
        font-family: "Inter", sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s;
        box-shadow: 0 2px 8px rgba(107,77,56,.22);
        border: none;
        cursor: pointer;
        white-space: nowrap;
        min-width: 140px;
    }
    .produk-detail-page .btn-edit:hover { background: #4a3526; }
    .produk-detail-page .btn-edit i { width: 16px; height: 16px; stroke-width: 2.5; }

    .produk-detail-page .btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #fff1f2;
        color: #e11d48;
        border: 1px solid #fecdd3;
        padding: 12px 26px;
        border-radius: 10px;
        font-family: "Inter", sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        text-decoration: none;
        transition: all .2s;
        cursor: pointer;
        white-space: nowrap;
        min-width: 140px;
    }
    .produk-detail-page .btn-delete:hover {
        background: #e11d48;
        color: #fff;
        border-color: #e11d48;
    }
    .produk-detail-page .btn-delete i { width: 16px; height: 16px; stroke-width: 2.5; }

    /* ---------- RESPONSIVE ---------- */
    @media (max-width: 700px) {
        .produk-detail-page .page-title { font-size: 22px; }

        .produk-detail-page .detail-card { padding: 20px; }

        .produk-detail-page .detail-hero {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 16px;
        }
        .produk-detail-page .detail-hero-img {
            width: 120px;
            height: 120px;
        }
        .produk-detail-page .detail-hero-name {
            font-size: 20px;
        }
        .produk-detail-page .detail-hero-badges {
            justify-content: center;
        }

        .produk-detail-page .detail-list {
            grid-template-columns: 1fr;
        }

        .produk-detail-page .form-actions {
            flex-direction: column;
        }
        .produk-detail-page .btn-edit,
        .produk-detail-page .btn-delete {
            width: 100%;
        }
    }
</style>


<div class="produk-detail-page">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb">
        <a href="#"><i data-lucide="house" style="width:14px;height:14px;"></i></a>
        <span class="sep">›</span>
        <a href="#">Dashboard</a>
        <span class="sep">›</span>
        <a href="{{ route('produk.index') }}">Produk</a>
        <span class="sep">›</span>
        <span class="current">Detail</span>
    </div>

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-icon"><i data-lucide="package"></i></div>
            <div>
                <h1 class="page-title">Detail Produk</h1>
                <p class="page-subtitle">Informasi lengkap produk yang tersedia di toko Anda.</p>
            </div>
        </div>
        <a href="{{ route('produk.index') }}" class="btn-back">
            <i data-lucide="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- DETAIL CARD --}}
    <div class="detail-card">

        @php
            // Kategori class
            $catName = strtolower($produk->kategori->nama_kategori ?? '');
            $catClass = 'cat-default';
            if (str_contains($catName, 'roti')) $catClass = 'cat-roti';
            elseif (str_contains($catName, 'pastry')) $catClass = 'cat-pastry';
            elseif (str_contains($catName, 'donat')) $catClass = 'cat-donat';
            elseif (str_contains($catName, 'kue')) $catClass = 'cat-kue';
            elseif (str_contains($catName, 'cookie') || str_contains($catName, 'kue kering')) $catClass = 'cat-cookies';

            // Status
            if ($produk->stok > 5) {
                $statusClass = 'status-tersedia';
                $statusText = 'Tersedia';
            } elseif ($produk->stok > 0) {
                $statusClass = 'status-menipis';
                $statusText = 'Stok Menipis';
            } else {
                $statusClass = 'status-kosong';
                $statusText = 'Kosong';
            }

            // Laba per unit (fallback kalau tidak ada accessor)
            $laba = $produk->laba ?? ($produk->harga_jual - $produk->harga_beli);
        @endphp

        {{-- HERO --}}
        <div class="detail-hero">
            <div class="detail-hero-img">
                @if(isset($produk->gambar) && $produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                @else
                    <img src="{{ asset('images/roti.png') }}" alt="Produk">
                @endif
            </div>
            <div class="detail-hero-info">
                <h2 class="detail-hero-name">{{ $produk->nama_produk }}</h2>
                <div class="detail-hero-kode">
                    {{ $produk->kode_produk ?? sprintf('%08d', $produk->id) }}
                </div>
                <div class="detail-hero-badges">
                    <span class="badge-kategori {{ $catClass }}">
                        {{ $produk->kategori->nama_kategori ?? '-' }}
                    </span>
                    <span class="badge-status {{ $statusClass }}">
                        {{ $statusText }}
                    </span>
                </div>
            </div>
        </div>

        {{-- SECTION: Informasi Harga --}}
        <div class="detail-section-title">
            <i data-lucide="wallet"></i>
            Informasi Harga
        </div>

        <div class="detail-list">
            <div class="detail-item">
                <span class="detail-item-label">Harga Beli</span>
                <span class="detail-item-value">
                    Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}
                </span>
            </div>
            <div class="detail-item">
                <span class="detail-item-label">Harga Jual</span>
                <span class="detail-item-value">
                    Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                </span>
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <span class="detail-item-label">Laba per Unit</span>
                <span class="detail-item-value laba">
                    Rp {{ number_format($laba, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- SECTION: Informasi Stok --}}
        <div class="detail-section-title">
            <i data-lucide="boxes"></i>
            Informasi Stok
        </div>

        <div class="detail-list" style="margin-bottom:0;">
            <div class="detail-item">
                <span class="detail-item-label">Jumlah Stok</span>
                <span class="detail-item-value">{{ $produk->stok }} Pcs</span>
            </div>
            <div class="detail-item">
                <span class="detail-item-label">Status</span>
                <span class="detail-item-value">
                    <span class="badge-status {{ $statusClass }}">{{ $statusText }}</span>
                </span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <a href="{{ route('produk.edit', $produk->id) }}" class="btn-edit">
                <i data-lucide="pencil"></i>
                Edit Produk
            </a>
            <form method="POST"
                  action="{{ route('produk.destroy', $produk->id) }}"
                  onsubmit="return confirm('Yakin hapus produk ini?')"
                  style="display:contents;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">
                    <i data-lucide="trash-2"></i>
                    Hapus Produk
                </button>
            </form>
        </div>

    </div>

</div>

{{-- Re-init lucide icons --}}
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

@endsection