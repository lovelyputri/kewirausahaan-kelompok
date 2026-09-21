@extends('layout')

@section('title', 'Tambah Produk')

@section('content')

<style>
    .produk-form-page * {
        box-sizing: border-box;
    }

    .produk-form-page {
        width: 100%;
    }

    /* =========================
       BREADCRUMB
    ========================= */
    .produk-form-page .breadcrumb {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        color: #a89a8c;
        margin-bottom: 14px;
        max-width: 660px;
        margin-left: auto;
        margin-right: auto;
    }

    .produk-form-page .breadcrumb a {
        color: #a89a8c;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .produk-form-page .breadcrumb a:hover {
        color: #6f4d36;
    }

    .produk-form-page .breadcrumb .sep {
        color: #d2c4b6;
    }

    .produk-form-page .breadcrumb .current {
        color: #3f3025;
        font-weight: 600;
    }

    /* =========================
       HEADER
    ========================= */
    .produk-form-page .page-header {
        max-width: 660px;
        margin: 0 auto 22px auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .produk-form-page .page-header-left {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .produk-form-page .page-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #6f4d36;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 3px 8px rgba(111, 77, 54, .14);
    }

    .produk-form-page .page-icon i {
        width: 22px;
        height: 22px;
    }

    .produk-form-page .page-title {
        margin: 0;
        color: #30231b;
        font-family: "DM Serif Display", Georgia, serif;
        font-size: 25px;
        line-height: 1.1;
        font-weight: 400;
    }

    .produk-form-page .page-subtitle {
        margin: 4px 0 0;
        color: #a89a8c;
        font-size: 11.5px;
        line-height: 1.4;
    }

    .produk-form-page .btn-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 17px;
        background: #f5efe8;
        color: #654832;
        text-decoration: none;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
        transition: .2s ease;
    }

    .produk-form-page .btn-back i {
        width: 17px;
        height: 17px;
    }

    .produk-form-page .btn-back:hover {
        background: #ebe1d7;
        color: #4f3524;
    }

    /* =========================
       FORM CARD
    ========================= */
    .produk-form-page .form-card {
        width: 100%;
        max-width: 660px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid #eee4da;
        border-radius: 15px;
        padding: 25px 27px 26px;
        box-shadow: 0 2px 8px rgba(85, 61, 43, .045);
    }

    /* =========================
       ALERT
    ========================= */
    .produk-form-page .alert-error {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #fff6f4;
        border: 1px solid #efd4cb;
        color: #9f4636;
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 20px;
        font-size: 12px;
    }

    .produk-form-page .alert-error i {
        width: 17px;
        height: 17px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .produk-form-page .alert-error ul {
        margin: 5px 0 0 16px;
        padding: 0;
    }

    /* =========================
       SECTION TITLE
    ========================= */
    .produk-form-page .form-section {
        margin-bottom: 20px;
    }

    .produk-form-page .section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6f4d36;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: .55px;
        text-transform: uppercase;
        padding-bottom: 9px;
        border-bottom: 1px solid #eee4da;
        margin-bottom: 15px;
    }

    .produk-form-page .section-title i {
        width: 17px;
        height: 17px;
    }

    /* =========================
       FORM GROUP
    ========================= */
    .produk-form-page .form-group {
        margin-bottom: 16px;
    }

    .produk-form-page .form-label {
        display: block;
        color: #4a382b;
        font-size: 11.5px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .produk-form-page .required {
        color: #dc3545;
    }

    .produk-form-page .input-wrap {
        position: relative;
    }

    .produk-form-page .input-wrap > i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        color: #b6a79a;
        pointer-events: none;
        z-index: 2;
    }

    .produk-form-page .form-input,
    .produk-form-page .form-select {
        width: 100%;
        height: 42px;
        border: 1px solid #eee4da;
        background: #fbf8f5;
        border-radius: 10px;
        color: #4a382b;
        font-family: inherit;
        font-size: 12px;
        padding: 0 13px;
        outline: none;
        transition: .2s ease;
    }

    .produk-form-page .input-wrap .form-input,
    .produk-form-page .input-wrap .form-select {
        padding-left: 37px;
    }

    .produk-form-page .form-input:focus,
    .produk-form-page .form-select:focus {
        border-color: #b99a80;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(111, 77, 54, .07);
    }

    .produk-form-page .form-select {
        cursor: pointer;
        appearance: auto;
    }

    .produk-form-page .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    /* =========================
       IMAGE SELECT
    ========================= */
    .produk-form-page .image-select-wrap {
        position: relative;
    }

    .produk-form-page .image-select-wrap > i {
        position: absolute;
        left: 12px;
        top: 13px;
        width: 15px;
        height: 15px;
        color: #b6a79a;
        pointer-events: none;
        z-index: 2;
    }

    .produk-form-page .image-select-wrap .form-select {
        padding-left: 37px;
    }

    .produk-form-page .image-preview {
        margin-top: 9px;
        width: 100px;
        height: 100px;
        border: 1px dashed #dfd2c6;
        border-radius: 10px;
        background: #fcfaf8;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .produk-form-page .image-preview span {
        color: #b8a99c;
        font-size: 10px;
        text-align: center;
    }

    .produk-form-page .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    /* =========================
       INFO
    ========================= */
    .produk-form-page .helper-text {
        margin-top: 5px;
        font-size: 10px;
        color: #afa095;
    }

    /* =========================
       ACTION
    ========================= */
    .produk-form-page .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 9px;
        border-top: 1px solid #eee4da;
        padding-top: 18px;
        margin-top: 7px;
    }

    .produk-form-page .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        height: 40px;
        min-width: 100px;
        padding: 0 17px;
        border-radius: 9px;
        background: #f5efe8;
        color: #654832;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: .2s ease;
    }

    .produk-form-page .btn-cancel:hover {
        background: #ebe1d7;
    }

    .produk-form-page .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        height: 40px;
        min-width: 145px;
        padding: 0 18px;
        border: none;
        border-radius: 9px;
        background: #6f4d36;
        color: #fff;
        font-family: inherit;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
        box-shadow: 0 3px 7px rgba(111, 77, 54, .13);
    }

    .produk-form-page .btn-submit i {
        width: 16px;
        height: 16px;
    }

    .produk-form-page .btn-submit:hover {
        background: #5e402d;
        transform: translateY(-1px);
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 760px) {
        .produk-form-page .breadcrumb,
        .produk-form-page .page-header,
        .produk-form-page .form-card {
            max-width: 100%;
        }

        .produk-form-page .page-header {
            align-items: flex-start;
        }
    }

    @media (max-width: 600px) {
        .produk-form-page .page-header {
            flex-direction: column;
        }

        .produk-form-page .btn-back {
            width: 100%;
        }

        .produk-form-page .form-card {
            padding: 20px 17px;
        }

        .produk-form-page .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .produk-form-page .form-actions {
            flex-direction: column-reverse;
        }

        .produk-form-page .btn-cancel,
        .produk-form-page .btn-submit {
            width: 100%;
        }
    }
</style>

<div class="produk-form-page">

    {{-- =========================
         BREADCRUMB
    ========================= --}}
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
    ========================= --}}
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
                    Tambahkan produk baru yang tersedia di toko Anda.
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
    ========================= --}}
    <div class="form-card">

        {{-- ERROR VALIDATION --}}
        @if($errors->any())

            <div class="alert-error">

                <i data-lucide="circle-alert"></i>

                <div>

                    <strong>
                        Periksa kembali data yang dimasukkan.
                    </strong>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif


        <form
            action="{{ route('produk.store') }}"
            method="POST"
        >

            @csrf


            {{-- =========================
                 INFORMASI PRODUK
            ========================= --}}
            <div class="form-section">

                <div class="section-title">

                    <i data-lucide="circle-info"></i>

                    Informasi Produk

                </div>


                {{-- KATEGORI --}}
                <div class="form-group">

                    <label class="form-label">

                        Kategori
                        <span class="required">*</span>

                    </label>

                    <div class="input-wrap">

                        <i data-lucide="grid-2x2"></i>

                        <select
                            name="id_kategori"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            @foreach($kategoris as $kategori)

                                <option
                                    value="{{ $kategori->id }}"
                                    {{ old('id_kategori') == $kategori->id ? 'selected' : '' }}
                                >
                                    {{ $kategori->nama_kategori }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- NAMA PRODUK --}}
                <div class="form-group">

                    <label class="form-label">

                        Nama Produk
                        <span class="required">*</span>

                    </label>

                    <div class="input-wrap">

                        <i data-lucide="tag"></i>

                        <input
                            type="text"
                            name="nama_produk"
                            class="form-input"
                            value="{{ old('nama_produk') }}"
                            placeholder="Contoh: Croissant"
                            required
                        >

                    </div>

                </div>

            </div>


            {{-- =========================
                 HARGA
            ========================= --}}
            <div class="form-section">

                <div class="section-title">

                    <i data-lucide="wallet-cards"></i>

                    Harga

                </div>


                <div class="form-row">

                    {{-- HARGA BELI --}}
                    <div class="form-group">

                        <label class="form-label">

                            Harga Beli
                            <span class="required">*</span>

                        </label>

                        <div class="input-wrap">

                            <i data-lucide="banknote"></i>

                            <input
                                type="number"
                                name="harga_beli"
                                class="form-input"
                                value="{{ old('harga_beli') }}"
                                placeholder="0"
                                min="0"
                                step="1"
                                required
                            >

                        </div>

                    </div>


                    {{-- HARGA JUAL --}}
                    <div class="form-group">

                        <label class="form-label">

                            Harga Jual
                            <span class="required">*</span>

                        </label>

                        <div class="input-wrap">

                            <i data-lucide="badge-dollar-sign"></i>

                            <input
                                type="number"
                                name="harga_jual"
                                class="form-input"
                                value="{{ old('harga_jual') }}"
                                placeholder="0"
                                min="0"
                                step="1"
                                required
                            >

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================
                 STOK
            ========================= --}}
            <div class="form-section">

                <div class="section-title">

                    <i data-lucide="boxes"></i>

                    Stok

                </div>


                <div class="form-group">

                    <label class="form-label">

                        Jumlah Stok
                        <span class="required">*</span>

                    </label>

                    <div class="input-wrap">

                        <i data-lucide="package"></i>

                        <input
                            type="number"
                            name="stok"
                            class="form-input"
                            value="{{ old('stok', 0) }}"
                            placeholder="Masukkan jumlah stok"
                            min="0"
                            required
                        >

                    </div>

                    <div class="helper-text">
                        Masukkan jumlah stok awal produk.
                    </div>

                </div>

            </div>


            {{-- =========================
                 GAMBAR PRODUK
            ========================= --}}
            <div class="form-section">

                <div class="section-title">

                    <i data-lucide="image"></i>

                    Gambar Produk

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Pilih Gambar
                    </label>

                    <div class="image-select-wrap">

                        <i data-lucide="image"></i>

                        <select
                            name="gambar"
                            id="gambar"
                            class="form-select"
                            onchange="previewGambar()"
                        >

                            <option value="">
                                -- Pilih Gambar --
                            </option>

                            @foreach($gambarList as $gambar)

                                <option
                                    value="{{ $gambar }}"
                                    data-src="{{ asset('images/' . $gambar) }}"
                                    {{ old('gambar') == $gambar ? 'selected' : '' }}
                                >
                                    {{ $gambar }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- PREVIEW --}}
                    <div class="image-preview" id="imagePreview">

                        <span id="previewText">
                            Preview
                        </span>

                        <img
                            id="previewImage"
                            src=""
                            alt="Preview gambar produk"
                        >

                    </div>

                </div>

            </div>


            {{-- =========================
                 ACTION
            ========================= --}}
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
    function previewGambar() {

        const select = document.getElementById('gambar');
        const image = document.getElementById('previewImage');
        const text = document.getElementById('previewText');

        if (!select || !image || !text) {
            return;
        }

        const selectedOption =
            select.options[select.selectedIndex];

        const src =
            selectedOption?.dataset.src || '';

        if (src) {

            image.src = src;
            image.style.display = 'block';
            text.style.display = 'none';

        } else {

            image.src = '';
            image.style.display = 'none';
            text.style.display = 'block';

        }
    }


    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        previewGambar();

    });
</script>

@endsection
