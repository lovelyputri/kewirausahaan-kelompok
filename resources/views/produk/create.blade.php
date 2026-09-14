@extends('layout')

@section('title', 'Tambah Produk')

@section('content')

<style>
    /* =====================================================
       SCOPE KHUSUS HALAMAN TAMBAH PRODUK
    ===================================================== */
    .produk-form-page * { box-sizing: border-box; }

    .produk-form-page .breadcrumb { display: flex; align-items: center; gap: 6px; font-family: "Inter", sans-serif; font-size: 12px; color: #a89a8c; margin-bottom: 14px; }
    .produk-form-page .breadcrumb a { color: #a89a8c; text-decoration: none; display: flex; align-items: center; transition: color .2s; }
    .produk-form-page .breadcrumb a:hover { color: #6b4d38; }
    .produk-form-page .breadcrumb .sep { color: #d6c9bb; font-size: 14px; }
    .produk-form-page .breadcrumb .current { color: #3f3025; font-weight: 600; }

    .produk-form-page .page-header { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; flex-wrap: wrap; max-width: 720px; margin-left: auto; margin-right: auto; }
    .produk-form-page .page-header-left { display: flex; align-items: center; gap: 14px; }
    .produk-form-page .page-icon { width: 48px; height: 48px; background: #6b4d38; color: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 8px rgba(107,77,56,.28); }
    .produk-form-page .page-icon i { width: 24px; height: 24px; stroke-width: 2; }
    .produk-form-page .page-title { font-family: "DM Serif Display", serif; font-size: 26px; font-weight: 400; color: #3f3025; margin: 0 0 2px 0; letter-spacing: .3px; line-height: 1.1; }
    .produk-form-page .page-subtitle { font-family: "Inter", sans-serif; font-size: 12px; color: #a89a8c; margin: 0; }
    .produk-form-page .btn-back { display: inline-flex; align-items: center; gap: 6px; background: #f5efe8; color: #6b4d38; padding: 10px 18px; border-radius: 10px; font-family: "Inter", sans-serif; font-size: 13px; font-weight: 500; text-decoration: none; transition: background .2s; border: none; cursor: pointer; white-space: nowrap; }
    .produk-form-page .btn-back:hover { background: #e8ded3; }
    .produk-form-page .btn-back i { width: 15px; height: 15px; stroke-width: 2.2; }

    .produk-form-page .form-card { background: #fff; border: 1px solid #f0e8de; border-radius: 16px; padding: 28px; box-shadow: 0 1px 4px rgba(107,77,56,.04); max-width: 720px; margin: 0 auto; }

    .produk-form-page .form-section-title { display: flex; align-items: center; gap: 8px; font-family: "Inter", sans-serif; font-size: 12px; font-weight: 700; color: #6b4d38; text-transform: uppercase; letter-spacing: .8px; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 1px solid #f0e8de; }
    .produk-form-page .form-section-title i { width: 15px; height: 15px; stroke-width: 2.2; color: #a89a8c; }

    .produk-form-page .form-group { margin-bottom: 18px; }
    .produk-form-page .form-label { display: block; font-family: "Inter", sans-serif; font-size: 12.5px; font-weight: 600; color: #4a3d33; margin-bottom: 7px; letter-spacing: .2px; }
    .produk-form-page .form-label .req { color: #e11d48; margin-left: 2px; }

    .produk-form-page .form-input,
    .produk-form-page .form-select { width: 100%; height: 46px; padding: 0 16px; background: #faf7f3; border: 1px solid #f0e8de; border-radius: 10px; font-family: "Inter", sans-serif; font-size: 13.5px; color: #3f3025; outline: none; transition: all .2s; appearance: none; -webkit-appearance: none; -moz-appearance: none; }
    .produk-form-page .form-input::placeholder { color: #b8aa9c; }
    .produk-form-page .form-input:focus,
    .produk-form-page .form-select:focus { border-color: #6b4d38; background: #fff; box-shadow: 0 0 0 3px rgba(107,77,56,.08); }

    .produk-form-page .input-wrap { position: relative; }
    .produk-form-page .input-wrap .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: #a89a8c; pointer-events: none; z-index: 2; }
    .produk-form-page .input-wrap .form-input { padding-left: 40px; }

    .produk-form-page .input-rp { position: relative; }
    .produk-form-page .input-rp .rp-prefix { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-family: "Inter", sans-serif; font-size: 13px; font-weight: 600; color: #6b4d38; pointer-events: none; z-index: 2; }
    .produk-form-page .input-rp .form-input { padding-left: 40px; }

    .produk-form-page .dropdown { position: relative; }
    .produk-form-page .dropdown-toggle { width: 100%; height: 46px; padding: 0 38px 0 42px; background: #faf7f3; border: 1px solid #f0e8de; border-radius: 10px; font-family: "Inter", sans-serif; font-size: 13.5px; font-weight: 500; color: #3f3025; cursor: pointer; display: flex; align-items: center; text-align: left; transition: all .2s; position: relative; }
    .produk-form-page .dropdown-toggle:hover { background: #f5efe8; }
    .produk-form-page .dropdown.open .dropdown-toggle { border-color: #6b4d38; background: #fff; box-shadow: 0 0 0 3px rgba(107,77,56,.08); }
    .produk-form-page .dropdown-toggle .icon-lead { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: #a89a8c; pointer-events: none; }
    .produk-form-page .dropdown-toggle .icon-chevron { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: #a89a8c; pointer-events: none; transition: transform .2s; }
    .produk-form-page .dropdown.open .icon-chevron { transform: translateY(-50%) rotate(180deg); }
    .produk-form-page .dropdown-label { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .produk-form-page .dropdown-label.placeholder { color: #b8aa9c; }
    .produk-form-page .dropdown-menu { position: absolute; top: calc(100% + 6px); left: 0; right: 0; background: #fff; border: 1px solid #f0e8de; border-radius: 12px; box-shadow: 0 8px 24px rgba(107,77,56,.12); padding: 6px; z-index: 50; opacity: 0; visibility: hidden; transform: translateY(-4px); transition: all .18s ease; max-height: 260px; overflow-y: auto; }
    .produk-form-page .dropdown.open .dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); }
    .produk-form-page .dropdown-item { display: flex; align-items: center; gap: 8px; padding: 10px 12px; border-radius: 8px; font-family: "Inter", sans-serif; font-size: 13px; color: #4a3d33; cursor: pointer; transition: background .15s; border: none; background: transparent; width: 100%; text-align: left; }
    .produk-form-page .dropdown-item:hover { background: #faf7f3; color: #6b4d38; }
    .produk-form-page .dropdown-item.selected { background: #f5efe8; color: #6b4d38; font-weight: 600; }
    .produk-form-page .dropdown-item .check { margin-left: auto; width: 14px; height: 14px; color: #6b4d38; opacity: 0; }
    .produk-form-page .dropdown-item.selected .check { opacity: 1; }

    .produk-form-page .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    .produk-form-page .alert-error { background: #fff1f2; border: 1px solid #fecdd3; color: #be123c; padding: 14px 16px; border-radius: 12px; margin-bottom: 20px; font-family: "Inter", sans-serif; font-size: 13px; display: flex; gap: 10px; align-items: flex-start; }
    .produk-form-page .alert-error i { width: 18px; height: 18px; flex-shrink: 0; margin-top: 1px; stroke-width: 2.2; }
    .produk-form-page .alert-error ul { margin: 0; padding-left: 16px; list-style: disc; }
    .produk-form-page .alert-error li { margin-bottom: 2px; }

    .produk-form-page .form-actions { display: flex; gap: 10px; padding-top: 20px; border-top: 1px solid #f0e8de; margin-top: 24px; }
    .produk-form-page .btn-submit { display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: #6b4d38; color: #fff; padding: 12px 26px; border-radius: 10px; font-family: "Inter", sans-serif; font-size: 13.5px; font-weight: 600; text-decoration: none; transition: background .2s; box-shadow: 0 2px 8px rgba(107,77,56,.22); border: none; cursor: pointer; white-space: nowrap; min-width: 160px; }
    .produk-form-page .btn-submit:hover { background: #4a3526; }
    .produk-form-page .btn-submit i { width: 16px; height: 16px; stroke-width: 2.5; }

    .produk-form-page .btn-cancel { display: inline-flex; align-items: center; justify-content: center; gap: 6px; background: #f5efe8; color: #6b4d38; padding: 12px 26px; border-radius: 10px; font-family: "Inter", sans-serif; font-size: 13.5px; font-weight: 500; text-decoration: none; transition: background .2s; border: none; cursor: pointer; white-space: nowrap; min-width: 120px; }
    .produk-form-page .btn-cancel:hover { background: #e8ded3; }

    /* ✅ TAMBAHAN: preview gambar */
    .produk-form-page .gambar-preview {
        margin-top: 10px;
        width: 110px;
        height: 110px;
        border-radius: 12px;
        border: 1px dashed #e8ddd2;
        background: #faf7f3;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #b8aa9c;
        font-family: "Inter", sans-serif;
        font-size: 11px;
    }
    .produk-form-page .gambar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    @media (max-width: 700px) {
        .produk-form-page .page-title { font-size: 22px; }
        .produk-form-page .form-card { padding: 20px; }
        .produk-form-page .form-row { grid-template-columns: 1fr; }
        .produk-form-page .form-actions { flex-direction: column-reverse; }
        .produk-form-page .btn-submit,
        .produk-form-page .btn-cancel { width: 100%; }
    }
</style>


<div class="produk-form-page">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb" style="max-width:720px;margin-left:auto;margin-right:auto;">
        <a href="#"><i data-lucide="house" style="width:14px;height:14px;"></i></a>
        <span class="sep">›</span>
        <a href="#">Dashboard</a>
        <span class="sep">›</span>
        <a href="{{ route('produk.index') }}">Produk</a>
        <span class="sep">›</span>
        <span class="current">Tambah</span>
    </div>

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-icon"><i data-lucide="package-plus"></i></div>
            <div>
                <h1 class="page-title">Tambah Produk</h1>
                <p class="page-subtitle">Lengkapi data produk baru yang akan dijual di toko Anda.</p>
            </div>
        </div>
        <a href="{{ route('produk.index') }}" class="btn-back">
            <i data-lucide="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="form-card">

        @if($errors->any())
            <div class="alert-error">
                <i data-lucide="alert-circle"></i>
                <div>
                    <strong style="display:block;margin-bottom:4px;">Ada {{ $errors->count() }} kesalahan:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('produk.store') }}">
            @csrf

            {{-- SECTION: Informasi Produk --}}
            <div class="form-section-title">
                <i data-lucide="info"></i>
                Informasi Produk
            </div>

            {{-- Kategori --}}
            <div class="form-group">
                <label class="form-label">Kategori <span class="req">*</span></label>
                <div class="dropdown" data-dropdown>
                    <input type="hidden" name="id_kategori" value="{{ old('id_kategori') }}" required>
                    <button type="button" class="dropdown-toggle" onclick="toggleDropdown(this)">
                        <i data-lucide="layout-grid" class="icon-lead"></i>
                        <span class="dropdown-label {{ old('id_kategori') ? '' : 'placeholder' }}">
                            @php $selectedKat = $kategoris->firstWhere('id', old('id_kategori')); @endphp
                            {{ $selectedKat->nama_kategori ?? '-- Pilih Kategori --' }}
                        </span>
                        <i data-lucide="chevron-down" class="icon-chevron"></i>
                    </button>
                    <div class="dropdown-menu">
                        @foreach($kategoris as $k)
                            <button type="button"
                                    class="dropdown-item {{ old('id_kategori') == $k->id ? 'selected' : '' }}"
                                    onclick="selectDropdown(this, '{{ $k->id }}', '{{ $k->nama_kategori }}')">
                                {{ $k->nama_kategori }}
                                <i data-lucide="check" class="check"></i>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Nama Produk --}}
            <div class="form-group">
                <label class="form-label">Nama Produk <span class="req">*</span></label>
                <div class="input-wrap">
                    <i data-lucide="tag" class="input-icon"></i>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                           placeholder="Contoh: Croissant Butter" class="form-input" required>
                </div>
            </div>

            {{-- SECTION: Harga --}}
            <div class="form-section-title" style="margin-top:8px;">
                <i data-lucide="wallet"></i>
                Harga
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Harga Beli <span class="req">*</span></label>
                    <div class="input-rp">
                        <span class="rp-prefix">Rp</span>
                        <input type="number" name="harga_beli" value="{{ old('harga_beli') }}"
                               placeholder="0" class="form-input" min="0" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga Jual <span class="req">*</span></label>
                    <div class="input-rp">
                        <span class="rp-prefix">Rp</span>
                        <input type="number" name="harga_jual" value="{{ old('harga_jual') }}"
                               placeholder="0" class="form-input" min="0" required>
                    </div>
                </div>
            </div>

            {{-- SECTION: Stok --}}
            <div class="form-section-title" style="margin-top:8px;">
                <i data-lucide="boxes"></i>
                Stok
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah Stok <span class="req">*</span></label>
                <div class="input-wrap">
                    <i data-lucide="package" class="input-icon"></i>
                    <input type="number" name="stok" value="{{ old('stok', 0) }}"
                           placeholder="0" class="form-input" min="0" required>
                </div>
            </div>

            {{-- ✅ TAMBAHAN: GAMBAR PRODUK (dropdown dari public/images) --}}
            <div class="form-group">
                <label class="form-label">Gambar Produk</label>

                @if(empty($gambarList))
                    <div class="alert-error" style="margin-bottom:10px;">
                        <i data-lucide="alert-circle"></i>
                        <div>Folder <code>public/images/</code> kosong atau belum ada gambar.</div>
                    </div>
                @endif

                <div class="input-wrap">
                    <i data-lucide="image" class="input-icon"></i>
                    <select name="gambar" id="gambarSelect"
                            class="form-input"
                            style="padding-left:40px;"
                            onchange="previewGambar(this)">
                        <option value="">-- Pilih Gambar --</option>
                        @foreach($gambarList as $gbr)
                            <option value="{{ $gbr }}" {{ old('gambar') == $gbr ? 'selected' : '' }}>
                                {{ $gbr }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="gambar-preview" id="gambarPreview">
                    <span>Preview</span>
                </div>

                <small style="color:#a89a8c; font-size:11px; margin-top:6px; display:block;">
                    Pilih gambar dari folder <code>public/images</code>.
                </small>
            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i data-lucide="save"></i>
                    Simpan Produk
                </button>
                <a href="{{ route('produk.index') }}" class="btn-cancel">Batal</a>
            </div>

        </form>

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
        document.querySelectorAll('.produk-form-page [data-dropdown].open').forEach(function(d) {
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
        labelEl.classList.remove('placeholder');
        dropdown.querySelectorAll('.dropdown-item').forEach(function(el) {
            el.classList.remove('selected');
        });
        item.classList.add('selected');
        dropdown.classList.remove('open');
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.produk-form-page [data-dropdown]')) {
            document.querySelectorAll('.produk-form-page [data-dropdown].open').forEach(function(d) {
                d.classList.remove('open');
            });
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.produk-form-page [data-dropdown].open').forEach(function(d) {
                d.classList.remove('open');
            });
        }
    });
</script>

{{-- ✅ SCRIPT: PREVIEW GAMBAR --}}
<script>
    function previewGambar(select) {
        const preview = document.getElementById('gambarPreview');
        const val = select.value;
        if (val) {
            preview.innerHTML = '<img src="/images/' + val + '" alt="Preview">';
        } else {
            preview.innerHTML = '<span>Preview</span>';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const sel = document.getElementById('gambarSelect');
        if (sel && sel.value) {
            previewGambar(sel);
        }
    });
</script>

@endsection
