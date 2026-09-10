@extends('layout')

@section('title', 'Data Produk')

@section('content')

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Produk</h1>
            <p class="text-sm text-gray-500">Kelola produk toko dengan mudah</p>
        </div>
        <a href="{{ route('produk.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
            + Tambah Produk
        </a>
    </div>

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- STATISTIK 4 KOTAK --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500">Total Produk</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalProduk }}</p>
            <p class="text-xs text-gray-400">Jenis produk terdaftar</p>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500">Total Stok</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalStok }}</p>
            <p class="text-xs text-gray-400">Total seluruh stok</p>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500">Produk Menipis</p>
            <p class="text-2xl font-bold text-yellow-500">{{ $stokMenipis }}</p>
            <p class="text-xs text-gray-400">Produk yang menipis</p>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-xs text-gray-500">Stok Habis</p>
            <p class="text-2xl font-bold text-red-500">{{ $stokHabis }}</p>
            <p class="text-xs text-gray-400">Produk habis</p>
        </div>

    </div>

    {{-- FILTER --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('produk.index') }}" class="flex flex-wrap gap-3">

            {{-- Search --}}
            <input type="text"
                   name="keyword"
                   value="{{ request('keyword') }}"
                   placeholder="Cari nama produk..."
                   class="flex-1 min-w-[200px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">

            {{-- Dropdown Kategori (isi dari seeder) --}}
            <select name="id_kategori"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}" {{ request('id_kategori') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>

            {{-- Dropdown Status --}}
            <select name="status"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="menipis" {{ request('status') == 'menipis' ? 'selected' : '' }}>Stok Menipis</option>
                <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Stok Habis</option>
            </select>

            {{-- Tombol --}}
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg text-sm">
                Cari
            </button>

            <a href="{{ route('produk.index') }}"
               class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg text-sm">
                Reset
            </a>

        </form>
    </div>

    {{-- LAYOUT: TABEL + PANEL DETAIL --}}
    <div class="flex gap-4">

        {{-- TABEL PRODUK --}}
        <div id="tabel-produk" class="flex-1 bg-white rounded-lg shadow overflow-hidden transition-all duration-300">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Jual</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($produks as $index => $p)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $p->nama_produk }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $p->kategori->nama_kategori ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                Rp {{ number_format($p->harga_jual, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $p->stok }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded text-xs {{ $p->warna_status }}">
                                    {{ $p->label_status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex gap-1">

                                    {{-- SHOW (buka panel detail) --}}
                                    <button type="button"
                                            onclick="showDetail({{ $p->id }})"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs">
                                        👁
                                    </button>

                                    {{-- EDIT --}}
                                    <a href="{{ route('produk.edit', $p->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">
                                        ✏️
                                    </a>

                                    {{-- DELETE --}}
                                    <form method="POST"
                                          action="{{ route('produk.destroy', $p->id) }}"
                                          onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">
                                            🗑
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                Belum ada data produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PANEL DETAIL (muncul saat klik show) --}}
        <div id="panel-detail"
             class="hidden w-96 bg-white rounded-lg shadow p-4 transition-all duration-300">

            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-800">Detail Produk</h3>
                <button onclick="closeDetail()"
                        class="text-gray-400 hover:text-gray-600 text-xl leading-none">
                    &times;
                </button>
            </div>

            <div id="panel-content">
                <p class="text-sm text-gray-500">Memuat...</p>
            </div>

        </div>

    </div>

    {{-- SCRIPT: Panel Slide-In --}}
    <script>
        function showDetail(id) {
            const panel = document.getElementById('panel-detail');
            const content = document.getElementById('panel-content');

            panel.classList.remove('hidden');
            content.innerHTML = '<p class="text-sm text-gray-500">Memuat...</p>';

            fetch(`/produk/${id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                content.innerHTML = `
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-500 text-xs">Nama Produk</p>
                            <p class="font-medium text-gray-800">${data.nama_produk}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Kategori</p>
                            <p class="text-gray-800">${data.kategori}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Harga Beli</p>
                            <p class="text-gray-800">Rp ${formatRupiah(data.harga_beli)}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Harga Jual</p>
                            <p class="text-gray-800">Rp ${formatRupiah(data.harga_jual)}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Laba per Unit</p>
                            <p class="text-green-600 font-medium">Rp ${formatRupiah(data.laba)}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Stok</p>
                            <p class="text-gray-800">${data.stok}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs">Status</p>
                            <span class="px-2 py-1 rounded text-xs ${data.warna_status}">
                                ${data.label_status}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t">
                        <p class="text-xs text-gray-500 mb-2">Riwayat Transaksi</p>
                        <p class="text-xs text-gray-400">Belum ada transaksi</p>
                    </div>
                `;
            })
            .catch(err => {
                content.innerHTML = '<p class="text-sm text-red-500">Gagal memuat data.</p>';
            });
        }

        function closeDetail() {
            document.getElementById('panel-detail').classList.add('hidden');
        }

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }
    </script>

@endsection
