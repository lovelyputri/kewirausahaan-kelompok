@extends('layout')

@section('title', 'Data Produk')

@section('content')

<style>
    /* =====================================================
       SCOPE KHUSUS HALAMAN PRODUK
    ===================================================== */
    .produk-page * { box-sizing: border-box; }

    /* ---------- BREADCRUMB ---------- */
    .produk-page .breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: "Inter", sans-serif;
        font-size: 12px;
        color: #a89a8c;
        margin-bottom: 14px;
        flex-wrap: wrap;
    }
    .produk-page .breadcrumb a {
        color: #a89a8c;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: color .2s;
    }
    .produk-page .breadcrumb a:hover { color: #6b4d38; }
    .produk-page .breadcrumb .sep { color: #d6c9bb; font-size: 14px; }
    .produk-page .breadcrumb .current { color: #3f3025; font-weight: 600; }

    /* ---------- HEADER ---------- */
    .produk-page .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }
    .produk-page .page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }
    .produk-page .page-icon {
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
    .produk-page .page-icon i { width: 24px; height: 24px; stroke-width: 2; }
    .produk-page .page-title {
        font-family: "DM Serif Display", serif;
        font-size: 26px;
        font-weight: 400;
        color: #3f3025;
        margin: 0 0 2px 0;
        letter-spacing: .3px;
        line-height: 1.1;
    }
    .produk-page .page-subtitle {
        font-family: "Inter", sans-serif;
        font-size: 12px;
        color: #a89a8c;
        margin: 0;
    }
    .produk-page .btn-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #6b4d38;
        color: #fff;
        padding: 11px 20px;
        border-radius: 8px;
        font-family: "Inter", sans-serif;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s;
        box-shadow: 0 2px 8px rgba(107,77,56,.22);
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }
    .produk-page .btn-add:hover { background: #4a3526; }
    .produk-page .btn-add i { width: 16px; height: 16px; stroke-width: 2.5; }

    /* ---------- STATISTIK ---------- */
    .produk-page .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 22px;
    }
    .produk-page .stat-card {
        background: #fff;
        border: 1px solid #f0e8de;
        border-radius: 16px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 1px 4px rgba(107,77,56,.04);
        min-width: 0;
    }
    .produk-page .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .produk-page .stat-icon i { width: 22px; height: 22px; stroke-width: 2; }
    .produk-page .stat-label {
        font-family: "Inter", sans-serif;
        font-size: 12px;
        color: #8a7a6d;
        font-weight: 500;
        margin: 0 0 2px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .produk-page .stat-value {
        font-family: "Inter", sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: #3f3025;
        line-height: 1.1;
        margin: 0;
    }
    .produk-page .stat-sub {
        font-family: "Inter", sans-serif;
        font-size: 10px;
        color: #b8aa9c;
        margin: 2px 0 0 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ---------- FILTER BAR ---------- */
    .produk-page .filter-bar {
        background: #fff;
        border: 1px solid #f0e8de;
        border-radius: 16px;
        padding: 14px;
        margin-bottom: 20px;
        box-shadow: 0 1px 4px rgba(107,77,56,.04);
    }
    .produk-page .filter-form {
        display: grid;
        grid-template-columns: 1fr 200px 200px auto;
        gap: 12px;
        align-items: center;
    }
    .produk-page .filter-search {
        position: relative;
        min-width: 0;
    }
    .produk-page .filter-search .icon-search {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #a89a8c;
        pointer-events: none;
        z-index: 2;
    }
    .produk-page .filter-search input {
        width: 100%;
        height: 44px;
        padding: 0 16px 0 42px;
        background: #faf7f3;
        border: 1px solid #f0e8de;
        border-radius: 10px;
        font-family: "Inter", sans-serif;
        font-size: 13px;
        color: #3f3025;
        outline: none;
        transition: all .2s;
    }
    .produk-page .filter-search input::placeholder { color: #b8aa9c; }
    .produk-page .filter-search input:focus {
        border-color: #6b4d38;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(107,77,56,.08);
    }

    /* ---------- CUSTOM DROPDOWN ---------- */
    .produk-page .dropdown {
        position: relative;
        width: 100%;
        min-width: 0;
    }
    .produk-page .dropdown-toggle {
        width: 100%;
        height: 44px;
        padding: 0 36px 0 40px;
        background: #faf7f3;
        border: 1px solid #f0e8de;
        border-radius: 10px;
        font-family: "Inter", sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: #3f3025;
        cursor: pointer;
        display: flex;
        align-items: center;
        text-align: left;
        transition: all .2s;
        position: relative;
    }
    .produk-page .dropdown-toggle:hover { background: #f5efe8; }
    .produk-page .dropdown.open .dropdown-toggle {
        border-color: #6b4d38;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(107,77,56,.08);
    }
    .produk-page .dropdown-toggle .icon-lead {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #8a7a6d;
        pointer-events: none;
    }
    .produk-page .dropdown-toggle .icon-chevron {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #a89a8c;
        pointer-events: none;
        transition: transform .2s;
    }
    .produk-page .dropdown.open .icon-chevron {
        transform: translateY(-50%) rotate(180deg);
    }
    .produk-page .dropdown-label {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .produk-page .dropdown-menu {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #f0e8de;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(107,77,56,.12);
        padding: 6px;
        z-index: 50;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-4px);
        transition: all .18s ease;
        max-height: 260px;
        overflow-y: auto;
    }
    .produk-page .dropdown.open .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .produk-page .dropdown-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        border-radius: 8px;
        font-family: "Inter", sans-serif;
        font-size: 13px;
        color: #4a3d33;
        cursor: pointer;
        transition: background .15s;
        text-decoration: none;
        border: none;
        background: transparent;
        width: 100%;
        text-align: left;
    }
    .produk-page .dropdown-item:hover {
        background: #faf7f3;
        color: #6b4d38;
    }
    .produk-page .dropdown-item.selected {
        background: #f5efe8;
        color: #6b4d38;
        font-weight: 600;
    }
    .produk-page .dropdown-item .check {
        margin-left: auto;
        width: 14px;
        height: 14px;
        color: #6b4d38;
        opacity: 0;
    }
    .produk-page .dropdown-item.selected .check { opacity: 1; }

    /* ---------- RESET BUTTON ---------- */
    .produk-page .btn-reset {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        height: 44px;
        padding: 0 18px;
        background: #f5efe8;
        color: #6b4d38;
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
    .produk-page .btn-reset:hover { background: #e8ded3; }
    .produk-page .btn-reset i { width: 15px; height: 15px; stroke-width: 2; }

    /* ---------- TABLE ---------- */
    .produk-page .table-wrap {
        background: #fff;
        border: 1px solid #f0e8de;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(107,77,56,.04);
    }
    .produk-page .table-scroll {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .produk-page table.produk-table {
        width: 100%;
        border-collapse: collapse;
        font-family: "Inter", sans-serif;
        font-size: 13px;
        min-width: 900px;
    }
    .produk-page table.produk-table thead tr { background: #6b4d38; }
    .produk-page table.produk-table thead th {
        padding: 15px 16px;
        text-align: left;
        font-family: "Inter", sans-serif;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
        color: #fff;
        white-space: nowrap;
    }
    .produk-page table.produk-table thead th.center { text-align: center; }

    /* Kolom sticky (Kode barang di kiri, Aksi di kanan) */
    .produk-page table.produk-table thead th.col-kode,
    .produk-page table.produk-table tbody td.col-kode {
        position: sticky;
        left: 0;
        z-index: 5;
        background: #fff;
    }
    .produk-page table.produk-table thead th.col-kode {
        background: #6b4d38;
    }

    .produk-page table.produk-table tbody tr {
        border-bottom: 1px solid #f5efe8;
        transition: background .15s;
    }
    .produk-page table.produk-table tbody tr:last-child { border-bottom: none; }
    .produk-page table.produk-table tbody tr:hover { background: #faf7f3; }
    .produk-page table.produk-table tbody tr:hover td.col-kode { background: #faf7f3; }
    .produk-page table.produk-table tbody td {
        padding: 13px 16px;
        color: #4a3d33;
        vertical-align: middle;
        font-family: "Inter", sans-serif;
        background: #fff;
    }
    .produk-page table.produk-table tbody td.center { text-align: center; }

    .produk-page .kode-barang {
        font-family: "Courier New", monospace;
        font-size: 12px;
        font-weight: 600;
        color: #6b4d38;
        letter-spacing: .5px;
        white-space: nowrap;
    }
    .produk-page .img-thumb {
        width: 48px;
        height: 40px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #f0e8de;
        background: #faf7f3;
        flex-shrink: 0;
        display: block;
    }
    .produk-page .img-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .produk-page .nama-barang {
        font-weight: 600;
        color: #3f3025;
        white-space: nowrap;
    }
    .produk-page .badge-kategori {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        line-height: 1.4;
        white-space: nowrap;
    }
    .produk-page .cat-roti    { background: #e0f2fe; color: #0369a1; }
    .produk-page .cat-pastry  { background: #d1fae5; color: #047857; }
    .produk-page .cat-donat   { background: #fce7f3; color: #be185d; }
    .produk-page .cat-kue     { background: #ede9fe; color: #6d28d9; }
    .produk-page .cat-cookies { background: #fef3c7; color: #b45309; }
    .produk-page .cat-default { background: #f5efe8; color: #6b4d38; }

    .produk-page .badge-status {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        line-height: 1.4;
        white-space: nowrap;
    }
    .produk-page .status-tersedia { background: #d1fae5; color: #047857; }
    .produk-page .status-menipis  { background: #fef3c7; color: #b45309; }
    .produk-page .status-kosong   { background: #ffe4e6; color: #be123c; }

    /* =====================================================
       AKSI BUTTONS
    ===================================================== */
    .produk-page .aksi-group {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }
    .produk-page .btn-aksi {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: none;
        background: transparent;
        color: #8a7a6d;
        cursor: pointer;
        transition: all .2s ease;
        text-decoration: none;
        padding: 0;
        position: relative;
    }
    .produk-page .btn-aksi i { width: 16px; height: 16px; stroke-width: 2; }
    .produk-page .btn-view:hover { background: #ecfdf5; color: #059669; transform: scale(1.08); }
    .produk-page .btn-edit:hover { background: #fffbeb; color: #d97706; transform: scale(1.08); }
    .produk-page .btn-delete:hover { background: #fff1f2; color: #e11d48; transform: scale(1.08); }

    /* Tooltip */
    .produk-page .btn-aksi::after {
        content: attr(data-tip);
        position: absolute;
        bottom: calc(100% + 6px);
        left: 50%;
        transform: translateX(-50%) translateY(4px);
        background: #3f3025;
        color: #fff;
        padding: 5px 10px;
        border-radius: 6px;
        font-family: "Inter", sans-serif;
        font-size: 10px;
        font-weight: 500;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: all .18s ease;
        z-index: 100;
        letter-spacing: .3px;
    }
    .produk-page .btn-aksi:hover::after {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    .produk-page .empty-state {
        padding: 60px 16px;
        text-align: center;
        color: #a89a8c;
        font-family: "Inter", sans-serif;
        font-size: 13px;
    }
    .produk-page .empty-state i {
        width: 36px; height: 36px;
        color: #d6c9bb;
        margin-bottom: 10px;
        display: inline-block;
        stroke-width: 1.5;
    }

    /* =====================================================
       PAGINATION
    ===================================================== */
    .produk-page .pagination-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 16px 20px;
        border-top: 1px solid #f5efe8;
        background: #fff;
        flex-wrap: wrap;
    }
    .produk-page .pagination-info {
        font-family: "Inter", sans-serif;
        font-size: 12px;
        color: #8a7a6d;
    }
    .produk-page .pagination-info strong {
        color: #3f3025;
        font-weight: 600;
    }
    .produk-page .pagination {
        display: flex;
        align-items: center;
        gap: 4px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .produk-page .pagination li { display: inline-block; }
    .produk-page .pagination a,
    .produk-page .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 10px;
        border-radius: 8px;
        font-family: "Inter", sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: #6b4d38;
        text-decoration: none;
        background: #faf7f3;
        border: 1px solid #f0e8de;
        transition: all .15s;
        cursor: pointer;
    }
    .produk-page .pagination a:hover {
        background: #f5efe8;
        border-color: #e8ded3;
    }
    .produk-page .pagination .active span {
        background: #6b4d38;
        color: #fff;
        border-color: #6b4d38;
        font-weight: 600;
    }
    .produk-page .pagination .disabled span {
        opacity: .4;
        cursor: not-allowed;
        background: #faf7f3;
    }
    .produk-page .pagination .dots span {
        background: transparent;
        border: none;
        cursor: default;
        color: #a89a8c;
    }
    .produk-page .pagination i { width: 14px; height: 14px; }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    /* Tablet besar */
    @media (max-width: 1200px) {
        .produk-page .filter-form {
            grid-template-columns: 1fr 180px 180px auto;
        }
    }

    /* Tablet */
    @media (max-width: 1024px) {
        .produk-page .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .produk-page .filter-form {
            grid-template-columns: 1fr 1fr;
            grid-template-areas:
                "search search"
                "kat status"
                "reset reset";
        }
        .produk-page .filter-search { grid-area: search; }
        .produk-page .filter-form > .dropdown:nth-of-type(1) { grid-area: kat; }
        .produk-page .filter-form > .dropdown:nth-of-type(2) { grid-area: status; }
        .produk-page .btn-reset { grid-area: reset; }
    }

    /* Mobile */
    @media (max-width: 700px) {
        .produk-page .page-header {
            flex-direction: column;
            align-items: stretch;
        }
        .produk-page .page-title { font-size: 22px; }
        .produk-page .btn-add { width: 100%; }

        .produk-page .stats-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .produk-page .stat-card {
            padding: 14px 16px;
        }

        .produk-page .filter-form {
            grid-template-columns: 1fr;
            grid-template-areas:
                "search"
                "kat"
                "status"
                "reset";
            gap: 10px;
        }

        .produk-page table.produk-table {
            font-size: 12.5px;
            min-width: 760px;
        }
        .produk-page table.produk-table thead th,
        .produk-page table.produk-table tbody td {
            padding: 11px 12px;
        }

        /* Sembunyikan kolom Gambar di mobile (opsional) */
        .produk-page table.produk-table thead th.col-gambar,
        .produk-page table.produk-table tbody td.col-gambar {
            display: none;
        }

        .produk-page .pagination-wrap {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
            padding: 14px 16px;
        }
        .produk-page .pagination {
            justify-content: center;
            flex-wrap: wrap;
        }
        .produk-page .pagination a,
        .produk-page .pagination span {
            min-width: 32px;
            height: 32px;
            font-size: 12.5px;
            padding: 0 8px;
        }
    }

    /* Mobile kecil */
    @media (max-width: 400px) {
        .produk-page .stat-card {
            padding: 12px 14px;
            gap: 10px;
        }
        .produk-page .stat-icon {
            width: 40px;
            height: 40px;
        }
        .produk-page .stat-icon i { width: 18px; height: 18px; }
        .produk-page .stat-value { font-size: 20px; }
        .produk-page .stat-label { font-size: 11px; }
    }
</style>


<div class="produk-page">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb">
        <a href="#"><i data-lucide="house" style="width:14px;height:14px;"></i></a>
        <span class="sep">›</span>
        <a href="#">Dashboard</a>
        <span class="sep">›</span>
        <span class="current">Produk</span>
    </div>

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-icon"><i data-lucide="package"></i></div>
            <div>
                <h1 class="page-title">Data Produk</h1>
                <p class="page-subtitle">Kelola semua data produk yang dijual di toko Anda dengan mudah.</p>
            </div>
        </div>
        <a href="{{ route('produk.create') }}" class="btn-add">
            <i data-lucide="plus"></i>
            Tambah Produk
        </a>
    </div>

    {{-- STATISTIK --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fdf0e6;color:#e79a63;">
                <i data-lucide="package"></i>
            </div>
            <div>
                <p class="stat-label">Total Produk</p>
                <p class="stat-value">{{ $totalProduk ?? 0 }}</p>
                <p class="stat-sub">Jenis produk tersedia</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#eaf7ec;color:#53b168;">
                <i data-lucide="layout-grid"></i>
            </div>
            <div>
                <p class="stat-label">Kategori</p>
                <p class="stat-value">{{ $kategoris->count() ?? 0 }}</p>
                <p class="stat-sub">Kategori produk</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef8e7;color:#d8a229;">
                <i data-lucide="trending-down"></i>
            </div>
            <div>
                <p class="stat-label">Produk Menipis</p>
                <p class="stat-value" style="color:#d8a229;">{{ $stokMenipis ?? 0 }}</p>
                <p class="stat-sub" style="color:#d8a229;">Produk yang menipis</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fcecee;color:#e25261;">
                <i data-lucide="alert-triangle"></i>
            </div>
            <div>
                <p class="stat-label">Produk Kosong</p>
                <p class="stat-value" style="color:#e25261;">{{ $stokHabis ?? 0 }}</p>
                <p class="stat-sub" style="color:#e25261;">Produk Kosong</p>
            </div>
        </div>
    </div>

    {{-- FILTER BAR --}}
    <div class="filter-bar">
        <form method="GET" action="{{ route('produk.index') }}" class="filter-form" id="filterForm">

            <div class="filter-search">
                <i data-lucide="search" class="icon-search"></i>
                <input type="text"
                       name="keyword"
                       value="{{ request('keyword') }}"
                       placeholder="cari nama, produk, kode, atau deskripsi.....">
            </div>

            {{-- Dropdown Kategori --}}
            <div class="dropdown" data-dropdown>
                <input type="hidden" name="id_kategori" value="{{ request('id_kategori') }}">
                <button type="button" class="dropdown-toggle" onclick="toggleDropdown(this)">
                    <i data-lucide="layout-grid" class="icon-lead"></i>
                    <span class="dropdown-label">
                        @php
                            $selectedKat = $kategoris->firstWhere('id', request('id_kategori'));
                        @endphp
                        {{ $selectedKat->nama_kategori ?? 'Semua Kategori' }}
                    </span>
                    <i data-lucide="chevron-down" class="icon-chevron"></i>
                </button>
                <div class="dropdown-menu">
                    <button type="button" class="dropdown-item {{ !request('id_kategori') ? 'selected' : '' }}"
                            onclick="selectDropdown(this, '', 'Semua Kategori')">
                        Semua Kategori
                        <i data-lucide="check" class="check"></i>
                    </button>
                    @foreach($kategoris as $k)
                        <button type="button"
                                class="dropdown-item {{ request('id_kategori') == $k->id ? 'selected' : '' }}"
                                onclick="selectDropdown(this, '{{ $k->id }}', '{{ $k->nama_kategori }}')">
                            {{ $k->nama_kategori }}
                            <i data-lucide="check" class="check"></i>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Dropdown Status --}}
            <div class="dropdown" data-dropdown>
                <input type="hidden" name="status" value="{{ request('status') }}">
                <button type="button" class="dropdown-toggle" onclick="toggleDropdown(this)">
                    <i data-lucide="tag" class="icon-lead"></i>
                    <span class="dropdown-label">
                        @php
                            $statusMap = [
                                'tersedia' => 'Tersedia',
                                'menipis'  => 'Stok Menipis',
                                'habis'    => 'Stok Habis',
                            ];
                            echo $statusMap[request('status')] ?? 'Semua Status';
                        @endphp
                    </span>
                    <i data-lucide="chevron-down" class="icon-chevron"></i>
                </button>
                <div class="dropdown-menu">
                    <button type="button" class="dropdown-item {{ !request('status') ? 'selected' : '' }}"
                            onclick="selectDropdown(this, '', 'Semua Status')">
                        Semua Status
                        <i data-lucide="check" class="check"></i>
                    </button>
                    <button type="button" class="dropdown-item {{ request('status') == 'tersedia' ? 'selected' : '' }}"
                            onclick="selectDropdown(this, 'tersedia', 'Tersedia')">
                        Tersedia
                        <i data-lucide="check" class="check"></i>
                    </button>
                    <button type="button" class="dropdown-item {{ request('status') == 'menipis' ? 'selected' : '' }}"
                            onclick="selectDropdown(this, 'menipis', 'Stok Menipis')">
                        Stok Menipis
                        <i data-lucide="check" class="check"></i>
                    </button>
                    <button type="button" class="dropdown-item {{ request('status') == 'habis' ? 'selected' : '' }}"
                            onclick="selectDropdown(this, 'habis', 'Stok Habis')">
                        Stok Habis
                        <i data-lucide="check" class="check"></i>
                    </button>
                </div>
            </div>

            <a href="{{ route('produk.index') }}" class="btn-reset">
                <i data-lucide="rotate-ccw"></i>
                Reset
            </a>

        </form>
    </div>

    {{-- TABEL PRODUK --}}
    <div class="table-wrap">
        <div class="table-scroll">
            <table class="produk-table">
                <thead>
                    <tr>
                        <th class="center" style="width:40px;"><input type="checkbox"></th>
                        <th class="col-kode">Kode barang</th>
                        <th class="col-gambar">Gambar</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th class="center">Status</th>
                        <th class="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $p)
                        <tr>
                            <td class="center"><input type="checkbox"></td>
                            <td class="col-kode">
                                <span class="kode-barang">
                                    {{ $p->kode_produk ?? sprintf('%08d', $p->id) }}
                                </span>
                            </td>
                            <td class="col-gambar">
                                <div class="img-thumb">
                                    @if(isset($p->gambar) && $p->gambar)
                                        <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama_produk }}">
                                    @else
                                        <img src="{{ asset('images/roti.png') }}" alt="Produk">
                                    @endif
                                </div>
                            </td>
                            <td><span class="nama-barang">{{ $p->nama_produk }}</span></td>
                            <td>
                                @php
                                    $catName = strtolower($p->kategori->nama_kategori ?? '');
                                    $catClass = 'cat-default';
                                    if (str_contains($catName, 'roti')) $catClass = 'cat-roti';
                                    elseif (str_contains($catName, 'pastry')) $catClass = 'cat-pastry';
                                    elseif (str_contains($catName, 'donat')) $catClass = 'cat-donat';
                                    elseif (str_contains($catName, 'kue')) $catClass = 'cat-kue';
                                    elseif (str_contains($catName, 'cookie') || str_contains($catName, 'kue kering')) $catClass = 'cat-cookies';
                                @endphp
                                <span class="badge-kategori {{ $catClass }}">
                                    {{ $p->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($p->harga_jual, 0, ',', '.') }}</td>
                            <td>{{ $p->stok }} Pcs</td>
                            <td class="center">
                                @if($p->stok > 5)
                                    <span class="badge-status status-tersedia">Tersedia</span>
                                @elseif($p->stok > 0)
                                    <span class="badge-status status-menipis">Stok Menipis</span>
                                @else
                                    <span class="badge-status status-kosong">Kosong</span>
                                @endif
                            </td>
                            <td>
                                <div class="aksi-group">
                                    <a href="{{ route('produk.show', $p->id) }}"
                                       class="btn-aksi btn-view"
                                       data-tip="Lihat Detail">
                                        <i data-lucide="eye"></i>
                                    </a>
                                    <a href="{{ route('produk.edit', $p->id) }}"
                                       class="btn-aksi btn-edit"
                                       data-tip="Edit Produk">
                                        <i data-lucide="pencil"></i>
                                    </a>
                                    <form method="POST"
                                          action="{{ route('produk.destroy', $p->id) }}"
                                          onsubmit="return confirm('Yakin hapus produk ini?')"
                                          style="display:inline;margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn-aksi btn-delete"
                                                data-tip="Hapus Produk">
                                            <i data-lucide="trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <i data-lucide="package-open"></i>
                                    <div>Belum ada data produk.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION (SELALU MUNCUL) --}}
        @php
            $isPaginator = isset($produks) && is_object($produks) && method_exists($produks, 'links');

            if ($isPaginator) {
                $currentPage = $produks->currentPage();
                $lastPage    = $produks->lastPage();
                $firstItem   = $produks->firstItem() ?? 0;
                $lastItem    = $produks->lastItem() ?? 0;
                $totalItems  = $produks->total();
            } else {
                $currentPage = 1;
                $lastPage    = 1;
                $firstItem   = (isset($produks) && count($produks) > 0) ? 1 : 0;
                $lastItem    = isset($produks) ? count($produks) : 0;
                $totalItems  = isset($produks) ? count($produks) : 0;
            }
        @endphp

        <div class="pagination-wrap">
            <div class="pagination-info">
                Menampilkan
                <strong>{{ $firstItem }}</strong>
                –
                <strong>{{ $lastItem }}</strong>
                dari
                <strong>{{ $totalItems }}</strong>
                produk
            </div>

            <ul class="pagination">
                @if($isPaginator && $produks->onFirstPage())
                    <li class="disabled"><span><i data-lucide="chevron-left"></i></span></li>
                @elseif($isPaginator)
                    <li><a href="{{ $produks->previousPageUrl() }}"><i data-lucide="chevron-left"></i></a></li>
                @else
                    <li class="disabled"><span><i data-lucide="chevron-left"></i></span></li>
                @endif

                @if($isPaginator && $lastPage > 1)
                    @foreach ($produks->getUrlRange(1, $lastPage) as $page => $url)
                        @if ($page == $currentPage)
                            <li class="active"><span>{{ $page }}</span></li>
                        @elseif ($page == 1 || $page == $lastPage || abs($page - $currentPage) <= 1)
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @elseif (abs($page - $currentPage) == 2)
                            <li class="dots"><span>…</span></li>
                        @endif
                    @endforeach
                @else
                    <li class="active"><span>1</span></li>
                @endif

                @if($isPaginator && $produks->hasMorePages())
                    <li><a href="{{ $produks->nextPageUrl() }}"><i data-lucide="chevron-right"></i></a></li>
                @else
                    <li class="disabled"><span><i data-lucide="chevron-right"></i></span></li>
                @endif
            </ul>
        </div>

    </div>

</div>

{{-- Re-init lucide icons --}}
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

{{-- SCRIPT: CUSTOM DROPDOWN --}}
<script>
    function toggleDropdown(btn) {
        const dropdown = btn.closest('[data-dropdown]');
        const isOpen = dropdown.classList.contains('open');

        document.querySelectorAll('.produk-page [data-dropdown].open').forEach(function(d) {
            if (d !== dropdown) d.classList.remove('open');
        });

        dropdown.classList.toggle('open', !isOpen);
    }

    function selectDropdown(item, value, label) {
        const dropdown = item.closest('[data-dropdown]');
        const hiddenInput = dropdown.querySelector('input[type="hidden"]');
        const labelEl = dropdown.querySelector('.dropdown-label');

        hiddenInput.value = value;
        labelEl.textContent = label;

        dropdown.querySelectorAll('.dropdown-item').forEach(function(el) {
            el.classList.remove('selected');
        });
        item.classList.add('selected');

        dropdown.classList.remove('open');

        document.getElementById('filterForm').submit();
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.produk-page [data-dropdown]')) {
            document.querySelectorAll('.produk-page [data-dropdown].open').forEach(function(d) {
                d.classList.remove('open');
            });
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.produk-page [data-dropdown].open').forEach(function(d) {
                d.classList.remove('open');
            });
        }
    });
</script>

@endsection