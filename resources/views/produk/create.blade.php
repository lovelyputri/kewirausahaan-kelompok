@extends('layout')

@section('title', 'Tambah Produk')

@section('content')

<style>
    .produk-form-page * {
        box-sizing: border-box;
    }

    .produk-form-page .breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        max-width: 720px;
        margin: 0 auto 14px;
        color: #a89a8c;
        font-size: 12px;
    }

    .produk-form-page .breadcrumb a {
        display: flex;
        align-items: center;
        color: #a89a8c;
        text-decoration: none;
        transition: color .2s;
    }

    .produk-form-page .breadcrumb a:hover {
        color: #6b4d38;
    }

    .produk-form-page .breadcrumb .sep {
        color: #d6c9bb;
        font-size: 14px;
    }

    .produk-form-page .breadcrumb .current {
        color: #3f3025;
        font-weight: 600;
    }

    .produk-form-page .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        max-width: 720px;
        margin: 0 auto 22px;
        flex-wrap: wrap;
    }

    .produk-form-page .page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .produk-form-page .page-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        color: #fff;
        background: #6b4d38;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(107, 77, 56, .28);
    }

    .produk-form-page .page-icon i {
        width: 24px;
        height: 24px;
        stroke-width: 2;
    }

    .produk-form-page .page-title {
        margin: 0 0 2px;
        color: #3f3025;
        font-family: "DM Serif Display", serif;
        font-size: 26px;
        font-weight: 400;
    }

    .produk-form-page .page-subtitle {
        margin: 0;
        color: #a89a8c;
        font-size: 12px;
    }

    .produk-form-page .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 18px;
        color: #6b4d38;
        background: #f5efe8;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: .2s;
    }

    .produk-form-page .btn-back:hover {
        background: #e8ded3;
    }

    .produk-form-page .btn-back i {
        width: 16px;
        height: 16px;
    }

    .produk-form-page .form-card {
        max-width: 720px;
        margin: 0 auto;
        padding: 28px;
        background: #fff;
        border: 1px solid #f0e8de;
        border-radius: 16px;
        box-shadow: 0 1px 4px rgba(107, 77, 56, .04);
    }

    .produk-form-page .alert-error {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 20px;
        padding: 14px 16px;
        color: #be123c;
        background: #fff1f2;
        border: 1px solid #fecdd3;
        border-radius: 12px;
        font-size: 13px;
    }

    .produk-form-page .alert-error > i {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .produk-form-page .alert-error ul {
        margin: 6px 0 0 16px;
        padding: 0;
    }

    .produk-form-page .form-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
        padding-bottom: 10px;
        color: #6b4d38;
        border-bottom: 1px solid #f0e8de;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
    }

    .produk-form-page .form-section-title i {
        width: 15px;
        height: 15px;
        color: #a89a8c;
        stroke-width: 2.2;
    }

    .produk-form-page .form-group {
        margin-bottom: 18px;
    }

    .produk-form-page .form-label {
        display: block;
        margin-bottom: 7px;
        color: #4a3d33;
        font-size: 12.5px;
        font-weight: 600;
    }

    .produk-form-page .form-label .req {
        color: #e11d48;
    }

    .produk-form-page .form-input,
    .produk-form-page .form-select {
        width: 100%;
        height: 46px;
        padding: 0 16px;
        outline: none;
        color: #3f3025;
        background: #faf7f3;
        border: 1px solid #f0e8de;
        border-radius: 10px;
        font-size: 13.5px;
        transition: .2s;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .produk-form-page .form-input::placeholder {
        color: #b8aa9c;
    }

    .produk-form-page .form-input:focus,
    .produk-form-page .form-select:focus {
        background: #fff;
        border-color: #6b4d38;
        box-shadow: 0 0 0 3px rgba(107, 77, 56, .08);
    }

    .produk-form-page .input-wrap {
        position: relative;
    }

    .produk-form-page .input-wrap .input-icon {
        position: absolute;
        top: 50%;
        left: 14px;
        z-index: 2;
        width: 16px;
        height: 16px;
        color: #a89a8c;
        pointer-events: none;
        transform: translateY(-50%);
    }

    .produk-form-page .input-wrap .form-input {
        padding-left: 40px;
    }

    .produk-form-page .input-rp {
        position: relative;
    }

    .produk-form-page .input-rp .rp-prefix {
        position: absolute;
        top: 50%;
        left: 14px;
        z-index: 2;
        color: #6b4d38;
        font-size: 13px;
        font-weight: 600;
        pointer-events: none;
        transform: translateY(-50%);
    }

    .produk-form-page .input-rp .form-input {
        padding-left: 40px;
    }

    .produk-form-page .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .produk-form-page .gambar-preview {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 110px;
        height: 110px;
        margin-top: 10px;
        overflow: hidden;
        color: #b8aa9c;
        background: #faf7f3;
        border: 1px dashed #e8ddd2;
        border-radius: 12px;
        font-size: 11px;
    }

    .produk-form-page .gambar-preview img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .produk-form-page .helper-text {
        display: block;
        margin-top: 6px;
        color: #a89a8c;
        font-size: 11px;
    }

    .produk-form-page .helper-text code {
        padding: 2px 5px;
        color: #6b4d38;
        background: #f5efe8;
        border-radius: 4px;
    }

    .produk-form-page .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #f0e8de;
    }

    .produk-form-page .btn-submit,
    .produk-form-page .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 26px;
        border-radius: 10px;
        font-size: 13.5px;
    }

    .produk-form-page .btn-submit {
        min-width: 160px;
        color: #fff;
        background: #6b4d38;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
    }

    .produk-form-page .btn-submit:hover {
        background: #4a3526;
    }

    .produk-form-page .btn-submit i {
        width: 17px;
        height: 17px;
    }

    .produk-form-page .btn-cancel {
        min-width: 120px;
        color: #6b4d38;
        background: #f5efe8;
        font-weight: 500;
        text-decoration: none;
        transition: .2s;
    }

    .produk-form-page .btn-cancel:hover {
        background: #e8ded3;
    }

    @media (max-width: 700px) {
        .produk-form-page .page-title {
            font-size: 22px;
        }

        .produk-form-page .form-card {
            padding: 20px;
        }

        .produk-form-page .form-row {
            grid-template-columns: 1fr;
        }

        .produk-form-page .form-actions {
            flex-direction: column-reverse;
        }

        .produk-form-page .btn-submit,
        .produk-form-page .btn-cancel {
            width: 100%;
        }
    }
</style>

<div class="produk-form-page">

{{-- =========================
     BREADCRUMB
========================== --}}
<div class="breadcrumb">

    <a href="{{ route('dashboard') }}">
        <i data-lucide="house"></i>
    </a>

    <span class="sep">›</span>

    <a href="{{ route('produk.index') }}">
        Produk
    </a>

    <span class="sep">›</span>

    <span class="current">
        Tambah
    </span>

</div>


{{-- =========================
     HEADER
========================== --}}
<div class="page-header">

    <div class="page-header-left">

        <div class="page-icon">
            <i data-lucide="package-plus"></i>
        </div>

        <div>
            <h1 class="page-title">
                Tambah Produk
            </h1>

            <p class="page-subtitle">
                Lengkapi data produk baru yang akan dijual.
            </p>
        </div>

    </div>

    <a href="{{ route('produk.index') }}" class="btn-back">
        <i data-lucide="arrow-left"></i>
        Kembali
    </a>

</div>


{{-- =========================
     FORM CARD
========================== --}}
<div class="form-card">

    {{-- =========================
         ERROR VALIDATION
    ========================== --}}
    @if ($errors->any())

        <div class="alert-error">

            <i data-lucide="circle-alert"></i>

            <div>

                <strong>
                    Periksa kembali data yang dimasukkan.
                </strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>

            </div>

        </div>

    @endif


    {{-- =========================
         FORM
    ========================== --}}
    <form
        method="POST"
        action="{{ route('produk.store') }}"
    >

        @csrf


        {{-- =========================
             INFORMASI PRODUK
        ========================== --}}
        <div class="form-section-title">
            <i data-lucide="info"></i>
            Informasi Produk
        </div>


        {{-- KATEGORI --}}
        <div class="form-group">

            <label class="form-label">
                Kategori <span class="req">*</span>
            </label>

            <select
                name="id_kategori"
                class="form-select"
                required
            >

                <option value="">
                    -- Pilih Kategori --
                </option>

                @foreach ($kategoris as $k)

                    <option
                        value="{{ $k->id }}"
                        {{ old('id_kategori') == $k->id ? 'selected' : '' }}
                    >
                        {{ $k->nama_kategori }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- NAMA PRODUK --}}
        <div class="form-group">

            <label class="form-label">
                Nama Produk <span class="req">*</span>
            </label>

            <div class="input-wrap">

                <i
                    data-lucide="tag"
                    class="input-icon"
                ></i>

                <input
                    type="text"
                    name="nama_produk"
                    value="{{ old('nama_produk') }}"
                    placeholder="Contoh: Croissant Butter"
                    class="form-input"
                    required
                >

            </div>

        </div>


        {{-- =========================
             HARGA
        ========================== --}}
        <div
            class="form-section-title"
            style="margin-top: 8px;"
        >

            <i data-lucide="wallet"></i>
            Harga

        </div>


        <div class="form-row">

            {{-- HARGA BELI --}}
            <div class="form-group">

                <label class="form-label">
                    Harga Beli <span class="req">*</span>
                </label>

                <div class="input-rp">

                    <span class="rp-prefix">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="harga_beli"
                        value="{{ old('harga_beli') }}"
                        placeholder="0"
                        class="form-input"
                        min="0"
                        required
                    >

                </div>

            </div>


            {{-- HARGA JUAL --}}
            <div class="form-group">

                <label class="form-label">
                    Harga Jual <span class="req">*</span>
                </label>

                <div class="input-rp">

                    <span class="rp-prefix">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="harga_jual"
                        value="{{ old('harga_jual') }}"
                        placeholder="0"
                        class="form-input"
                        min="0"
                        required
                    >

                </div>

            </div>

        </div>


        {{-- =========================
             STOK
        ========================== --}}
        <div
            class="form-section-title"
            style="margin-top: 8px;"
        >

            <i data-lucide="boxes"></i>
            Stok

        </div>


        <div class="form-group">

            <label class="form-label">
                Jumlah Stok <span class="req">*</span>
            </label>

            <div class="input-wrap">

                <i
                    data-lucide="package"
                    class="input-icon"
                ></i>

                <input
                    type="number"
                    name="stok"
                    value="{{ old('stok', 0) }}"
                    placeholder="0"
                    class="form-input"
                    min="0"
                    required
                >

            </div>

        </div>


        {{-- =========================
             GAMBAR PRODUK
        ========================== --}}
        <div class="form-section-title">

            <i data-lucide="image"></i>
            Gambar Produk

        </div>


        <div class="form-group">

            <label class="form-label">
                Gambar Produk
            </label>

            <select
                name="gambar"
                id="gambarSelect"
                class="form-select"
                onchange="previewGambar(this)"
            >

                <option value="">
                    -- Pilih Gambar --
                </option>

                @foreach ($gambarList as $gbr)

                    <option
                        value="{{ $gbr }}"
                        {{ old('gambar') == $gbr ? 'selected' : '' }}
                    >
                        {{ $gbr }}
                    </option>

                @endforeach

            </select>


            {{-- PREVIEW --}}
            <div
                class="gambar-preview"
                id="gambarPreview"
            >
                <span>
                    Preview
                </span>
            </div>


            <small class="helper-text">
                Pilih gambar dari folder
                <code>public/images</code>.
            </small>

        </div>


        {{-- =========================
             ACTIONS
        ========================== --}}
        <div class="form-actions">

            <a
                href="{{ route('produk.index') }}"
                class="btn-cancel"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn-submit"
            >
                <i data-lucide="save"></i>
                Simpan Produk
            </button>

        </div>

    </form>

</div>

</div>

<script>
    function previewGambar(select) {
        const preview = document.getElementById('gambarPreview');

        if (!preview) {
            return;
        }

        const value = select.value;

        if (value) {
            preview.innerHTML = `
                <img
                    src="/images/${value}"
                    alt="Preview ${value}"
                >
            `;
        } else {
            preview.innerHTML = `
                <span>Preview</span>
            `;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {

        const select = document.getElementById('gambarSelect');

        if (select && select.value) {
            previewGambar(select);
        }

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    });
</script>

@endsection
