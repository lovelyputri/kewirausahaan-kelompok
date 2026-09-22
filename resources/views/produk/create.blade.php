@extends('layout')

@section('title', 'Tambah Produk')

@section('content')

<style>
    .produk-form-page * {
        box-sizing: border-box;
    }

    /* =========================
       BREADCRUMB
    ========================== */
    .produk-form-page .breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #a89a8c;
        margin-bottom: 14px;
        max-width: 720px;
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
        color: #6b4d38;
    }

    .produk-form-page .breadcrumb .sep {
        color: #d6c9bb;
    }

    .produk-form-page .breadcrumb .current {
        color: #3f3025;
        font-weight: 600;
    }

    .produk-form-page .breadcrumb svg {
        width: 14px;
        height: 14px;
        display: block;
    }


    /* =========================
       PAGE HEADER
    ========================== */
    .produk-form-page .page-header {
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

    .produk-form-page .page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .produk-form-page .page-icon {
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

    .produk-form-page .page-icon i,
    .produk-form-page .page-icon svg {
        width: 24px;
        height: 24px;
        display: block;
    }

    .produk-form-page .page-title {
        font-family: "DM Serif Display", serif;
        font-size: 26px;
        font-weight: 400;
        color: #3f3025;
        margin: 0 0 2px 0;
    }

    .produk-form-page .page-subtitle {
        font-size: 12px;
        color: #a89a8c;
        margin: 0;
    }


    /* =========================
       FORM CARD
    ========================== */
    .produk-form-page .form-card {
        background: #fff;
        border: 1px solid #f0e8de;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 1px 4px rgba(107, 77, 56, .04);
        max-width: 720px;
        margin: 0 auto;
    }


    /* =========================
       SECTION TITLE
    ========================== */
    .produk-form-page .form-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 700;
        color: #6b4d38;
        text-transform: uppercase;
        letter-spacing: .8px;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0e8de;
    }

    .produk-form-page .form-section-title i,
    .produk-form-page .form-section-title svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        display: block;
    }


    /* =========================
       FORM GROUP
    ========================== */
    .produk-form-page .form-group {
        margin-bottom: 18px;
    }

    .produk-form-page .form-label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: #4a3d33;
        margin-bottom: 7px;
    }

    .produk-form-page .form-label .req {
        color: #e11d48;
    }


    /* =========================
       INPUT
    ========================== */
    .produk-form-page .form-input,
    .produk-form-page .form-select {
        width: 100%;
        height: 46px;
        padding: 0 16px;
        background: #faf7f3;
        border: 1px solid #f0e8de;
        border-radius: 10px;
        font-size: 13.5px;
        color: #3f3025;
        outline: none;
        transition: .2s;
    }

    .produk-form-page .form-input::placeholder {
        color: #b8aa9c;
    }

    .produk-form-page .form-input:focus,
    .produk-form-page .form-select:focus {
        border-color: #6b4d38;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(107, 77, 56, .08);
    }


    /* =========================
       INPUT WITH ICON
    ========================== */
    .produk-form-page .input-wrap {
        position: relative;
        width: 100%;
    }

    .produk-form-page .input-wrap .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #a89a8c;
        pointer-events: none;
        z-index: 2;
    }

    .produk-form-page .input-wrap .input-icon svg {
        width: 16px;
        height: 16px;
        display: block;
    }

    .produk-form-page .input-wrap .form-input {
        padding-left: 40px;
    }


    /* =========================
       INPUT RUPIAH
    ========================== */
    .produk-form-page .input-rp {
        position: relative;
        width: 100%;
    }

    .produk-form-page .input-rp .rp-prefix {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 13px;
        font-weight: 600;
        color: #6b4d38;
        pointer-events: none;
        z-index: 2;
    }

    .produk-form-page .input-rp .form-input {
        padding-left: 40px;
    }


    /* =========================
       HARGA
    ========================== */
    .produk-form-page .form-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }


    /* =========================
       ALERT ERROR
    ========================== */
    .produk-form-page .alert-error {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #fff1f2;
        border: 1px solid #fecdd3;
        color: #be123c;
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .produk-form-page .alert-error > svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .produk-form-page .alert-error strong {
        display: block;
        margin-bottom: 4px;
    }

    .produk-form-page .alert-error ul {
        margin: 6px 0 0 16px;
        padding: 0;
    }

    .produk-form-page .alert-error li {
        margin-bottom: 2px;
    }


    /* =========================
       UPLOAD GAMBAR
    ========================== */
    .produk-form-page .file-input-wrap {
        position: relative;
        width: 100%;
    }

    .produk-form-page .file-input-wrap input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .produk-form-page .file-input-display {
        display: flex;
        align-items: center;
        gap: 10px;
        height: 46px;
        padding: 0 16px;
        background: #faf7f3;
        border: 1px dashed #c9b5a4;
        border-radius: 10px;
        color: #6b4d38;
        font-size: 13px;
        transition: .2s;
        overflow: hidden;
    }

    .produk-form-page .file-input-wrap:hover .file-input-display {
        background: #f5efe8;
        border-color: #6b4d38;
    }

    .produk-form-page .file-input-display i,
    .produk-form-page .file-input-display svg {
        width: 18px;
        height: 18px;
        color: #a89a8c;
        flex-shrink: 0;
        display: block;
    }

    .produk-form-page .file-input-display span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .produk-form-page .gambar-preview {
        margin-top: 12px;
        width: 130px;
        height: 130px;
        border-radius: 12px;
        border: 1px solid #e8ddd2;
        background: #faf7f3;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #b8aa9c;
        font-size: 11px;
    }

    .produk-form-page .gambar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .produk-form-page .file-help {
        color: #a89a8c;
        font-size: 11px;
        margin-top: 6px;
        display: block;
    }


    /* =========================
       FORM ACTIONS
    ========================== */
    .produk-form-page .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 20px;
        border-top: 1px solid #f0e8de;
        margin-top: 24px;
    }

    .produk-form-page .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #6b4d38;
        color: #fff;
        padding: 12px 26px;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        min-width: 160px;
        transition: .2s;
    }

    .produk-form-page .btn-submit:hover {
        background: #4a3526;
    }

    .produk-form-page .btn-submit i,
    .produk-form-page .btn-submit svg {
        width: 16px;
        height: 16px;
        display: block;
        flex-shrink: 0;
    }

    .produk-form-page .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #f5efe8;
        color: #6b4d38;
        padding: 12px 26px;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 500;
        text-decoration: none;
        min-width: 120px;
        transition: .2s;
    }

    .produk-form-page .btn-cancel:hover {
        background: #e8ded3;
    }


    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 700px) {

        .produk-form-page .page-title {
            font-size: 22px;
        }

        .produk-form-page .form-card {
            padding: 20px;
        }

        .produk-form-page .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .produk-form-page .form-actions {
            flex-direction: column-reverse;
        }

        .produk-form-page .btn-submit,
        .produk-form-page .btn-cancel {
            width: 100%;
        }

        .produk-form-page .gambar-preview {
            width: 110px;
            height: 110px;
        }
    }
</style>


<div class="produk-form-page">

    {{-- =========================
         BREADCRUMB
    ========================== --}}
    <div class="breadcrumb">

        <a href="{{ route('dashboard') }}" aria-label="Dashboard">
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
         PAGE HEADER
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
            enctype="multipart/form-data"
        >

            @csrf


            {{-- =========================
                 INFORMASI PRODUK
            ========================== --}}
            <div class="form-section-title">

                <i data-lucide="info"></i>

                <span>
                    Informasi Produk
                </span>

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

                    @foreach($kategoris as $k)

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

                <span>
                    Harga
                </span>

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

                <span>
                    Stok
                </span>

            </div>


            {{-- JUMLAH STOK --}}
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
            <div class="form-group">

                <label class="form-label">
                    Gambar Produk
                </label>

                <div class="file-input-wrap">

                    <input
                        type="file"
                        name="gambar"
                        accept="image/*"
                        onchange="previewGambar(this)"
                    >

                    <div class="file-input-display">

                        <i data-lucide="image-plus"></i>

                        <span id="fileLabel">
                            Klik untuk pilih gambar...
                        </span>

                    </div>

                </div>


                {{-- PREVIEW --}}
                <div
                    class="gambar-preview"
                    id="gambarPreview"
                >
                    <span>
                        Preview
                    </span>
                </div>


                <small class="file-help">
                    Format: JPG, PNG, WEBP. Maks 2MB.
                </small>

            </div>


            {{-- =========================
                 ACTION
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

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }


    function previewGambar(input) {

        const preview = document.getElementById('gambarPreview');
        const label = document.getElementById('fileLabel');


        if (input.files && input.files[0]) {

            const reader = new FileReader();


            reader.onload = function (e) {

                preview.innerHTML =
                    '<img src="' +
                    e.target.result +
                    '" alt="Preview">';

            };


            reader.readAsDataURL(input.files[0]);


            label.textContent =
                input.files[0].name;

        } else {

            preview.innerHTML =
                '<span>Preview</span>';

            label.textContent =
                'Klik untuk pilih gambar...';

        }

    }

</script>

@endsection
