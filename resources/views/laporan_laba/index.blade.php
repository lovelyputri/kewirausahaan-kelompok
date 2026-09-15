@extends('layout')

@section('title', 'Laporan Laba Rugi')

@section('content')

<style>
    .ll-page { width: 100%; color: #4f3929; font-family: "Inter", sans-serif; }
    .ll-page * { box-sizing: border-box; }

    .ll-breadcrumb { display: flex; align-items: center; gap: 6px; color: #a89a8c; font-size: 12px; margin-bottom: 12px; }
    .ll-breadcrumb a { color: #a89a8c; text-decoration: none; }
    .ll-breadcrumb a:hover { color: #6b4d38; }
    .ll-breadcrumb .current { color: #3f3025; font-weight: 600; }

    .ll-header { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 22px; flex-wrap: wrap; }
    .ll-header-left { display: flex; align-items: center; gap: 14px; }
    .ll-header-icon { width: 48px; height: 48px; background: #6b4d38; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .ll-header-icon i { width: 23px; height: 23px; stroke-width: 1.8; }
    .ll-title { margin: 0; color: #3f3025; font-family: "DM Serif Display", serif; font-size: 28px; font-weight: 400; line-height: 1.15; }
    .ll-subtitle { margin: 4px 0 0; color: #a89a8c; font-size: 12px; }

    .btn-export { display: inline-flex; align-items: center; gap: 8px; background: #fff; color: #6b4d38; padding: 11px 18px; border-radius: 9px; text-decoration: none; font-size: 12px; font-weight: 600; border: 1px solid #e8ded3; transition: .2s; }
    .btn-export:hover { background: #f5efe8; }
    .btn-export i { width: 16px; height: 16px; stroke-width: 2; }

    /* STAT CARDS */
    .ll-stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 18px; }
    .ll-stat-card { background: #fff; border: 1px solid #eee5dc; border-radius: 13px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; }
    .ll-stat-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .ll-stat-icon i { width: 22px; height: 22px; stroke-width: 1.8; }
    .ll-stat-icon.green { background: #e3f4eb; color: #237450; }
    .ll-stat-icon.brown { background: #f5eee7; color: #76553d; }
    .ll-stat-icon.red { background: #fde8eb; color: #bd4b59; }
    .ll-stat-icon.blue { background: #e3f0fa; color: #1e6091; }
    .ll-stat-label { color: #a89a8c; font-size: 11px; margin-bottom: 4px; }
    .ll-stat-value { color: #3f3025; font-size: 20px; font-weight: 700; }
    .ll-stat-value.red { color: #bd4b59; }
    .ll-stat-value.green { color: #237450; }

    /* FILTER */
    .ll-filter-card { background: #fff; border: 1px solid #eee5dc; border-radius: 13px; padding: 15px 16px; margin-bottom: 16px; }
    .ll-filter-form { display: grid; grid-template-columns: minmax(200px, 1.5fr) minmax(200px, 1.2fr) minmax(160px, 1fr) auto; gap: 9px; align-items: end; }
    .ll-filter-group { display: flex; flex-direction: column; gap: 5px; }
    .ll-filter-label { color: #8e7b6a; font-size: 10px; font-weight: 600; }
    .ll-input, .ll-select { width: 100%; height: 38px; border: 1px solid #e8ddd2; border-radius: 8px; background: #fffdfb; color: #4f3929; padding: 0 11px; outline: none; font-family: "Inter", sans-serif; font-size: 11px; }
    .ll-input:focus, .ll-select:focus { border-color: #8b6a50; box-shadow: 0 0 0 3px rgba(107, 77, 56, .08); background: #fff; }
    .ll-input[readonly] { background: #faf7f3; cursor: pointer; }
    .ll-search-wrap { position: relative; }
    .ll-search-wrap i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; color: #9c8a79; pointer-events: none; }
    .ll-search-wrap .ll-input { padding-left: 34px; }
    .ll-filter-actions { display: flex; gap: 7px; }
    .btn-filter, .btn-reset { height: 38px; border-radius: 8px; font-size: 11px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; }
    .btn-filter { padding: 0 15px; border: none; background: #6b4d38; color: white; }
    .btn-filter:hover { background: #58402f; }
    .btn-filter i { width: 14px; height: 14px; }
    .btn-reset { padding: 0 13px; background: #f5eee7; color: #6b4d38; text-decoration: none; border: 1px solid #eaded2; }
    .btn-reset:hover { background: #eee2d6; }

    /* TABLE */
    .ll-table-card { background: white; border: 1px solid #eee5dc; border-radius: 13px; overflow: hidden; }
    .ll-table-header { padding: 15px 18px; border-bottom: 1px solid #eee5dc; }
    .ll-table-title { margin: 0; color: #3f3025; font-size: 13px; font-weight: 700; }
    .ll-table-sub { margin-top: 2px; color: #a89a8c; font-size: 10px; }
    .ll-table-wrapper { width: 100%; overflow-x: auto; }
    .ll-table { width: 100%; border-collapse: collapse; min-width: 900px; }
    .ll-table th { background: #6b4d38; color: #fff; padding: 12px 14px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; text-align: left; white-space: nowrap; }
    .ll-table td { padding: 12px 14px; border-top: 1px solid #f4eee8; color: #5f4b3a; font-size: 12px; }
    .ll-table tbody tr:hover { background: #fffbf7; }
    .ll-kode { font-family: "Courier New", monospace; font-size: 11px; color: #6b4d38; font-weight: 600; }
    .ll-nama { color: #3f3025; font-weight: 600; }
    .ll-num { font-weight: 600; }
    .ll-untung { color: #237450; font-weight: 700; }

    .ll-empty { padding: 50px 20px; text-align: center; }
    .ll-empty-icon { width: 50px; height: 50px; background: #f5efe8; color: #9c8068; border-radius: 13px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; }
    .ll-empty-icon i { width: 22px; height: 22px; }
    .ll-empty-title { color: #4f3929; font-size: 13px; font-weight: 700; margin-bottom: 4px; }
    .ll-empty-text { color: #a89a8c; font-size: 10px; }

    @media (max-width: 1100px) {
        .ll-stat-grid { grid-template-columns: repeat(2, 1fr); }
        .ll-filter-form { grid-template-columns: 1fr 1fr; }
        .ll-filter-actions { grid-column: 1 / -1; }
    }
    @media (max-width: 600px) {
        .ll-stat-grid { grid-template-columns: 1fr; }
        .ll-filter-form { grid-template-columns: 1fr; }
        .ll-filter-actions { grid-column: auto; }
        .btn-filter, .btn-reset { flex: 1; }
        .ll-title { font-size: 22px; }
    }
</style>


<div class="ll-page">

    {{-- BREADCRUMB --}}
    <div class="ll-breadcrumb">
        <a href="{{ route('dashboard') }}"><i data-lucide="house" style="width:14px;height:14px;"></i></a>
        <span>›</span>
        <span>Dashboard</span>
        <span>›</span>
        <span class="current">Laporan Laba Rugi</span>
    </div>

    {{-- HEADER --}}
    <div class="ll-header">
        <div class="ll-header-left">
            <div class="ll-header-icon">
                <i data-lucide="chart-column"></i>
            </div>
            <div>
                <h1 class="ll-title">Laporan Laba Rugi</h1>
                <p class="ll-subtitle">Ringkasan keuntungan & kerugian toko</p>
            </div>
        </div>

        <a href="{{ route('laporan_laba.export', request()->query()) }}" class="btn-export">
            <i data-lucide="download"></i>
            Export Excel
        </a>
    </div>

    {{-- STAT CARDS --}}
    <div class="ll-stat-grid">
        <div class="ll-stat-card">
            <div class="ll-stat-icon green"><i data-lucide="dollar-sign"></i></div>
            <div>
                <div class="ll-stat-label">Total Penjualan</div>
                <div class="ll-stat-value">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="ll-stat-card">
            <div class="ll-stat-icon brown"><i data-lucide="package"></i></div>
            <div>
                <div class="ll-stat-label">Total Modal</div>
                <div class="ll-stat-value">Rp {{ number_format($totalModal, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="ll-stat-card">
            <div class="ll-stat-icon red"><i data-lucide="trending-down"></i></div>
            <div>
                <div class="ll-stat-label">Kerugian</div>
                <div class="ll-stat-value red">Rp {{ number_format($totalKerugian, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="ll-stat-card">
            <div class="ll-stat-icon blue"><i data-lucide="trending-up"></i></div>
            <div>
                <div class="ll-stat-label">Laba Bersih</div>
                <div class="ll-stat-value {{ $labaBersih >= 0 ? 'green' : 'red' }}">
                    Rp {{ number_format($labaBersih, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="ll-filter-card">
        <form method="GET" action="{{ route('laporan_laba.index') }}" class="ll-filter-form">

            {{-- Search --}}
            <div class="ll-filter-group">
                <label class="ll-filter-label">Cari Produk</label>
                <div class="ll-search-wrap">
                    <i data-lucide="search"></i>
                    <input type="text" name="keyword" class="ll-input"
                           placeholder="Cari nama produk, kode..."
                           value="{{ request('keyword') }}">
                </div>
            </div>

            {{-- ✅ Range Tanggal (Flatpickr) --}}
            <div class="ll-filter-group">
                <label class="ll-filter-label">Rentang Tanggal</label>
                <input type="text"
                       id="date-range"
                       placeholder="Pilih rentang tanggal..."
                       value="{{ request('start_date') && request('end_date') ? request('start_date') . ' to ' . request('end_date') : '' }}"
                       class="ll-input"
                       readonly>
                <input type="hidden" name="start_date" id="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" id="end_date" value="{{ request('end_date') }}">
            </div>

            {{-- Kategori --}}
            <div class="ll-filter-group">
                <label class="ll-filter-label">Kategori</label>
                <select name="id_kategori" class="ll-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ request('id_kategori') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Action --}}
            <div class="ll-filter-actions">
                <button type="submit" class="btn-filter">
                    <i data-lucide="search"></i>
                    Cari
                </button>
                <a href="{{ route('laporan_laba.index') }}" class="btn-reset">Reset</a>
            </div>

        </form>
    </div>

    {{-- TABLE --}}
    <div class="ll-table-card">
        <div class="ll-table-header">
            <h2 class="ll-table-title">Rincian Laba per Produk</h2>
            <div class="ll-table-sub">Menampilkan {{ $laporans->count() }} produk</div>
        </div>

        @if($laporans->count() > 0)
            <div class="ll-table-wrapper">
                <table class="ll-table">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Produk</th>
                            <th>Total Terjual</th>
                            <th>Modal (Harga Beli)</th>
                            <th>Penjualan (Harga Jual)</th>
                            <th>Untung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporans as $l)
                            <tr>
                                <td class="ll-kode">{{ $l->kode_produk }}</td>
                                <td class="ll-nama">{{ $l->nama_produk }}</td>
                                <td class="ll-num">{{ $l->total_terjual }}</td>
                                <td>Rp {{ number_format($l->total_modal, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($l->total_jual, 0, ',', '.') }}</td>
                                <td class="ll-untung">Rp {{ number_format($l->total_untung, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="ll-empty">
                <div class="ll-empty-icon">
                    <i data-lucide="chart-column"></i>
                </div>
                <div class="ll-empty-title">Belum ada data laba</div>
                <div class="ll-empty-text">Data akan muncul setelah ada transaksi penjualan.</div>
            </div>
        @endif
    </div>

</div>

{{-- LUCIDE --}}
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

{{-- FLATPICKR: RANGE TANGGAL --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof flatpickr !== 'undefined') {
            flatpickr("#date-range", {
                mode: "range",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d M Y",
                onChange: function (selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        document.getElementById('start_date').value = instance.formatDate(selectedDates[0], "Y-m-d");
                        document.getElementById('end_date').value = instance.formatDate(selectedDates[1], "Y-m-d");
                    }
                }
            });
        }
    });
</script>

@endsection
