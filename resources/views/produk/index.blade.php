@extends('layout')

@section('title', 'Data Produk')

@section('content')

<style>
    .produk-page { width: 100%; color: #4f3929; font-family: "Inter", sans-serif; }
    .produk-page * { box-sizing: border-box; }

    .produk-breadcrumb { display: flex; align-items: center; gap: 6px; color: #a89a8c; font-size: 12px; margin-bottom: 12px; }
    .produk-breadcrumb a { color: #a89a8c; text-decoration: none; display: flex; align-items: center; }
    .produk-breadcrumb a:hover { color: #6b4d38; }
    .produk-breadcrumb .current { color: #3f3025; font-weight: 600; }
    .produk-breadcrumb i { width: 14px; height: 14px; }

    /* HEADER */
    .produk-header { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 22px; flex-wrap: wrap; }
    .produk-header-left { display: flex; align-items: center; gap: 14px; }
    .produk-header-icon { width: 48px; height: 48px; background: #6b4d38; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .produk-header-icon i { width: 23px; height: 23px; stroke-width: 1.8; }
    .produk-title { margin: 0; color: #3f3025; font-family: "DM Serif Display", serif; font-size: 28px; font-weight: 400; line-height: 1.15; }
    .produk-subtitle { margin: 4px 0 0; color: #a89a8c; font-size: 12px; }

    /* HEADER ACTIONS */
    .produk-header-actions { display: flex; gap: 10px; flex-wrap: wrap; }
    .btn-tambah-produk { display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: #6b4d38; color: white; padding: 11px 18px; border-radius: 9px; text-decoration: none; font-size: 12px; font-weight: 600; transition: .2s; }
    .btn-tambah-produk:hover { background: #58402f; }
    .btn-tambah-produk i { width: 16px; height: 16px; stroke-width: 2; }
    .btn-tambah-kerugian { display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: #bd4b59; color: white; padding: 11px 18px; border-radius: 9px; text-decoration: none; font-size: 12px; font-weight: 600; transition: .2s; }
    .btn-tambah-kerugian:hover { background: #a43e4a; }
    .btn-tambah-kerugian i { width: 16px; height: 16px; stroke-width: 2; }

    /* STATISTICS */
    .produk-stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 18px; }
    .produk-stat-card { background: #fff; border: 1px solid #eee5dc; border-radius: 13px; padding: 15px 16px; display: flex; align-items: center; gap: 12px; }
    .produk-stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .produk-stat-icon i { width: 19px; height: 19px; stroke-width: 1.8; }
    .stat-total { background: #f5eee7; color: #76553d; }
    .stat-kategori { background: #f2edf8; color: #8063a0; }
    .stat-menipis { background: #fff6df; color: #b47a20; }
    .stat-habis { background: #fcedef; color: #c45260; }
    .produk-stat-label { color: #a89a8c; font-size: 10px; margin-bottom: 3px; }
    .produk-stat-value { color: #3f3025; font-size: 19px; font-weight: 700; }

    /* FILTER */
    .produk-filter-card { background: #fff; border: 1px solid #eee5dc; border-radius: 13px; padding: 15px 16px; margin-bottom: 16px; }
    .produk-filter-form { display: grid; grid-template-columns: minmax(220px, 1.5fr) minmax(160px, 1fr) minmax(150px, 1fr) auto; gap: 9px; align-items: end; }
    .produk-filter-group { display: flex; flex-direction: column; gap: 5px; }
    .produk-filter-label { color: #8e7b6a; font-size: 10px; font-weight: 600; }
    .produk-input, .produk-select { width: 100%; height: 38px; border: 1px solid #e8ddd2; border-radius: 8px; background: #fffdfb; color: #4f3929; padding: 0 11px; outline: none; font-family: "Inter", sans-serif; font-size: 11px; }
    .produk-input:focus, .produk-select:focus { border-color: #8b6a50; box-shadow: 0 0 0 3px rgba(107, 77, 56, .08); background: #fff; }
    .produk-search-wrap { position: relative; }
    .produk-search-wrap i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; color: #9c8a79; pointer-events: none; }
    .produk-search-wrap .produk-input { padding-left: 34px; }
    .produk-filter-actions { display: flex; gap: 7px; }
    .btn-filter, .btn-reset { height: 38px; border-radius: 8px; font-size: 11px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; }
    .btn-filter { padding: 0 15px; border: none; background: #6b4d38; color: white; }
    .btn-filter:hover { background: #58402f; }
    .btn-filter i { width: 14px; height: 14px; stroke-width: 1.8; }
    .btn-reset { padding: 0 13px; background: #f5eee7; color: #6b4d38; text-decoration: none; border: 1px solid #eaded2; }
    .btn-reset:hover { background: #eee2d6; }

    /* CONTENT */
    .produk-content-layout { display: grid; grid-template-columns: minmax(0, 1fr); gap: 16px; transition: .25s ease; }
    .produk-content-layout.has-detail { grid-template-columns: minmax(0, 1fr) 360px; }

    /* TABLE */
    .produk-table-card { background: white; border: 1px solid #eee5dc; border-radius: 13px; overflow: hidden; min-width: 0; }
    .produk-table-header { display: flex; align-items: center; justify-content: space-between; padding: 15px 16px; border-bottom: 1px solid #eee5dc; }
    .produk-table-title { margin: 0; color: #3f3025; font-size: 13px; font-weight: 700; }
    .produk-table-count { margin-top: 2px; color: #a89a8c; font-size: 10px; }
    .produk-table-wrapper { width: 100%; overflow-x: auto; }
    .produk-table { width: 100%; border-collapse: collapse; min-width: 800px; }
    .produk-table th { background: #faf7f3; color: #927e6c; padding: 10px 13px; font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: .45px; text-align: left; white-space: nowrap; }
    .produk-table td { padding: 10px 13px; border-top: 1px solid #f4eee8; color: #5f4b3a; font-size: 11px; vertical-align: middle; }
    .produk-table tbody tr:hover { background: #fffbf7; }

    .produk-image { width: 39px; height: 39px; border-radius: 8px; object-fit: cover; border: 1px solid #eee5dc; background: #faf7f3; }
    .produk-image-placeholder { width: 39px; height: 39px; border-radius: 8px; background: #f5efe8; color: #9b8069; display: flex; align-items: center; justify-content: center; }
    .produk-image-placeholder i { width: 17px; height: 17px; stroke-width: 1.6; }
    .produk-name { color: #3f3025; font-size: 11px; font-weight: 700; }
    .produk-code { color: #a89a8c; font-family: "Courier New", monospace; font-size: 9px; margin-top: 2px; }
    .produk-price { color: #4f3929; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .produk-stock { color: #3f3025; font-size: 11px; font-weight: 700; }

    .produk-category { display: inline-flex; align-items: center; padding: 4px 8px; background: #f5efe8; color: #72563f; border-radius: 999px; font-size: 9px; font-weight: 600; white-space: nowrap; }

    .produk-status { display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 999px; font-size: 9px; font-weight: 700; white-space: nowrap; }
    .status-tersedia { background: #e3f4eb; color: #237450; }
    .status-menipis { background: #fff3d5; color: #a96e16; }
    .status-habis { background: #fde8eb; color: #bd4b59; }

    /* AKSI */
    .produk-actions { display: inline-flex; align-items: center; gap: 3px; }
    .produk-action { width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center; border: none; border-radius: 7px; background: transparent; text-decoration: none; padding: 0; cursor: pointer; transition: background .18s ease, color .18s ease; }
    .produk-action i { width: 15px; height: 15px; stroke-width: 1.7; }
    .action-view { color: #80644f; }
    .action-view:hover { background: #f4eee8; color: #5f432f; }
    .action-edit { color: #a8752e; }
    .action-edit:hover { background: #fff5df; color: #8c5f1d; }
    .action-delete { color: #b96670; }
    .action-delete:hover { background: #fdf0f1; color: #a44854; }

    /* DETAIL PANEL */
    .produk-detail-panel { display: none; background: #fff; border: 1px solid #eee5dc; border-radius: 13px; overflow: hidden; min-width: 0; align-self: start; position: sticky; top: 20px; }
    .produk-detail-panel.is-open { display: block; }
    .detail-panel-head { display: flex; align-items: center; justify-content: space-between; padding: 13px 15px; border-bottom: 1px solid #eee5dc; }
    .detail-panel-title { color: #3f3025; font-size: 12px; font-weight: 700; }
    .detail-panel-close { width: 27px; height: 27px; display: inline-flex; align-items: center; justify-content: center; border: none; background: #f7f1eb; color: #806b59; border-radius: 7px; cursor: pointer; }
    .detail-panel-close:hover { background: #eee3d8; }
    .detail-panel-close i { width: 14px; height: 14px; }
    .detail-panel-body { padding: 16px; }

    .detail-product-top { display: flex; gap: 12px; padding-bottom: 15px; margin-bottom: 15px; border-bottom: 1px solid #eee5dc; }
    .detail-product-image { width: 72px; height: 72px; flex-shrink: 0; border-radius: 11px; overflow: hidden; background: #f7f2ed; border: 1px solid #eee5dc; }
    .detail-product-image img { width: 100%; height: 100%; object-fit: cover; }
    .detail-product-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #9d826a; }
    .detail-product-placeholder i { width: 25px; height: 25px; stroke-width: 1.5; }
    .detail-product-info { min-width: 0; padding-top: 2px; }
    .detail-product-name { color: #3f3025; font-family: "DM Serif Display", serif; font-size: 19px; font-weight: 400; line-height: 1.2; margin: 0 0 4px; }
    .detail-product-code { color: #a89a8c; font-family: "Courier New", monospace; font-size: 9px; margin-bottom: 8px; }
    .detail-badges { display: flex; flex-wrap: wrap; gap: 5px; }
    .detail-badge { display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 999px; font-size: 9px; font-weight: 700; }
    .detail-category { background: #f5efe8; color: #70543d; }
    .detail-status-available { background: #e3f4eb; color: #237450; }
    .detail-status-low { background: #fff3d5; color: #a96e16; }
    .detail-status-empty { background: #fde8eb; color: #bd4b59; }

    .detail-section { margin-bottom: 17px; }
    .detail-section-title { display: flex; align-items: center; gap: 6px; color: #745840; font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: .7px; padding-bottom: 8px; margin-bottom: 8px; border-bottom: 1px solid #eee5dc; }
    .detail-section-title i { width: 13px; height: 13px; stroke-width: 1.8; }
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 7px; }
    .detail-item { padding: 10px; background: #faf7f3; border: 1px solid #eee5dc; border-radius: 8px; }
    .detail-item.full { grid-column: 1 / -1; }
    .detail-item-label { display: block; color: #a89a8c; font-size: 8px; font-weight: 600; text-transform: uppercase; letter-spacing: .4px; margin-bottom: 3px; }
    .detail-item-value { color: #3f3025; font-size: 11px; font-weight: 700; }
    .detail-item-value.laba { color: #237450; }

    .detail-actions { display: flex; gap: 7px; padding-top: 14px; border-top: 1px solid #eee5dc; }
    .detail-edit-btn, .detail-delete-btn { flex: 1; height: 34px; display: inline-flex; align-items: center; justify-content: center; gap: 6px; border-radius: 8px; font-size: 10px; font-weight: 600; text-decoration: none; cursor: pointer; }
    .detail-edit-btn { background: #6b4d38; color: white; border: 1px solid #6b4d38; }
    .detail-edit-btn:hover { background: #58402f; }
    .detail-delete-btn { background: #fff5f5; color: #c65b68; border: 1px solid #f1d9dd; }
    .detail-delete-btn:hover { background: #fde9eb; }
    .detail-edit-btn i, .detail-delete-btn i { width: 13px; height: 13px; }

    .detail-loading { padding: 45px 20px; text-align: center; color: #a89a8c; font-size: 11px; }
    .detail-loading i { width: 23px; height: 23px; margin-bottom: 8px; animation: spin .8s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }

    .produk-empty { padding: 50px 20px; text-align: center; }
    .produk-empty-icon { width: 50px; height: 50px; background: #f5efe8; color: #9c8068; border-radius: 13px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; }
    .produk-empty-icon i { width: 22px; height: 22px; }
    .produk-empty-title { color: #4f3929; font-size: 13px; font-weight: 700; margin-bottom: 4px; }
    .produk-empty-text { color: #a89a8c; font-size: 10px; }

    @media (max-width: 1100px) {
        .produk-stat-grid { grid-template-columns: repeat(2, 1fr); }
        .produk-filter-form { grid-template-columns: 1fr 1fr; }
        .produk-filter-actions { grid-column: 1 / -1; }
        .produk-content-layout.has-detail { grid-template-columns: minmax(0, 1fr) 340px; }
    }
    @media (max-width: 850px) {
        .produk-content-layout.has-detail { grid-template-columns: 1fr; }
        .produk-detail-panel { position: fixed; top: 80px; right: 15px; bottom: 15px; width: min(400px, calc(100vw - 30px)); z-index: 100; overflow-y: auto; box-shadow: 0 12px 40px rgba(50, 35, 25, .18); }
    }
    @media (max-width: 600px) {
        .produk-stat-grid { grid-template-columns: 1fr 1fr; gap: 9px; }
        .produk-stat-card { padding: 12px; }
        .produk-filter-form { grid-template-columns: 1fr; }
        .produk-filter-actions { grid-column: auto; }
        .btn-filter, .btn-reset { flex: 1; }
        .produk-header { align-items: flex-start; }
        .produk-header-actions { width: 100%; }
        .btn-tambah-produk, .btn-tambah-kerugian { flex: 1; }
    }
</style>


<div class="produk-page">

    {{-- BREADCRUMB --}}
    <div class="produk-breadcrumb">
        <a href="{{ route('produk.index') }}"><i data-lucide="house"></i></a>
        <span>›</span>
        <span class="current">Dashboard</span>
        <span>›</span>
        <span class="current">Produk</span>
    </div>

    {{-- HEADER --}}
    <div class="produk-header">
        <div class="produk-header-left">
            <div class="produk-header-icon">
                <i data-lucide="package"></i>
            </div>
            <div>
                <h1 class="produk-title">Data Produk</h1>
                <p class="produk-subtitle">Kelola produk, stok, harga, dan informasi produk.</p>
            </div>
        </div>
        <div class="produk-header-actions">
            <a href="{{ route('produk.create') }}" class="btn-tambah-produk">
                <i data-lucide="plus"></i>
                Tambah Produk
            </a>
            <a href="{{ route('kerugian.create') }}" class="btn-tambah-kerugian">
                <i data-lucide="alert-triangle"></i>
                Tambah Kerugian
            </a>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="produk-stat-grid">
        <div class="produk-stat-card">
            <div class="produk-stat-icon stat-total"><i data-lucide="package"></i></div>
            <div>
                <div class="produk-stat-label">Total Produk</div>
                <div class="produk-stat-value">{{ $totalProduk }}</div>
            </div>
        </div>
        <div class="produk-stat-card">
            <div class="produk-stat-icon stat-kategori"><i data-lucide="layers-3"></i></div>
            <div>
                <div class="produk-stat-label">Kategori</div>
                <div class="produk-stat-value">{{ $kategoris->count() }}</div>
            </div>
        </div>
        <div class="produk-stat-card">
            <div class="produk-stat-icon stat-menipis"><i data-lucide="triangle-alert"></i></div>
            <div>
                <div class="produk-stat-label">Produk Menipis</div>
                <div class="produk-stat-value">{{ $stokMenipis }}</div>
            </div>
        </div>
        <div class="produk-stat-card">
            <div class="produk-stat-icon stat-habis"><i data-lucide="package-x"></i></div>
            <div>
                <div class="produk-stat-label">Produk Kosong</div>
                <div class="produk-stat-value">{{ $stokHabis }}</div>
            </div>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="produk-filter-card">
        <form action="{{ route('produk.index') }}" method="GET" class="produk-filter-form">
            <div class="produk-filter-group">
                <label class="produk-filter-label">Cari Produk</label>
                <div class="produk-search-wrap">
                    <i data-lucide="search"></i>
                    <input type="text" name="keyword" class="produk-input" placeholder="Cari nama atau kode produk..." value="{{ request('keyword') }}">
                </div>
            </div>
            <div class="produk-filter-group">
                <label class="produk-filter-label">Kategori</label>
                <select name="id_kategori" class="produk-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('id_kategori') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="produk-filter-group">
                <label class="produk-filter-label">Status Stok</label>
                <select name="status" class="produk-select">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="menipis" {{ request('status') == 'menipis' ? 'selected' : '' }}>Menipis</option>
                    <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>
            <div class="produk-filter-actions">
                <button type="submit" class="btn-filter">
                    <i data-lucide="search"></i>
                    Cari
                </button>
                <a href="{{ route('produk.index') }}" class="btn-reset">Reset</a>
            </div>
        </form>
    </div>

    {{-- CONTENT --}}
    <div class="produk-content-layout" id="produkContentLayout">

        {{-- TABLE --}}
        <div class="produk-table-card">
            <div class="produk-table-header">
                <div>
                    <h2 class="produk-table-title">Daftar Produk</h2>
                    <div class="produk-table-count">Menampilkan {{ $produks->count() }} produk</div>
                </div>
            </div>

            @if($produks->count() > 0)
                <div class="produk-table-wrapper">
                    <table class="produk-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produks as $produk)
                                <tr>
                                    <td>
                                        <div style="display:flex; align-items:center; gap:9px;">
                                            @if(!empty($produk->gambar))
                                                <img src="{{ asset('images/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="produk-image">
                                            @else
                                                <div class="produk-image-placeholder">
                                                    <i data-lucide="package"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="produk-name">{{ $produk->nama_produk }}</div>
                                                <div class="produk-code">{{ $produk->kode_produk ?? sprintf('%08d', $produk->id) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="produk-category">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="produk-price">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="produk-price">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="produk-stock">{{ $produk->stok }}</span>
                                    </td>
                                    <td>
                                        @if($produk->stok > 5)
                                            <span class="produk-status status-tersedia">Tersedia</span>
                                        @elseif($produk->stok > 0)
                                            <span class="produk-status status-menipis">Menipis</span>
                                        @else
                                            <span class="produk-status status-habis">Habis</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="produk-actions">
                                            <button type="button"
                                                    class="produk-action action-view js-view-produk"
                                                    title="Lihat Detail"
                                                    data-nama="{{ $produk->nama_produk }}"
                                                    data-kode="{{ $produk->kode_produk ?? sprintf('%08d', $produk->id) }}"
                                                    data-kategori="{{ $produk->kategori->nama_kategori ?? '-' }}"
                                                    data-harga-beli="{{ $produk->harga_beli }}"
                                                    data-harga-jual="{{ $produk->harga_jual }}"
                                                    data-stok="{{ $produk->stok }}"
                                                    data-gambar="{{ !empty($produk->gambar) ? asset('images/' . $produk->gambar) : '' }}"
                                                    data-edit-url="{{ route('produk.edit', $produk->id) }}"
                                                    data-delete-url="{{ route('produk.destroy', $produk->id) }}">
                                                <i data-lucide="eye"></i>
                                            </button>
                                            <a href="{{ route('produk.edit', $produk->id) }}"
                                               class="produk-action action-edit"
                                               title="Edit Produk">
                                                <i data-lucide="square-pen"></i>
                                            </a>
                                            <form action="{{ route('produk.destroy', $produk->id) }}"
                                                  method="POST"
                                                  style="margin:0;"
                                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="produk-action action-delete"
                                                        title="Hapus Produk">
                                                    <i data-lucide="trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="produk-empty">
                    <div class="produk-empty-icon">
                        <i data-lucide="package-open"></i>
                    </div>
                    <div class="produk-empty-title">Produk tidak ditemukan</div>
                    <div class="produk-empty-text">Belum ada produk yang sesuai dengan pencarian atau filter.</div>
                </div>
            @endif
        </div>

        {{-- PANEL DETAIL --}}
        <aside class="produk-detail-panel" id="produkDetailPanel">
            <div class="detail-loading">
                <i data-lucide="loader-circle"></i>
                <div>Memuat detail produk...</div>
            </div>
        </aside>

    </div>
</div>

<script>
    if (typeof lucide !== 'undefined') lucide.createIcons();
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const layout = document.getElementById('produkContentLayout');
    const panel = document.getElementById('produkDetailPanel');

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID').format(Number(value || 0));
    }

    function escapeHtml(value) {
        if (value === null || value === undefined) return '';
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function getStatus(stok) {
        stok = Number(stok || 0);
        if (stok > 5) return { text: 'Tersedia', className: 'detail-status-available' };
        if (stok > 0) return { text: 'Stok Menipis', className: 'detail-status-low' };
        return { text: 'Kosong', className: 'detail-status-empty' };
    }

    document.addEventListener('click', function (event) {
        const button = event.target.closest('.js-view-produk');
        if (!button) return;

        const nama = button.dataset.nama || '-';
        const kode = button.dataset.kode || '-';
        const kategori = button.dataset.kategori || '-';
        const hargaBeli = Number(button.dataset.hargaBeli || 0);
        const hargaJual = Number(button.dataset.hargaJual || 0);
        const stok = Number(button.dataset.stok || 0);
        const gambar = button.dataset.gambar || '';
        const editUrl = button.dataset.editUrl || '#';
        const deleteUrl = button.dataset.deleteUrl || '#';

        const laba = hargaJual - hargaBeli;
        const status = getStatus(stok);

        layout.classList.add('has-detail');
        panel.classList.add('is-open');

        let imageHtml = '';
        if (gambar) {
            imageHtml = `<img src="${escapeHtml(gambar)}" alt="${escapeHtml(nama)}">`;
        } else {
            imageHtml = `
                <div class="detail-product-placeholder">
                    <i data-lucide="package"></i>
                </div>
            `;
        }

        panel.innerHTML = `
            <div class="detail-panel-head">
                <div class="detail-panel-title">Detail Produk</div>
                <button type="button" class="detail-panel-close" id="closeProdukDetail">
                    <i data-lucide="x"></i>
                </button>
            </div>
            <div class="detail-panel-body">
                <div class="detail-product-top">
                    <div class="detail-product-image">${imageHtml}</div>
                    <div class="detail-product-info">
                        <h2 class="detail-product-name">${escapeHtml(nama)}</h2>
                        <div class="detail-product-code">${escapeHtml(kode)}</div>
                        <div class="detail-badges">
                            <span class="detail-badge detail-category">${escapeHtml(kategori)}</span>
                            <span class="detail-badge ${status.className}">${status.text}</span>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <i data-lucide="wallet"></i>
                        Informasi Harga
                    </div>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-item-label">Harga Beli</span>
                            <span class="detail-item-value">Rp ${formatRupiah(hargaBeli)}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-item-label">Harga Jual</span>
                            <span class="detail-item-value">Rp ${formatRupiah(hargaJual)}</span>
                        </div>
                        <div class="detail-item full">
                            <span class="detail-item-label">Laba per Unit</span>
                            <span class="detail-item-value laba">Rp ${formatRupiah(laba)}</span>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <i data-lucide="boxes"></i>
                        Informasi Stok
                    </div>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-item-label">Jumlah Stok</span>
                            <span class="detail-item-value">${stok} Pcs</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-item-label">Status</span>
                            <span class="detail-item-value">${status.text}</span>
                        </div>
                    </div>
                </div>

                <div class="detail-actions">
                    <a href="${escapeHtml(editUrl)}" class="detail-edit-btn">
                        <i data-lucide="square-pen"></i>
                        Edit
                    </a>
                    <form action="${escapeHtml(deleteUrl)}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                          style="flex:1;margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="detail-delete-btn" style="width:100%;">
                            <i data-lucide="trash-2"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        `;

        if (typeof lucide !== 'undefined') lucide.createIcons();

        const closeBtn = document.getElementById('closeProdukDetail');
        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                panel.classList.remove('is-open');
                layout.classList.remove('has-detail');
            });
        }
    });
});
</script>

@endsection
