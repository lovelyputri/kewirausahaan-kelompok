@extends('layout')

@section('title', 'Tambah Kerugian')

@section('content')

<style>
    .kr-form-page * { box-sizing: border-box; }

    .kr-form-page .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12px; color: #a89a8c; margin-bottom: 14px; max-width: 720px; margin-left: auto; margin-right: auto; }
    .kr-form-page .breadcrumb a { color: #a89a8c; text-decoration: none; }
    .kr-form-page .breadcrumb a:hover { color: #6b4d38; }
    .kr-form-page .breadcrumb .sep { color: #d6c9bb; }
    .kr-form-page .breadcrumb .current { color: #3f3025; font-weight: 600; }

    .kr-form-page .page-header { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; flex-wrap: wrap; max-width: 720px; margin-left: auto; margin-right: auto; }
    .kr-form-page .page-header-left { display: flex; align-items: center; gap: 14px; }
    .kr-form-page .page-icon { width: 48px; height: 48px; background: #bd4b59; color: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .kr-form-page .page-icon i { width: 24px; height: 24px; }
    .kr-form-page .page-title { font-family: "DM Serif Display", serif; font-size: 26px; font-weight: 400; color: #3f3025; margin: 0 0 2px 0; }
    .kr-form-page .page-subtitle { font-size: 12px; color: #a89a8c; margin: 0; }
    .kr-form-page .btn-back { display: inline-flex; align-items: center; gap: 6px; background: #f5efe8; color: #6b4d38; padding: 10px 18px; border-radius: 10px; font-size: 13px; font-weight: 500; text-decoration: none; }
    .kr-form-page .btn-back:hover { background: #e8ded3; }

    .kr-form-page .form-card { background: #fff; border: 1px solid #f0e8de; border-radius: 16px; padding: 28px; box-shadow: 0 1px 4px rgba(107,77,56,.04); max-width: 720px; margin: 0 auto; }

    .kr-form-page .form-section-title { display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; color: #bd4b59; text-transform: uppercase; letter-spacing: .8px; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 1px solid #f0e8de; }
    .kr-form-page .form-section-title i { width: 15px; height: 15px; }

    .kr-form-page .form-group { margin-bottom: 18px; }
    .kr-form-page .form-label { display: block; font-size: 12.5px; font-weight: 600; color: #4a3d33; margin-bottom: 7px; }
    .kr-form-page .form-label .req { color: #e11d48; }

    .kr-form-page .form-input, .kr-form-page .form-select, .kr-form-page .form-textarea { width: 100%; padding: 12px 16px; background: #faf7f3; border: 1px solid #f0e8de; border-radius: 10px; font-size: 13.5px; color: #3f3025; outline: none; transition: .2s; font-family: inherit; }
    .kr-form-page .form-input:focus, .kr-form-page .form-select:focus, .kr-form-page .form-textarea:focus { border-color: #bd4b59; background: #fff; box-shadow: 0 0 0 3px rgba(189, 75, 89, .08); }
    .kr-form-page .form-textarea { resize: vertical; min-height: 70px; }

    .kr-form-page .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    .kr-form-page .preview-box { background: #fde8eb; border: 1px solid #f5b5be; border-radius: 10px; padding: 14px 16px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
    .kr-form-page .preview-box span { color: #a44854; font-size: 12px; font-weight: 600; }
    .kr-form-page .preview-box strong { color: #bd4b59; font-size: 18px; font-weight: 700; }

    .kr-form-page .alert-error { background: #fff1f2; border: 1px solid #fecdd3; color: #be123c; padding: 14px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 13px; }
    .kr-form-page .alert-error ul { margin: 6px 0 0 16px; padding: 0; }

    .kr-form-page .form-actions { display: flex; gap: 10px; padding-top: 20px; border-top: 1px solid #f0e8de; margin-top: 24px; }
    .kr-form-page .btn-submit { display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: #bd4b59; color: #fff; padding: 12px 26px; border-radius: 10px; font-size: 13.5px; font-weight: 600; border: none; cursor: pointer; min-width: 180px; }
    .kr-form-page .btn-submit:hover { background: #a43e4a; }
    .kr-form-page .btn-cancel { display: inline-flex; align-items: center; justify-content: center; gap: 6px; background: #f5efe8; color: #6b4d38; padding: 12px 26px; border-radius: 10px; font-size: 13.5px; font-weight: 500; text-decoration: none; min-width: 120px; }
    .kr-form-page .btn-cancel:hover { background: #e8ded3; }

    @media (max-width: 700px) {
        .kr-form-page .form-row { grid-template-columns: 1fr; }
        .kr-form-page .form-actions { flex-direction: column-reverse; }
        .kr-form-page .btn-submit, .kr-form-page .btn-cancel { width: 100%; }
    }
</style>

<div class="kr-form-page">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}"><i data-lucide="house" style="width:14px;height:14px;"></i></a>
        <span class="sep">›</span>
        <a href="{{ route('produk.index') }}">Produk</a>
        <span class="sep">›</span>
        <span class="current">Tambah Kerugian</span>
    </div>

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-icon"><i data-lucide="alert-triangle"></i></div>
            <div>
                <h1 class="page-title">Tambah Kerugian</h1>
                <p class="page-subtitle">Catat produk yang rusak, kadaluarsa, atau hilang.</p>
            </div>
        </div>
        <a href="{{ route('produk.index') }}" class="btn-back">
            <i data-lucide="arrow-left"></i> Kembali
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

        <form method="POST" action="{{ route('kerugian.simpan') }}">
            @csrf

            {{-- SECTION: Pilih Produk --}}
            <div class="form-section-title">
                <i data-lucide="package"></i>
                Pilih Produk
            </div>

            <div class="form-group">
                <label class="form-label">Produk <span class="req">*</span></label>
                <select name="id_produk" id="selectProduk" class="form-select" required onchange="updatePreview()">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $p)
                        <option value="{{ $p->id }}"
                                data-harga="{{ $p->harga_beli }}"
                                data-stok="{{ $p->stok }}"
                                {{ old('id_produk') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_produk }} (Stok: {{ $p->stok }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- SECTION: Detail Kerugian --}}
            <div class="form-section-title" style="margin-top:8px;">
                <i data-lucide="info"></i>
                Detail Kerugian
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Jumlah <span class="req">*</span></label>
                    <input type="number"
                           name="jumlah"
                           id="inputJumlah"
                           class="form-input"
                           value="{{ old('jumlah', 1) }}"
                           min="1"
                           required
                           oninput="updatePreview()">
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal <span class="req">*</span></label>
                    <input type="date"
                           name="tanggal"
                           class="form-input"
                           value="{{ old('tanggal', date('Y-m-d')) }}"
                           required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Alasan <span class="req">*</span></label>
                <select name="alasan" class="form-select" required>
                    <option value="rusak" {{ old('alasan') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                    <option value="kedaluwarsa" {{ old('alasan') == 'kedaluwarsa' ? 'selected' : '' }}>Kedaluwarsa</option>
                    <option value="hilang" {{ old('alasan') == 'hilang' ? 'selected' : '' }}>Hilang</option>
                    <option value="lainnya" {{ old('alasan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Catatan</label>
                <textarea name="catatan"
                          class="form-textarea"
                          placeholder="Contoh: penyok saat pengiriman">{{ old('catatan') }}</textarea>
            </div>

            {{-- PREVIEW NILAI RUGI --}}
            <div class="preview-box">
                <span>Estimasi Nilai Rugi</span>
                <strong id="previewNilai">Rp 0</strong>
            </div>

            {{-- ACTIONS --}}
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i data-lucide="save"></i>
                    Simpan Kerugian
                </button>
                <a href="{{ route('produk.index') }}" class="btn-cancel">Batal</a>
            </div>

        </form>
    </div>
</div>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    function updatePreview() {
        const select = document.getElementById('selectProduk');
        const jumlah = parseInt(document.getElementById('inputJumlah').value) || 0;
        const selected = select.options[select.selectedIndex];
        const hargaBeli = parseFloat(selected?.dataset.harga || 0);
        const nilai = jumlah * hargaBeli;

        document.getElementById('previewNilai').textContent =
            'Rp ' + new Intl.NumberFormat('id-ID').format(nilai);
    }

    document.addEventListener('DOMContentLoaded', updatePreview);
</script>

@endsection
