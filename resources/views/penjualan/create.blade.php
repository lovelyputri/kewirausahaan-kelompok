@extends('layout')

@section('title', 'Tambah Penjualan')

@section('content')

<style>
    /* =====================================================
       SCOPE KHUSUS HALAMAN TAMBAH PENJUALAN
    ===================================================== */
    .pj-form-page * { box-sizing: border-box; }

    /* ---------- BREADCRUMB ---------- */
    .pj-form-page .breadcrumb {
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
    .pj-form-page .breadcrumb a {
        color: #a89a8c;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: color .2s;
    }
    .pj-form-page .breadcrumb a:hover { color: #6b4d38; }
    .pj-form-page .breadcrumb .sep { color: #d6c9bb; font-size: 14px; }
    .pj-form-page .breadcrumb .current { color: #3f3025; font-weight: 600; }

    /* ---------- HEADER ---------- */
    .pj-form-page .page-header {
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
    .pj-form-page .page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .pj-form-page .page-icon {
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
    .pj-form-page .page-icon i { width: 24px; height: 24px; stroke-width: 2; }
    .pj-form-page .page-title {
        font-family: "DM Serif Display", serif;
        font-size: 26px;
        font-weight: 400;
        color: #3f3025;
        margin: 0 0 2px 0;
        line-height: 1.1;
    }
    .pj-form-page .page-subtitle {
        font-family: "Inter", sans-serif;
        font-size: 12px;
        color: #a89a8c;
        margin: 0;
    }
    .pj-form-page .btn-back {
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
        white-space: nowrap;
    }
    .pj-form-page .btn-back:hover { background: #e8ded3; }
    .pj-form-page .btn-back i { width: 15px; height: 15px; stroke-width: 2.2; }

    /* ---------- FORM CARD (CENTER) ---------- */
    .pj-form-page .form-card {
        background: #fff;
        border: 1px solid #f0e8de;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 1px 4px rgba(107,77,56,.04);
        max-width: 720px;
        margin: 0 auto;
    }

    /* ---------- FORM SECTION ---------- */
    .pj-form-page .form-section-title {
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
    .pj-form-page .form-section-title i {
        width: 15px; height: 15px;
        stroke-width: 2.2;
        color: #a89a8c;
    }

    /* ---------- FORM GROUP ---------- */
    .pj-form-page .form-group { margin-bottom: 18px; }
    .pj-form-page .form-label {
        display: block;
        font-family: "Inter", sans-serif;
        font-size: 12.5px;
        font-weight: 600;
        color: #4a3d33;
        margin-bottom: 7px;
    }
    .pj-form-page .form-label .req {
        color: #e11d48;
        margin-left: 2px;
    }

    /* ---------- INPUT ---------- */
    .pj-form-page .form-input,
    .pj-form-page .form-select {
        width: 100%;
        height: 46px;
        padding: 0 16px;
        background: #faf7f3;
        border: 1px solid #f0e8de;
        border-radius: 10px;
        font-family: "Inter", sans-serif;
        font-size: 13.5px;
        color: #3f3025;
        outline: none;
        transition: all .2s;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    .pj-form-page .form-input::placeholder { color: #b8aa9c; }
    .pj-form-page .form-input:focus,
    .pj-form-page .form-select:focus {
        border-color: #6b4d38;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(107,77,56,.08);
    }

    /* Select custom arrow */
    .pj-form-page .form-select {
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23a89a8c' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 16px;
        padding-right: 40px;
    }

    /* Input Rp */
    .pj-form-page .input-rp { position: relative; }
    .pj-form-page .input-rp .rp-prefix {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-family: "Inter", sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #6b4d38;
        pointer-events: none;
        z-index: 2;
    }

    /* ---------- GRID 2 KOLOM ---------- */
    .pj-form-page .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    /* ---------- PRODUK LIST ---------- */
    .pj-form-page .produk-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .pj-form-page .produk-item {
        display: grid;
        grid-template-columns: 1fr 100px 40px;
        gap: 10px;
        align-items: center;
    }
    .pj-form-page .produk-item .form-select,
    .pj-form-page .produk-item .form-input {
        height: 46px;
    }
    .pj-form-page .btn-hapus-baris {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: #fde8eb;
        color: #bd4b59;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .18s;
    }
    .pj-form-page .btn-hapus-baris:hover { background: #f5b5be; }
    .pj-form-page .btn-hapus-baris i { width: 16px; height: 16px; }

    .pj-form-page .btn-tambah-baris {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f5efe8;
        color: #6b4d38;
        padding: 10px 16px;
        border-radius: 10px;
        border: 1px dashed #c9b5a4;
        cursor: pointer;
        font-family: "Inter", sans-serif;
        font-size: 12px;
        font-weight: 600;
        margin-top: 10px;
        transition: .18s;
    }
    .pj-form-page .btn-tambah-baris:hover { background: #e8ded3; }
    .pj-form-page .btn-tambah-baris i { width: 15px; height: 15px; }

    /* ---------- TOTAL BOX ---------- */
    .pj-form-page .total-box {
        background: #f5efe8;
        border: 1px solid #e8ddd2;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0;
    }
    .pj-form-page .total-box span {
        font-family: "Inter", sans-serif;
        font-size: 13px;
        color: #6b4d38;
        font-weight: 600;
    }
    .pj-form-page .total-box strong {
        font-family: "Inter", sans-serif;
        font-size: 22px;
        color: #3f3025;
        font-weight: 700;
    }

    /* ---------- ALERT ERROR ---------- */
    .pj-form-page .alert-error {
        background: #fff1f2;
        border: 1px solid #fecdd3;
        color: #be123c;
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-family: "Inter", sans-serif;
        font-size: 13px;
    }
    .pj-form-page .alert-error ul {
        margin: 6px 0 0 16px;
        padding: 0;
    }

    /* ---------- BUTTONS ---------- */
    .pj-form-page .form-actions {
        display: flex;
        gap: 10px;
        padding-top: 20px;
        border-top: 1px solid #f0e8de;
        margin-top: 24px;
    }
    .pj-form-page .btn-submit {
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
        transition: background .2s;
        box-shadow: 0 2px 8px rgba(107,77,56,.22);
        border: none;
        cursor: pointer;
        white-space: nowrap;
        min-width: 180px;
    }
    .pj-form-page .btn-submit:hover { background: #4a3526; }
    .pj-form-page .btn-submit i { width: 16px; height: 16px; stroke-width: 2.5; }

    .pj-form-page .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #f5efe8;
        color: #6b4d38;
        padding: 12px 26px;
        border-radius: 10px;
        font-family: "Inter", sans-serif;
        font-size: 13.5px;
        font-weight: 500;
        text-decoration: none;
        transition: background .2s;
        white-space: nowrap;
        min-width: 120px;
    }
    .pj-form-page .btn-cancel:hover { background: #e8ded3; }

    /* ---------- RESPONSIVE ---------- */
    @media (max-width: 700px) {
        .pj-form-page .page-title { font-size: 22px; }
        .pj-form-page .form-card { padding: 20px; }
        .pj-form-page .form-row { grid-template-columns: 1fr; }
        .pj-form-page .produk-item { grid-template-columns: 1fr; }
        .pj-form-page .btn-hapus-baris { width: 100%; height: 40px; }
        .pj-form-page .form-actions { flex-direction: column-reverse; }
        .pj-form-page .btn-submit,
        .pj-form-page .btn-cancel { width: 100%; }
    }
</style>


<div class="pj-form-page">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb">
        <a href="#"><i data-lucide="house" style="width:14px;height:14px;"></i></a>
        <span class="sep">›</span>
        <a href="#">Dashboard</a>
        <span class="sep">›</span>
        <a href="{{ route('penjualan.index') }}">Penjualan</a>
        <span class="sep">›</span>
        <span class="current">Tambah</span>
    </div>

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-icon"><i data-lucide="receipt-text"></i></div>
            <div>
                <h1 class="page-title">Tambah Penjualan</h1>
                <p class="page-subtitle">Catat produk yang terjual, stok otomatis berkurang.</p>
            </div>
        </div>
        <a href="{{ route('penjualan.index') }}" class="btn-back">
            <i data-lucide="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="form-card">

        @if($errors->any())
            <div class="alert-error">
                <strong>Ada {{ $errors->count() }} kesalahan:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('penjualan.store') }}">
            @csrf

            {{-- SECTION: Informasi Transaksi --}}
            <div class="form-section-title">
                <i data-lucide="info"></i>
                Informasi Transaksi
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">
                        Tanggal <span class="req">*</span>
                    </label>
                    <input type="date"
                           name="tanggal"
                           class="form-input"
                           value="{{ old('tanggal', date('Y-m-d')) }}"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        Status <span class="req">*</span>
                    </label>
                    <select name="status" class="form-select" required>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                </div>
            </div>

            {{-- SECTION: Produk --}}
            <div class="form-section-title" style="margin-top:8px;">
                <i data-lucide="shopping-bag"></i>
                Produk yang Dibeli
            </div>

            <div class="produk-list" id="produkList">
                <div class="produk-item">
                    <select name="produk_id[]" class="form-select produk-select" required onchange="hitungTotal()">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($produks as $p)
                            <option value="{{ $p->id }}"
                                    data-harga="{{ $p->harga_jual }}"
                                    data-stok="{{ $p->stok }}">
                                {{ $p->nama_produk }} (Stok: {{ $p->stok }})
                            </option>
                        @endforeach
                    </select>
                    <input type="number"
                           name="jumlah[]"
                           class="form-input jumlah-input"
                           placeholder="Jumlah"
                           min="1"
                           value="1"
                           required
                           onchange="hitungTotal()"
                           oninput="hitungTotal()">
                    <button type="button" class="btn-hapus-baris" onclick="hapusBaris(this)">
                        <i data-lucide="x"></i>
                    </button>
                </div>
            </div>

            <button type="button" class="btn-tambah-baris" onclick="tambahBaris()">
                <i data-lucide="plus"></i>
                Tambah Baris Produk
            </button>

            {{-- TOTAL --}}
            <div class="total-box">
                <span>Total Pemasukan</span>
                <strong id="totalDisplay">Rp 0</strong>
            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i data-lucide="save"></i>
                    Simpan Penjualan
                </button>
                <a href="{{ route('penjualan.index') }}" class="btn-cancel">Batal</a>
            </div>

        </form>

    </div>

</div>

{{-- Re-init lucide --}}
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

{{-- Script: Hitung Total + Tambah Baris --}}
<script>
    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.produk-item').forEach(function (item) {
            const select = item.querySelector('.produk-select');
            const jumlah = item.querySelector('.jumlah-input');
            const harga = select.options[select.selectedIndex]?.dataset.harga || 0;
            const jml = parseInt(jumlah.value) || 0;
            total += (parseFloat(harga) * jml);
        });
        document.getElementById('totalDisplay').textContent =
            'Rp ' + new Intl.NumberFormat('id-ID').format(total);
    }

    function tambahBaris() {
        const list = document.getElementById('produkList');
        const first = list.querySelector('.produk-item');
        const clone = first.cloneNode(true);

        clone.querySelector('.produk-select').value = '';
        clone.querySelector('.jumlah-input').value = 1;

        list.appendChild(clone);

        if (typeof lucide !== 'undefined') lucide.createIcons();
        hitungTotal();
    }

    function hapusBaris(btn) {
        const list = document.getElementById('produkList');
        if (list.querySelectorAll('.produk-item').length > 1) {
            btn.closest('.produk-item').remove();
            hitungTotal();
        } else {
            alert('Minimal harus ada 1 produk.');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        hitungTotal();
    });
</script>

@endsection
