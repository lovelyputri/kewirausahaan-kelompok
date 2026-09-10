@extends('layout')

@section('title', 'Riwayat Transaksi')

@section('content')

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Transaksi</h1>
            <p class="text-sm text-gray-500">Daftar riwayat pembelian yang sudah selesai</p>
        </div>
    </div>

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTER --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('penjualan.index') }}" class="flex flex-wrap gap-3">

            {{-- Search --}}
            <input type="text"
                   name="keyword"
                   value="{{ request('keyword') }}"
                   placeholder="Cari nama produk / kode barang..."
                   class="flex-1 min-w-[200px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">

            {{-- ✅ Date Range Picker (1 input) --}}
            <input type="text"
                   id="date-range"
                   placeholder="Pilih rentang tanggal..."
                   value="{{ request('start_date') && request('end_date') ? request('start_date') . ' to ' . request('end_date') : '' }}"
                   class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white cursor-pointer"
                   readonly>

            {{-- Hidden input untuk kirim ke controller --}}
            <input type="hidden" name="start_date" id="start_date" value="{{ request('start_date') }}">
            <input type="hidden" name="end_date" id="end_date" value="{{ request('end_date') }}">

            {{-- Dropdown Status --}}
            <select name="status"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                <option value="">Semua Status</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
            </select>

            {{-- Tombol --}}
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg text-sm">
                Cari
            </button>

            <a href="{{ route('penjualan.index') }}"
               class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg text-sm">
                Reset
            </a>

        </form>
    </div>

    {{-- LAYOUT: TABEL + PANEL DETAIL --}}
    <div class="flex gap-4">

        {{-- TABEL RIWAYAT TRANSAKSI --}}
        <div id="tabel-penjualan" class="flex-1 bg-white rounded-lg shadow overflow-hidden transition-all duration-300">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Barang</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($penjualans as $index => $p)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $p->tanggal->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm font-mono text-gray-700">
                                {{ $p->kode_barang ?: '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $p->total_item }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                Rp {{ number_format($p->total_pemasukan, 0, ',', '.') }}
                            </td>
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

                                    {{-- DELETE --}}
                                    <form method="POST"
                                          action="{{ route('penjualan.destroy', $p->id) }}"
                                          onsubmit="return confirm('Yakin hapus transaksi ini?')">
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
                                Belum ada riwayat transaksi.
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
                <h3 class="font-bold text-gray-800">Detail Transaksi</h3>
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

    {{-- ============================ --}}
    {{-- SCRIPT: Flatpickr Date Range --}}
    {{-- ============================ --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
        });
    </script>

    {{-- ============================ --}}
    {{-- SCRIPT: Panel Slide-In --}}
    {{-- ============================ --}}
    <script>
        function showDetail(id) {
            const panel = document.getElementById('panel-detail');
            const content = document.getElementById('panel-content');

            panel.classList.remove('hidden');
            content.innerHTML = '<p class="text-sm text-gray-500">Memuat...</p>';

            fetch(`/penjualan/${id}`, {
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
                        <tr class="border-b">
                            <td class="py-1 text-xs text-gray-500">${i + 1}</td>
                            <td class="py-1 text-xs text-gray-800">${d.nama_produk}</td>
                            <td class="py-1 text-xs text-right text-gray-600">Rp ${formatRupiah(d.harga_jual)}</td>
                            <td class="py-1 text-xs text-center text-gray-600">${d.jumlah}</td>
                            <td class="py-1 text-xs text-right text-gray-800">Rp ${formatRupiah(d.subtotal)}</td>
                        </tr>
                    `;
                });

                content.innerHTML = `
                    <div class="text-xs text-gray-500 mb-3">
                        <div class="font-semibold text-gray-800">Congek Bakes</div>
                        <div>${data.tanggal}</div>
                    </div>

                    <div class="space-y-1 text-xs mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-500">No. Struk</span>
                            <span class="font-mono text-gray-800">${data.no_struk}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Total Item</span>
                            <span class="text-gray-800">${data.total_item}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Status</span>
                            <span class="px-2 py-0.5 rounded ${data.warna_status}">${data.label_status}</span>
                        </div>
                    </div>

                    <div class="border-t pt-2">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left text-xs text-gray-500 pb-1">No</th>
                                    <th class="text-left text-xs text-gray-500 pb-1">Produk</th>
                                    <th class="text-right text-xs text-gray-500 pb-1">Harga</th>
                                    <th class="text-center text-xs text-gray-500 pb-1">Jml</th>
                                    <th class="text-right text-xs text-gray-500 pb-1">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${detailRows}
                            </tbody>
                        </table>
                    </div>

                    <div class="border-t mt-3 pt-3 space-y-1 text-xs">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Total Produk</span>
                            <span class="text-gray-800">${data.total_item}</span>
                        </div>
                        <div class="flex justify-between font-semibold">
                            <span class="text-gray-700">Total Harga</span>
                            <span class="text-gray-800">Rp ${formatRupiah(data.total_pemasukan)}</span>
                        </div>
                    </div>

                    <div class="bg-green-100 text-green-700 rounded p-2 mt-4 text-xs text-center">
                        Terima kasih telah berbelanja! 🙏
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
