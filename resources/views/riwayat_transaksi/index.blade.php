@extends('layout')

@section('title', 'Riwayat Transaksi')

@section('content')

<style>
    .rt-page { width: 100%; color: #4f3929; font-family: "Inter", sans-serif; }
    .rt-page * { box-sizing: border-box; }

    /* BREADCRUMB */
    .rt-breadcrumb { display: flex; align-items: center; gap: 6px; color: #a89a8c; font-size: 12px; margin-bottom: 12px; }
    .rt-breadcrumb a { color: #a89a8c; text-decoration: none; display: flex; align-items: center; }
    .rt-breadcrumb a:hover { color: #6b4d38; }
    .rt-breadcrumb .current { color: #3f3025; font-weight: 600; }
    .rt-breadcrumb i { width: 14px; height: 14px; }

    /* HEADER */
    .rt-header { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 22px; flex-wrap: wrap; }
    .rt-header-left { display: flex; align-items: center; gap: 14px; }
    .rt-header-icon { width: 48px; height: 48px; background: #6b4d38; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .rt-header-icon i { width: 23px; height: 23px; stroke-width: 1.8; }
    .rt-title { margin: 0; color: #3f3025; font-family: "DM Serif Display", serif; font-size: 28px; font-weight: 400; line-height: 1.15; }
    .rt-subtitle { margin: 4px 0 0; color: #a89a8c; font-size: 12px; }

    /* FILTER */
    .rt-filter-card { background: #fff; border: 1px solid #eee5dc; border-radius: 13px; padding: 15px 16px; margin-bottom: 16px; }
    .rt-filter-form { display: grid; grid-template-columns: minmax(220px, 1.5fr) minmax(180px, 1fr) minmax(150px, 1fr) auto; gap: 9px; align-items: end; }
    .rt-filter-group { display: flex; flex-direction: column; gap: 5px; }
    .rt-filter-label { color: #8e7b6a; font-size: 10px; font-weight: 600; }
    .rt-input, .rt-select { width: 100%; height: 38px; border: 1px solid #e8ddd2; border-radius: 8px; background: #fffdfb; color: #4f3929; padding: 0 11px; outline: none; font-family: "Inter", sans-serif; font-size: 11px; transition: .18s ease; }
    .rt-input:focus, .rt-select:focus { border-color: #8b6a50; box-shadow: 0 0 0 3px rgba(107, 77, 56, .08); background: #fff; }
    .rt-input[readonly] { background: #faf7f3; cursor: pointer; }
    .rt-select { appearance: auto; accent-color: #6b4d38; cursor: pointer; }
    .rt-search-wrap { position: relative; }
    .rt-search-wrap i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; color: #9c8a79; pointer-events: none; }
    .rt-search-wrap .rt-input { padding-left: 34px; }
    .rt-filter-actions { display: flex; gap: 7px; }
    .btn-filter, .btn-reset { height: 38px; border-radius: 8px; font-size: 11px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; }
    .btn-filter { padding: 0 15px; border: none; background: #6b4d38; color: white; }
    .btn-filter:hover { background: #58402f; }
    .btn-filter i { width: 14px; height: 14px; stroke-width: 1.8; }
    .btn-reset { padding: 0 13px; background: #f5eee7; color: #6b4d38; text-decoration: none; border: 1px solid #eaded2; }
    .btn-reset:hover { background: #eee2d6; }

    /* CONTENT */
    .rt-content-layout { display: grid; grid-template-columns: minmax(0, 1fr); gap: 16px; transition: .25s ease; }
    .rt-content-layout.has-detail { grid-template-columns: minmax(0, 1fr) 360px; }

    /* TABLE */
    .rt-table-card { background: white; border: 1px solid #eee5dc; border-radius: 13px; overflow: hidden; min-width: 0; }
    .rt-table-header { display: flex; align-items: center; justify-content: space-between; padding: 15px 16px; border-bottom: 1px solid #eee5dc; }
    .rt-table-title { margin: 0; color: #3f3025; font-size: 13px; font-weight: 700; }
    .rt-table-count { margin-top: 2px; color: #a89a8c; font-size: 10px; }
    .rt-table-wrapper { width: 100%; overflow-x: auto; }
    .rt-table { width: 100%; border-collapse: collapse; min-width: 760px; }
    .rt-table th { background: #faf7f3; color: #927e6c; padding: 10px 13px; font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: .45px; text-align: left; white-space: nowrap; }
    .rt-table td { padding: 10px 13px; border-top: 1px solid #f4eee8; color: #5f4b3a; font-size: 11px; vertical-align: middle; }
    .rt-table tbody tr { transition: background .15s; }
    .rt-table tbody tr:hover { background: #fffbf7; }

    .rt-date { font-weight: 600; color: #3f3025; white-space: nowrap; }
    .rt-kode { font-family: "Courier New", monospace; font-size: 10px; color: #6b4d38; font-weight: 600; }
    .rt-total { color: #3f3025; font-weight: 700; white-space: nowrap; }

    /* STATUS */
    .rt-status { display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 999px; font-size: 9px; font-weight: 700; white-space: nowrap; }
    .status-selesai { background: #e3f4eb; color: #237450; }
    .status-pending { background: #fff3d5; color: #a96e16; }
    .status-batal { background: #fde8eb; color: #bd4b59; }

    /* AKSI */
    .rt-action { width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center; border: none; border-radius: 7px; background: transparent; color: #80644f; padding: 0; cursor: pointer; transition: background .18s ease, color .18s ease; }
    .rt-action:hover { background: #f4eee8; color: #5f432f; }
    .rt-action i { width: 15px; height: 15px; stroke-width: 1.7; }

    /* DETAIL PANEL */
    .rt-detail-panel { display: none; background: #fff; border: 1px solid #eee5dc; border-radius: 13px; overflow: hidden; min-width: 0; align-self: start; position: sticky; top: 20px; }
    .rt-detail-panel.is-open { display: block; }
    .detail-panel-head { display: flex; align-items: center; justify-content: space-between; padding: 13px 15px; border-bottom: 1px solid #eee5dc; }
    .detail-panel-title { color: #3f3025; font-size: 12px; font-weight: 700; }
    .detail-panel-close { width: 27px; height: 27px; display: inline-flex; align-items: center; justify-content: center; border: none; background: #f7f1eb; color: #806b59; border-radius: 7px; cursor: pointer; }
    .detail-panel-close:hover { background: #eee3d8; color: #5f432f; }
    .detail-panel-close i { width: 14px; height: 14px; }
    .detail-panel-body { padding: 16px; }

    .detail-info { display: flex; justify-content: space-between; font-size: 11px; padding: 6px 0; border-bottom: 1px dashed #f4eee8; }
    .detail-info:last-of-type { border-bottom: none; }
    .detail-info span:first-child { color: #8a7a6a; }
    .detail-info span:last-child { color: #3f3025; font-weight: 600; }

    .detail-section-title { display: flex; align-items: center; gap: 6px; color: #745840; font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: .7px; padding: 12px 0 8px; margin-bottom: 8px; border-bottom: 1px solid #eee5dc; }
    .detail-section-title i { width: 13px; height: 13px; stroke-width: 1.8; }

    .detail-produk-table { width: 100%; font-size: 10px; }
    .detail-produk-table th { text-align: left; color: #a89a8c; font-size: 9px; padding: 4px 0; border-bottom: 1px solid #f4eee8; }
    .detail-produk-table th.right { text-align: right; }
    .detail-produk-table th.center { text-align: center; }
    .detail-produk-table td { padding: 6px 0; border-bottom: 1px dashed #f4eee8; color: #3f3025; }
    .detail-produk-table td.right { text-align: right; }
    .detail-produk-table td.center { text-align: center; }

    .detail-total { display: flex; justify-content: space-between; padding: 10px 0 4px; font-size: 12px; font-weight: 700; color: #3f3025; border-top: 1px solid #eee5dc; margin-top: 8px; }

    .detail-thanks { background: #e3f4eb; color: #237450; border-radius: 8px; padding: 8px 12px; font-size: 10px; text-align: center; margin-top: 14px; }

    .rt-loading { padding: 45px 20px; text-align: center; color: #a89a8c; font-size: 11px; }
    .rt-loading i { width: 23px; height: 23px; margin-bottom: 8px; animation: spin .8s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* EMPTY */
    .rt-empty { padding: 50px 20px; text-align: center; }
    .rt-empty-icon { width: 50px; height: 50px; background: #f5efe8; color: #9c8068; border-radius: 13px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; }
    .rt-empty-icon i { width: 22px; height: 22px; }
    .rt-empty-title { color: #4f3929; font-size: 13px; font-weight: 700; margin-bottom: 4px; }
    .rt-empty-text { color: #a89a8c; font-size: 10px; }

    /* RESPONSIVE */
    @media (max-width: 1100px) {
        .rt-filter-form { grid-template-columns: 1fr 1fr; }
        .rt-filter-actions { grid-column: 1 / -1; }
        .rt-content-layout.has-detail { grid-template-columns: minmax(0, 1fr) 330px; }
    }
    @media (max-width: 850px) {
        .rt-content-layout.has-detail { grid-template-columns: 1fr; }
        .rt-detail-panel { position: fixed; top: 80px; right: 15px; bottom: 15px; width: min(380px, calc(100vw - 30px)); z-index: 100; overflow-y: auto; box-shadow: 0 12px 40px rgba(50, 35, 25, .18); }
    }
    @media (max-width: 600px) {
        .rt-filter-form { grid-template-columns: 1fr; }
        .rt-filter-actions { grid-column: auto; }
        .btn-filter, .btn-reset { flex: 1; }
        .rt-title { font-size: 22px; }
    }
</style>


<div class="rt-page">

    {{-- BREADCRUMB --}}
    <div class="rt-breadcrumb">
        <a href="{{ route('dashboard') }}"><i data-lucide="house"></i></a>
        <span>›</span>
        <span class="current">Riwayat Transaksi</span>
    </div>

    {{-- HEADER --}}
    <div class="rt-header">
        <div class="rt-header-left">
            <div class="rt-header-icon">
                <i data-lucide="history"></i>
            </div>
            <div>
                <h1 class="rt-title">Riwayat Transaksi</h1>
                <p class="rt-subtitle">Daftar riwayat pembelian yang sudah selesai</p>
            </div>
        </div>
    </div>

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div style="background:#e3f4eb;border:1px solid #b6e0c5;color:#237450;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:12px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTER --}}
    <div class="rt-filter-card">
        <form method="GET" action="{{ route('riwayat_transaksi.index') }}" class="rt-filter-form">

            {{-- Search --}}
            <div class="rt-filter-group">
                <label class="rt-filter-label">Cari Transaksi</label>
                <div class="rt-search-wrap">
                    <i data-lucide="search"></i>
                    <input type="text"
                           name="keyword"
                           class="rt-input"
                           placeholder="Cari nama produk / kode barang..."
                           value="{{ request('keyword') }}">
                </div>
            </div>

            {{-- Date Range (Flatpickr) --}}
            <div class="rt-filter-group">
                <label class="rt-filter-label">Rentang Tanggal</label>
                <input type="text"
                       id="date-range"
                       placeholder="Pilih rentang tanggal..."
                       value="{{ request('start_date') && request('end_date') ? request('start_date') . ' to ' . request('end_date') : '' }}"
                       class="rt-input"
                       readonly>
                <input type="hidden" name="start_date" id="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" id="end_date" value="{{ request('end_date') }}">
            </div>

            {{-- Status --}}
            <div class="rt-filter-group">
                <label class="rt-filter-label">Status</label>
                <select name="status" class="rt-select">
                    <option value="">Semua Status</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>

            {{-- Action --}}
            <div class="rt-filter-actions">
                <button type="submit" class="btn-filter">
                    <i data-lucide="search"></i>
                    Cari
                </button>
                <a href="{{ route('riwayat_transaksi.index') }}" class="btn-reset">Reset</a>
            </div>

        </form>
    </div>

    {{-- CONTENT --}}
    <div class="rt-content-layout" id="rtContentLayout">

        {{-- TABLE --}}
        <div class="rt-table-card">
            <div class="rt-table-header">
                <div>
                    <h2 class="rt-table-title">Daftar Transaksi</h2>
                    <div class="rt-table-count">Menampilkan {{ $penjualans->count() }} transaksi</div>
                </div>
            </div>

            @if($penjualans->count() > 0)
                <div class="rt-table-wrapper">
                    <table class="rt-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Barang</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penjualans as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="rt-date">{{ $p->tanggal->format('d-m-Y') }}</td>
                                    <td class="rt-kode">{{ $p->kode_barang ?: '-' }}</td>
                                    <td>{{ $p->total_item }}</td>
                                    <td class="rt-total">Rp {{ number_format($p->total_pemasukan, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="rt-status status-{{ $p->status ?? 'selesai' }}">
                                            {{ $p->label_status ?? 'Selesai' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button"
                                                class="rt-action js-view-transaksi"
                                                title="Lihat Detail"
                                                data-id="{{ $p->id }}"
                                                data-show-url="{{ route('riwayat_transaksi.show', $p->id) }}">
                                            <i data-lucide="eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="rt-empty">
                    <div class="rt-empty-icon">
                        <i data-lucide="history"></i>
                    </div>
                    <div class="rt-empty-title">Belum ada riwayat transaksi</div>
                    <div class="rt-empty-text">Transaksi yang sudah selesai akan muncul di sini.</div>
                </div>
            @endif
        </div>

        {{-- DETAIL PANEL --}}
        <aside class="rt-detail-panel" id="rtDetailPanel">
            <div class="rt-loading">
                <i data-lucide="loader-circle"></i>
                <div>Memuat detail transaksi...</div>
            </div>
        </aside>

    </div>
</div>

{{-- LUCIDE --}}
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

{{-- FLATPICKR --}}
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

{{-- PANEL SLIDE-IN --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const layout = document.getElementById('rtContentLayout');
        const panel = document.getElementById('rtDetailPanel');

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

        document.addEventListener('click', function (event) {
            const button = event.target.closest('.js-view-transaksi');
            if (!button) return;

            const showUrl = button.dataset.showUrl || '#';

            layout.classList.add('has-detail');
            panel.classList.add('is-open');

            panel.innerHTML = `
                <div class="rt-loading">
                    <i data-lucide="loader-circle"></i>
                    <div>Memuat detail transaksi...</div>
                </div>
            `;
            if (typeof lucide !== 'undefined') lucide.createIcons();

            fetch(showUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                let detailRows = '';
                data.detail.forEach((d, i) => {
                    detailRows += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${escapeHtml(d.nama_produk)}</td>
                            <td class="right">Rp ${formatRupiah(d.harga_jual)}</td>
                            <td class="center">${d.jumlah}</td>
                            <td class="right">Rp ${formatRupiah(d.subtotal)}</td>
                        </tr>
                    `;
                });

                panel.innerHTML = `
                    <div class="detail-panel-head">
                        <div class="detail-panel-title">Detail Transaksi</div>
                        <button type="button" class="detail-panel-close" id="closeRtDetail" title="Tutup">
                            <i data-lucide="x"></i>
                        </button>
                    </div>
                    <div class="detail-panel-body">

                        <div class="detail-info">
                            <span>No. Struk</span>
                            <span>${escapeHtml(data.no_struk)}</span>
                        </div>
                        <div class="detail-info">
                            <span>Tanggal</span>
                            <span>${escapeHtml(data.tanggal)}</span>
                        </div>
                        <div class="detail-info">
                            <span>Total Item</span>
                            <span>${data.total_item}</span>
                        </div>
                        <div class="detail-info">
                            <span>Status</span>
                            <span>${escapeHtml(data.label_status)}</span>
                        </div>

                        <div class="detail-section-title">
                            <i data-lucide="shopping-bag"></i>
                            Daftar Produk
                        </div>

                        <table class="detail-produk-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th class="right">Harga</th>
                                    <th class="center">Jml</th>
                                    <th class="right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${detailRows}
                            </tbody>
                        </table>

                        <div class="detail-total">
                            <span>Total</span>
                            <span>Rp ${formatRupiah(data.total_pemasukan)}</span>
                        </div>

                        <div class="detail-thanks">
                            Terima kasih telah berbelanja! 🙏
                        </div>

                    </div>
                `;

                if (typeof lucide !== 'undefined') lucide.createIcons();

                const closeBtn = document.getElementById('closeRtDetail');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function () {
                        panel.classList.remove('is-open');
                        layout.classList.remove('has-detail');
                    });
                }
            })
            .catch(err => {
                panel.innerHTML = `
                    <div class="detail-panel-head">
                        <div class="detail-panel-title">Detail Transaksi</div>
                        <button type="button" class="detail-panel-close" onclick="document.getElementById('rtDetailPanel').classList.remove('is-open');document.getElementById('rtContentLayout').classList.remove('has-detail');">
                            <i data-lucide="x"></i>
                        </button>
                    </div>
                    <div class="detail-panel-body">
                        <p style="color:#bd4b59;font-size:11px;">Gagal memuat data.</p>
                    </div>
                `;
                if (typeof lucide !== 'undefined') lucide.createIcons();
            });
        });
    });
</script>

@endsection
