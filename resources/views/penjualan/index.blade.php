@extends('layout')

@section('title', 'Penjualan')

@section('content')

<style>
    /* =========================================================
       BASE
    ========================================================= */
    .pj-page {
        width: 100%;
        color: #4f3929;
        font-family: "Inter", sans-serif;
    }

    .pj-page * {
        box-sizing: border-box;
    }


    /* =========================================================
       HEADER
    ========================================================= */
    .pj-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .pj-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .pj-header-icon {
        width: 48px;
        height: 48px;
        background: #6b4d38;
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .pj-header-icon i,
    .pj-header-icon svg {
        width: 23px;
        height: 23px;
        display: block;
        stroke-width: 1.8;
    }

    .pj-title {
        margin: 0;
        color: #3f3025;
        font-family: "DM Serif Display", serif;
        font-size: 28px;
        font-weight: 400;
        line-height: 1.15;
    }

    .pj-subtitle {
        margin: 4px 0 0;
        color: #a89a8c;
        font-size: 12px;
    }


    /* =========================================================
       BUTTON TAMBAH
    ========================================================= */
    .btn-tambah {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #6b4d38;
        color: #fff;
        padding: 11px 18px;
        min-height: 38px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        transition: .2s ease;
        white-space: nowrap;
    }

    .btn-tambah:hover {
        background: #58402f;
    }

    .btn-tambah i,
    .btn-tambah svg {
        width: 16px;
        height: 16px;
        display: block;
        stroke-width: 2;
        flex-shrink: 0;
    }


    /* =========================================================
       ALERT
    ========================================================= */
    .pj-alert {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 16px;
        font-size: 12px;
    }

    .pj-alert-success {
        background: #e3f4eb;
        border: 1px solid #b6e0c5;
        color: #237450;
    }

    .pj-alert-error {
        background: #fde8eb;
        border: 1px solid #f5b5be;
        color: #bd4b59;
    }

    .pj-alert i,
    .pj-alert svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }


    /* =========================================================
       FILTER CARD
    ========================================================= */
    .pj-filter-card {
        background: #fff;
        border: 1px solid #eee5dc;
        border-radius: 13px;
        padding: 15px 16px;
        margin-bottom: 16px;
    }

    .pj-filter-form {
        display: grid;
        grid-template-columns:
            minmax(220px, 1.5fr)
            minmax(160px, 1fr)
            auto;
        gap: 9px;
        align-items: end;
    }

    .pj-filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
        min-width: 0;
    }

    .pj-filter-label {
        color: #8e7b6a;
        font-size: 10px;
        font-weight: 600;
    }


    /* =========================================================
       INPUT
    ========================================================= */
    .pj-input {
        width: 100%;
        height: 38px;
        border: 1px solid #e8ddd2;
        border-radius: 8px;
        background: #fffdfb;
        color: #4f3929;
        padding: 0 11px;
        outline: none;
        font-family: "Inter", sans-serif;
        font-size: 11px;
        transition: .18s ease;
    }

    .pj-input::placeholder {
        color: #b5a497;
    }

    .pj-input:focus {
        border-color: #8b6a50;
        box-shadow: 0 0 0 3px rgba(107, 77, 56, .08);
        background: #fff;
    }


    /* =========================================================
       SEARCH
    ========================================================= */
    .pj-search-wrap {
        position: relative;
        width: 100%;
    }

    .pj-search-wrap i,
    .pj-search-wrap svg {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        color: #9c8a79;
        pointer-events: none;
        z-index: 2;
        display: block;
        stroke-width: 1.8;
    }

    .pj-search-wrap .pj-input {
        padding-left: 34px;
    }


    /* =========================================================
       FILTER ACTION
    ========================================================= */
    .pj-filter-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .btn-filter,
    .btn-reset {
        height: 38px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: .18s ease;
        white-space: nowrap;
    }

    .btn-filter {
        padding: 0 15px;
        border: none;
        background: #6b4d38;
        color: #fff;
    }

    .btn-filter:hover {
        background: #58402f;
    }

    .btn-filter i,
    .btn-filter svg {
        width: 14px;
        height: 14px;
        display: block;
        stroke-width: 1.8;
        margin-right: 6px;
    }

    .btn-reset {
        padding: 0 13px;
        background: #f5eee7;
        color: #6b4d38;
        text-decoration: none;
        border: 1px solid #eaded2;
    }

    .btn-reset:hover {
        background: #eee2d6;
    }


    /* =========================================================
       CONTENT LAYOUT
    ========================================================= */
    .pj-content-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr);
        gap: 16px;
        transition: .25s ease;
    }

    .pj-content-layout.has-detail {
        grid-template-columns: minmax(0, 1fr) 380px;
    }


    /* =========================================================
       TABLE CARD
    ========================================================= */
    .pj-table-card {
        background: #fff;
        border: 1px solid #eee5dc;
        border-radius: 13px;
        overflow: hidden;
        min-width: 0;
    }

    .pj-table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 15px 16px;
        border-bottom: 1px solid #eee5dc;
    }

    .pj-table-title {
        margin: 0;
        color: #3f3025;
        font-size: 13px;
        font-weight: 700;
    }

    .pj-table-count {
        margin-top: 2px;
        color: #a89a8c;
        font-size: 10px;
    }

    .pj-table-wrapper {
        width: 100%;
        overflow-x: auto;
        scrollbar-width: thin;
    }

    .pj-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }

    .pj-table th {
        background: #faf7f3;
        color: #927e6c;
        padding: 10px 13px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .45px;
        text-align: left;
        white-space: nowrap;
    }

    .pj-table td {
        padding: 10px 13px;
        border-top: 1px solid #f4eee8;
        color: #5f4b3a;
        font-size: 11px;
        vertical-align: middle;
    }

    .pj-table tbody tr {
        transition: background .15s ease;
    }

    .pj-table tbody tr:hover {
        background: #fffbf7;
    }

    .pj-date {
        font-weight: 600;
        color: #3f3025;
        white-space: nowrap;
    }

    .pj-kode {
        font-family: "Courier New", monospace;
        font-size: 10px;
        color: #6b4d38;
        font-weight: 600;
        white-space: nowrap;
    }

    .pj-nama {
        color: #3f3025;
        font-weight: 500;
    }

    .pj-total {
        color: #3f3025;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================================
       AKSI
    ========================================================= */
    .pj-actions {
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }

    .pj-action {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 7px;
        background: transparent;
        text-decoration: none;
        padding: 0;
        cursor: pointer;
        transition:
            background .18s ease,
            color .18s ease;
    }

    .pj-action i,
    .pj-action svg {
        width: 15px;
        height: 15px;
        display: block;
        stroke-width: 1.7;
    }

    .action-view {
        color: #80644f;
    }

    .action-view:hover {
        background: #f4eee8;
        color: #5f432f;
    }

    .action-delete {
        color: #b96670;
    }

    .action-delete:hover {
        background: #fdf0f1;
        color: #a44854;
    }


    /* =========================================================
       DETAIL PANEL
    ========================================================= */
    .pj-detail-panel {
        display: none;
        background: #fff;
        border: 1px solid #eee5dc;
        border-radius: 13px;
        overflow: hidden;
        min-width: 0;
        align-self: start;
        position: sticky;
        top: 20px;
    }

    .pj-detail-panel.is-open {
        display: block;
    }

    .detail-panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 13px 15px;
        border-bottom: 1px solid #eee5dc;
    }

    .detail-panel-title {
        color: #3f3025;
        font-size: 12px;
        font-weight: 700;
    }

    .detail-panel-close {
        width: 27px;
        height: 27px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: #f7f1eb;
        color: #806b59;
        border-radius: 7px;
        cursor: pointer;
        flex-shrink: 0;
    }

    .detail-panel-close:hover {
        background: #eee3d8;
    }

    .detail-panel-close i,
    .detail-panel-close svg {
        width: 14px;
        height: 14px;
        display: block;
    }

    .detail-panel-body {
        padding: 16px;
    }


    /* =========================================================
       DETAIL INFO
    ========================================================= */
    .detail-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        font-size: 11px;
        padding: 6px 0;
        border-bottom: 1px dashed #f4eee8;
    }

    .detail-info:last-of-type {
        border-bottom: none;
    }

    .detail-info span:first-child {
        color: #8a7a6a;
    }

    .detail-info span:last-child {
        color: #3f3025;
        font-weight: 600;
        text-align: right;
    }


    /* =========================================================
       DETAIL SECTION
    ========================================================= */
    .detail-section-title {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #745840;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
        padding: 12px 0 8px;
        margin-bottom: 8px;
        border-bottom: 1px solid #eee5dc;
    }

    .detail-section-title i,
    .detail-section-title svg {
        width: 13px;
        height: 13px;
        display: block;
        stroke-width: 1.8;
        flex-shrink: 0;
    }


    /* =========================================================
       DETAIL PRODUK
    ========================================================= */
    .detail-produk-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px dashed #f4eee8;
    }

    .detail-produk-item:last-child {
        border-bottom: none;
    }

    .detail-produk-thumb {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        overflow: hidden;
        background: #f7f2ed;
        border: 1px solid #eee5dc;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a89a8c;
    }

    .detail-produk-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .detail-produk-thumb i,
    .detail-produk-thumb svg {
        width: 18px;
        height: 18px;
        display: block;
    }

    .detail-produk-info {
        flex: 1;
        min-width: 0;
    }

    .detail-produk-nama {
        color: #3f3025;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 2px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .detail-produk-kode {
        color: #a89a8c;
        font-family: "Courier New", monospace;
        font-size: 9px;
        margin-bottom: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .detail-produk-hitung {
        color: #6b4d38;
        font-size: 10px;
    }

    .detail-produk-subtotal {
        color: #3f3025;
        font-size: 11px;
        font-weight: 700;
        text-align: right;
        white-space: nowrap;
        flex-shrink: 0;
    }


    /* =========================================================
       DETAIL TOTAL
    ========================================================= */
    .detail-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 10px 0 4px;
        font-size: 12px;
        font-weight: 700;
        color: #3f3025;
        border-top: 1px solid #eee5dc;
        margin-top: 8px;
    }


    /* =========================================================
       DETAIL THANKS
    ========================================================= */
    .detail-thanks {
        background: #e3f4eb;
        color: #237450;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 10px;
        text-align: center;
        margin-top: 14px;
    }


    /* =========================================================
       LOADING
    ========================================================= */
    .pj-loading {
        padding: 45px 20px;
        text-align: center;
        color: #a89a8c;
        font-size: 11px;
    }

    .pj-loading i,
    .pj-loading svg {
        width: 23px;
        height: 23px;
        margin: 0 auto 8px;
        display: block;
        animation: spin .8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }


    /* =========================================================
       EMPTY
    ========================================================= */
    .pj-empty {
        padding: 50px 20px;
        text-align: center;
    }

    .pj-empty-icon {
        width: 50px;
        height: 50px;
        background: #f5efe8;
        color: #9c8068;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }

    .pj-empty-icon i,
    .pj-empty-icon svg {
        width: 22px;
        height: 22px;
        display: block;
    }

    .pj-empty-title {
        color: #4f3929;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .pj-empty-text {
        color: #a89a8c;
        font-size: 10px;
    }


    /* =========================================================
       RESPONSIVE 1100
    ========================================================= */
    @media (max-width: 1100px) {

        .pj-filter-form {
            grid-template-columns: 1fr 1fr;
        }

        .pj-filter-actions {
            grid-column: 1 / -1;
        }

        .pj-content-layout.has-detail {
            grid-template-columns: minmax(0, 1fr) 340px;
        }
    }


    /* =========================================================
       RESPONSIVE 850
    ========================================================= */
    @media (max-width: 850px) {

        .pj-content-layout.has-detail {
            grid-template-columns: 1fr;
        }

        .pj-detail-panel {
            position: fixed;
            top: 80px;
            right: 15px;
            bottom: 15px;
            width: min(400px, calc(100vw - 30px));
            z-index: 100;
            overflow-y: auto;
            box-shadow: 0 12px 40px rgba(50, 35, 25, .18);
        }
    }


    /* =========================================================
       RESPONSIVE 600
    ========================================================= */
    @media (max-width: 600px) {

        .pj-header {
            align-items: stretch;
        }

        .pj-header-left {
            width: 100%;
        }

        .pj-filter-form {
            grid-template-columns: 1fr;
        }

        .pj-filter-actions {
            grid-column: auto;
        }

        .btn-filter,
        .btn-reset {
            flex: 1;
        }

        .pj-title {
            font-size: 22px;
        }

        .pj-subtitle {
            font-size: 11px;
        }

        .btn-tambah {
            width: 100%;
            justify-content: center;
        }

        .pj-table-header {
            padding: 13px 14px;
        }

        .pj-table th,
        .pj-table td {
            padding-left: 11px;
            padding-right: 11px;
        }

        .detail-produk-subtotal {
            font-size: 10px;
        }
    }
    .produk-page {
        width: 100%;
        color: #4f3929;
        font-family: "Inter", sans-serif;
    }

    .produk-page * {
        box-sizing: border-box;
    }

    /* ========================================
       BREADCRUMB
    ======================================== */
    .produk-breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #a89a8c;
        font-size: 12px;
        margin-bottom: 12px;
    }

    .produk-breadcrumb a {
        color: #a89a8c;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .produk-breadcrumb a:hover {
        color: #6b4d38;
    }

    .produk-breadcrumb .current {
        color: #3f3025;
        font-weight: 600;
    }

    .produk-breadcrumb i,
    .produk-breadcrumb svg {
        width: 14px !important;
        height: 14px !important;
        display: block;
        flex-shrink: 0;
    }
</style>

<div class="produk-page">

    {{-- BREADCRUMB --}}
    <div class="produk-breadcrumb">

        <a href="{{ route('produk.index') }}" aria-label="Dashboard">
            <i data-lucide="house"></i>
        </a>

        <span>›</span>

        <span class="current">Dashboard</span>

        <span>›</span>

        <span class="current">Penjualan</span>

    </div>



<div class="pj-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}
    <div class="pj-header">

        <div class="pj-header-left">

            <div class="pj-header-icon">
                <i data-lucide="receipt-text"></i>
            </div>

            <div>
                <h1 class="pj-title">
                    Penjualan
                </h1>

                <p class="pj-subtitle">
                    Catat produk yang terjual dan kurangi stok secara manual
                </p>
            </div>

        </div>


        <a
            href="{{ route('penjualan.create') }}"
            class="btn-tambah"
        >
            <i data-lucide="plus"></i>
            <span>Tambah Penjualan</span>
        </a>

    </div>


    {{-- =====================================================
         ALERT SUCCESS
    ====================================================== --}}
    @if(session('success'))

        <div class="pj-alert pj-alert-success">

            <i data-lucide="circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =====================================================
         ALERT ERROR
    ====================================================== --}}
    @if(session('error'))

        <div class="pj-alert pj-alert-error">

            <i data-lucide="circle-alert"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- =====================================================
         FILTER
    ====================================================== --}}
    <div class="pj-filter-card">

        <form
            method="GET"
            action="{{ route('penjualan.index') }}"
            class="pj-filter-form"
        >

            {{-- SEARCH --}}
            <div class="pj-filter-group">

                <label class="pj-filter-label">
                    Cari Transaksi
                </label>

                <div class="pj-search-wrap">

                    <i data-lucide="search"></i>

                    <input
                        type="text"
                        name="keyword"
                        class="pj-input"
                        placeholder="Cari nama produk / kode barang..."
                        value="{{ request('keyword') }}"
                    >

                </div>

            </div>


            {{-- TANGGAL --}}
            <div class="pj-filter-group">

                <label class="pj-filter-label">
                    Pilih Tanggal
                </label>

                <input
                    type="date"
                    name="tanggal"
                    class="pj-input"
                    value="{{ request('tanggal') }}"
                >

            </div>


            {{-- ACTION --}}
            <div class="pj-filter-actions">

                <button
                    type="submit"
                    class="btn-filter"
                >
                    <i data-lucide="search"></i>
                    <span>Cari</span>
                </button>

                <a
                    href="{{ route('penjualan.index') }}"
                    class="btn-reset"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}
    <div
        class="pj-content-layout"
        id="pjContentLayout"
    >

        {{-- =================================================
             TABLE
        ================================================== --}}
        <div class="pj-table-card">

            <div class="pj-table-header">

                <div>

                    <h2 class="pj-table-title">
                        Daftar Penjualan
                    </h2>

                    <div class="pj-table-count">
                        Menampilkan {{ $penjualans->count() }} transaksi
                    </div>

                </div>

            </div>


            @if($penjualans->count() > 0)

                <div class="pj-table-wrapper">

                    <table class="pj-table">

                        <thead>

                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Barang</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach($penjualans as $index => $p)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="pj-date">
                                        {{ $p->tanggal->format('d-m-Y') }}
                                    </td>

                                    <td class="pj-kode">
                                        {{ $p->kode_barang ?: '-' }}
                                    </td>

                                    <td class="pj-nama">
                                        {{ $p->nama_produk ?: '-' }}
                                    </td>

                                    <td>
                                        {{ $p->total_item }}
                                    </td>

                                    <td class="pj-total">
                                        Rp {{ number_format($p->total_pemasukan, 0, ',', '.') }}
                                    </td>

                                    <td>

                                        <div class="pj-actions">

                                            {{-- VIEW --}}
                                            <button
                                                type="button"
                                                class="pj-action action-view js-view-penjualan"
                                                title="Lihat Detail"
                                                data-show-url="{{ route('penjualan.show', $p->id) }}"
                                            >
                                                <i data-lucide="eye"></i>
                                            </button>


                                            {{-- DELETE --}}
                                            <form
                                                action="{{ route('penjualan.destroy', $p->id) }}"
                                                method="POST"
                                                style="margin:0;"
                                                onsubmit="return confirm('Yakin hapus transaksi ini? Stok akan dikembalikan.')"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="pj-action action-delete"
                                                    title="Hapus Transaksi"
                                                >
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

                {{-- EMPTY --}}
                <div class="pj-empty">

                    <div class="pj-empty-icon">
                        <i data-lucide="receipt-text"></i>
                    </div>

                    <div class="pj-empty-title">
                        Belum ada penjualan
                    </div>

                    <div class="pj-empty-text">
                        Klik "Tambah Penjualan" untuk mencatat transaksi baru.
                    </div>

                </div>

            @endif

        </div>


        {{-- =================================================
             DETAIL PANEL
        ================================================== --}}
        <aside
            class="pj-detail-panel"
            id="pjDetailPanel"
        >

            <div class="pj-loading">

                <i data-lucide="loader-circle"></i>

                <div>
                    Memuat detail transaksi...
                </div>

            </div>

        </aside>

    </div>

</div>


{{-- =========================================================
     LUCIDE
========================================================= --}}
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>


{{-- =========================================================
     DETAIL PANEL
========================================================= --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const layout = document.getElementById('pjContentLayout');
        const panel = document.getElementById('pjDetailPanel');


        /* =====================================================
           FORMAT RUPIAH
        ====================================================== */
        function formatRupiah(value) {

            return new Intl.NumberFormat('id-ID').format(
                Number(value || 0)
            );

        }


        /* =====================================================
           ESCAPE HTML
        ====================================================== */
        function escapeHtml(value) {

            if (
                value === null ||
                value === undefined
            ) {
                return '';
            }

            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');

        }


        /* =====================================================
           CLOSE PANEL
        ====================================================== */
        function closeDetailPanel() {

            panel.classList.remove('is-open');
            layout.classList.remove('has-detail');

        }


        /* =====================================================
           CLICK VIEW
        ====================================================== */
        document.addEventListener('click', function (event) {

            const button =
                event.target.closest('.js-view-penjualan');


            if (!button) {
                return;
            }


            const showUrl =
                button.dataset.showUrl || '#';


            layout.classList.add('has-detail');
            panel.classList.add('is-open');


            /* LOADING */
            panel.innerHTML = `
                <div class="pj-loading">
                    <i data-lucide="loader-circle"></i>
                    <div>Memuat detail transaksi...</div>
                </div>
            `;


            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }


            /* =================================================
               FETCH DETAIL
            ================================================== */
            fetch(showUrl, {

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }

            })

            .then(res => {

                if (!res.ok) {
                    throw new Error(
                        'Gagal mengambil data transaksi.'
                    );
                }

                return res.json();

            })

            .then(data => {


                /* =============================================
                   PRODUK
                ============================================== */
                let produkHtml = '';


                data.detail.forEach(d => {

                    const thumbHtml = d.gambar

                        ? `
                            <img
                                src="${escapeHtml(d.gambar)}"
                                alt="${escapeHtml(d.nama_produk)}"
                            >
                          `

                        : `
                            <i data-lucide="package"></i>
                          `;


                    produkHtml += `

                        <div class="detail-produk-item">

                            <div class="detail-produk-thumb">
                                ${thumbHtml}
                            </div>


                            <div class="detail-produk-info">

                                <div class="detail-produk-nama">
                                    ${escapeHtml(d.nama_produk)}
                                </div>

                                <div class="detail-produk-kode">
                                    ${escapeHtml(d.kode_produk)}
                                </div>

                                <div class="detail-produk-hitung">
                                    ${d.jumlah}
                                    x
                                    Rp ${formatRupiah(d.harga_jual)}
                                </div>

                            </div>


                            <div class="detail-produk-subtotal">
                                Rp ${formatRupiah(d.subtotal)}
                            </div>

                        </div>

                    `;

                });


                /* =============================================
                   PANEL CONTENT
                ============================================== */
                panel.innerHTML = `

                    <div class="detail-panel-head">

                        <div class="detail-panel-title">
                            Detail Penjualan
                        </div>


                        <button
                            type="button"
                            class="detail-panel-close"
                            id="closePjDetail"
                            title="Tutup"
                        >
                            <i data-lucide="x"></i>
                        </button>

                    </div>


                    <div class="detail-panel-body">


                        <div class="detail-info">

                            <span>
                                No. Struk
                            </span>

                            <span>
                                ${escapeHtml(data.no_struk)}
                            </span>

                        </div>


                        <div class="detail-info">

                            <span>
                                Tanggal
                            </span>

                            <span>
                                ${escapeHtml(data.tanggal)}
                            </span>

                        </div>


                        <div class="detail-info">

                            <span>
                                Total Item
                            </span>

                            <span>
                                ${data.total_item}
                            </span>

                        </div>


                        <div class="detail-section-title">

                            <i data-lucide="shopping-bag"></i>

                            <span>
                                Produk yang Dibeli
                            </span>

                        </div>


                        ${produkHtml}


                        <div class="detail-total">

                            <span>
                                Total
                            </span>

                            <span>
                                Rp ${formatRupiah(data.total_pemasukan)}
                            </span>

                        </div>


                        <div class="detail-thanks">
                            Terima kasih telah berbelanja! 🙏
                        </div>


                    </div>

                `;


                /* CREATE ICON */
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }


                /* =============================================
                   CLOSE BUTTON
                ============================================== */
                const closeBtn =
                    document.getElementById('closePjDetail');


                if (closeBtn) {

                    closeBtn.addEventListener(
                        'click',
                        closeDetailPanel
                    );

                }

            })


            /* =================================================
               ERROR
            ================================================== */
            .catch(err => {

                console.error(err);


                panel.innerHTML = `

                    <div class="detail-panel-head">

                        <div class="detail-panel-title">
                            Detail Penjualan
                        </div>


                        <button
                            type="button"
                            class="detail-panel-close"
                            id="closePjDetailError"
                            title="Tutup"
                        >
                            <i data-lucide="x"></i>
                        </button>

                    </div>


                    <div class="detail-panel-body">

                        <p style="
                            color:#bd4b59;
                            font-size:11px;
                            margin:0;
                        ">
                            Gagal memuat data.
                        </p>

                    </div>

                `;


                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }


                const closeError =
                    document.getElementById(
                        'closePjDetailError'
                    );


                if (closeError) {

                    closeError.addEventListener(
                        'click',
                        closeDetailPanel
                    );

                }

            });

        });

    });
</script>

@endsection
