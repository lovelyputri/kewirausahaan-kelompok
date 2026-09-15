@extends('layout')

@section('title', 'Dashboard')

@section('content')

<style>
    .dashboard-wrap { display: flex; flex-direction: column; gap: 18px; padding-top: 28px; width: 100%; max-width: 100%; overflow: hidden; }

    /* HEADER */
    .dash-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; margin-bottom: 0; width: 100%; position: relative; }
    .dash-welcome { min-width: 0; }
    .dash-welcome h1 { font-family: "Inter", sans-serif; font-size: 28px; font-weight: 700; color: #3f3025; margin-bottom: 6px; line-height: 1.25; }
    .dash-welcome p { font-size: 14px; color: #7a6a5a; line-height: 1.5; }

    .dash-header-right { display: flex; align-items: center; justify-content: flex-end; gap: 12px; flex-shrink: 0; position: relative; }

    .dash-date { display: flex; align-items: center; gap: 8px; background: #fff; border: 1px solid #e8ded3; border-radius: 8px; padding: 8px 14px; font-size: 13px; color: #3f3025; font-weight: 500; white-space: nowrap; font-variant-numeric: tabular-nums; }
    .dash-date-icon { width: 15px; height: 15px; flex-shrink: 0; color: #6b4d38; }
    .dash-clock-text { display: inline-block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

    .dash-icon-btn { width: 38px; height: 38px; border-radius: 50%; background: #fff; border: 1px solid #e8ded3; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #6b4d38; flex-shrink: 0; }

    /* USER + DROPDOWN */
    .dash-user-wrap { position: relative; }
    .dash-user { display: flex; align-items: center; gap: 8px; cursor: pointer; flex-shrink: 0; padding: 4px 8px 4px 4px; border-radius: 30px; transition: background .18s; }
    .dash-user:hover { background: #f5efe8; }
    .dash-user-avatar { width: 38px; height: 38px; border-radius: 50%; background: #6b4d38; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 14px; font-weight: 600; flex-shrink: 0; }
    .dash-user-info { line-height: 1.2; }
    .dash-user-info strong { display: block; font-size: 13px; color: #3f3025; font-weight: 600; }
    .dash-user-info span { display: block; font-size: 11px; color: #7a6a5a; margin-top: 2px; }
    .dash-user > i { width: 14px; height: 14px; color: #7a6a5a; transition: transform .2s; }
    .dash-user-wrap.open .dash-user > i { transform: rotate(180deg); }

    /* DROPDOWN PROFIL */
    .dash-user-dropdown { position: absolute; top: calc(100% + 10px); right: 0; width: 260px; background: #fff; border: 1px solid #e8ded3; border-radius: 14px; box-shadow: 0 12px 32px rgba(50, 35, 25, .15); z-index: 100; opacity: 0; visibility: hidden; transform: translateY(-8px); transition: all .2s ease; overflow: hidden; }
    .dash-user-wrap.open .dash-user-dropdown { opacity: 1; visibility: visible; transform: translateY(0); }

    .dropdown-head { padding: 16px; background: #faf7f3; border-bottom: 1px solid #eee5dc; display: flex; gap: 12px; align-items: center; }
    .dropdown-avatar { width: 48px; height: 48px; border-radius: 50%; background: #6b4d38; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 700; flex-shrink: 0; }
    .dropdown-info { min-width: 0; }
    .dropdown-info strong { display: block; color: #3f3025; font-size: 14px; font-weight: 700; margin-bottom: 2px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .dropdown-info span { display: block; color: #7a6a5a; font-size: 11px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

    .dropdown-body { padding: 8px; }
    .dropdown-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 9px; color: #4a3d33; font-size: 13px; font-weight: 500; text-decoration: none; cursor: pointer; transition: .15s; border: none; background: transparent; width: 100%; text-align: left; font-family: inherit; }
    .dropdown-item:hover { background: #faf7f3; color: #6b4d38; }
    .dropdown-item i { width: 16px; height: 16px; stroke-width: 1.8; color: #8e7b6a; }
    .dropdown-item.danger { color: #bd4b59; }
    .dropdown-item.danger:hover { background: #fde8eb; color: #a43e4a; }
    .dropdown-item.danger i { color: #bd4b59; }
    .dropdown-divider { height: 1px; background: #eee5dc; margin: 6px 4px; }

    /* HERO */
    .dash-hero { position: relative; width: 100%; height: 100px; margin: 0; display: flex; justify-content: flex-end; align-items: flex-end; overflow: hidden; }
    .dash-hero img { height: 115px; width: auto; max-width: 100%; object-fit: contain; position: absolute; right: 0; bottom: 0; }

    /* STAT CARDS */
    .stat-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px; width: 100%; }
    .stat-card { background: #fff; border: 1px solid #f0e8dd; border-radius: 12px; padding: 18px 20px; display: flex; flex-direction: column; justify-content: space-between; min-height: 130px; min-width: 0; transition: 0.2s ease; }
    .stat-card:hover { box-shadow: 0 4px 14px rgba(107, 77, 56, 0.08); }
    .stat-top { display: flex; align-items: center; gap: 14px; min-width: 0; }
    .stat-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .stat-icon i { width: 22px; height: 22px; }
    .stat-icon.brown { background: #efe3d5; color: #6b4d38; }
    .stat-icon.yellow { background: #fdf1cf; color: #c9a227; }
    .stat-icon.green { background: #ddf3dd; color: #4caf50; }
    .stat-icon.red { background: #fbe0e0; color: #e05252; }
    .stat-info { min-width: 0; }
    .stat-info h4 { font-size: 13px; font-weight: 600; color: #3f3025; margin-bottom: 4px; }
    .stat-info .stat-value { font-size: 26px; font-weight: 700; color: #3f3025; line-height: 1.1; margin-bottom: 4px; word-break: break-word; }
    .stat-info .stat-desc { font-size: 11px; color: #8a7a6a; }
    .stat-link { display: flex; justify-content: space-between; align-items: center; font-size: 12px; font-weight: 600; color: #3f3025; text-decoration: none; margin-top: 14px; padding-top: 10px; border-top: 1px solid #f5efe6; }
    .stat-link:hover { color: #6b4d38; }
    .stat-link i { width: 16px; height: 16px; color: #3f3025; flex-shrink: 0; }

    /* MIDDLE GRID */
    .mid-grid { display: grid; grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr); gap: 12px; width: 100%; }
    .panel { background: #fff; border: 1px solid #f0e8dd; border-radius: 12px; padding: 20px 22px; min-width: 0; overflow: hidden; }
    .panel-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 15px; margin-bottom: 18px; min-width: 0; }
    .panel-title { display: flex; align-items: center; gap: 12px; min-width: 0; }
    .panel-icon { width: 38px; height: 38px; border-radius: 8px; background: #f7f1e8; display: flex; align-items: center; justify-content: center; color: #6b4d38; flex-shrink: 0; }
    .panel-icon i { width: 18px; height: 18px; }
    .panel-title h3 { font-size: 14px; font-weight: 700; color: #3f3025; margin-bottom: 2px; }
    .panel-title span { font-size: 11px; color: #8a7a6a; }
    .panel-total { text-align: right; flex-shrink: 0; }
    .panel-total span { display: block; font-size: 11px; color: #8a7a6a; margin-bottom: 2px; }
    .panel-total strong { font-size: 14px; font-weight: 700; color: #3f3025; white-space: nowrap; }

    /* LINE CHART */
    .chart-line-wrap { position: relative; height: 200px; width: 100%; overflow: hidden; }
    .chart-line-wrap svg { width: calc(100% - 50px); height: 100%; margin-left: 50px; overflow: visible; display: block; }
    .chart-y-labels { position: absolute; left: 0; top: 0; width: 45px; height: 100%; display: flex; flex-direction: column; justify-content: space-between; font-size: 10px; color: #8a7a6a; padding: 6px 0; }
    .chart-x-labels { display: flex; justify-content: space-between; font-size: 10px; color: #8a7a6a; padding-left: 50px; padding-right: 5px; margin-top: 8px; gap: 5px; }
    .chart-x-labels span { white-space: nowrap; }

    /* DOUGHNUT */
    .doughnut-wrap { display: flex; align-items: center; gap: 20px; min-width: 0; }
    .doughnut-svg { position: relative; width: 170px; height: 170px; flex-shrink: 0; }
    .doughnut-svg svg { width: 100%; height: 100%; transform: rotate(-90deg); }
    .doughnut-center { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 10px; }
    .doughnut-center span { font-size: 10px; color: #8a7a6a; margin-bottom: 2px; }
    .doughnut-center strong { font-size: 12px; font-weight: 700; color: #3f3025; line-height: 1.3; }
    .doughnut-legend { display: flex; flex-direction: column; gap: 14px; flex: 1; min-width: 0; }
    .legend-item { display: flex; align-items: flex-start; gap: 10px; min-width: 0; }
    .legend-dot { width: 12px; height: 12px; border-radius: 50%; flex-shrink: 0; margin-top: 3px; }
    .legend-item-info { line-height: 1.3; min-width: 0; }
    .legend-item-info strong { display: block; font-size: 12px; font-weight: 600; color: #3f3025; margin-bottom: 2px; }
    .legend-item-info span { display: block; font-size: 11px; color: #8a7a6a; word-break: break-word; }

    /* BOTTOM GRID */
    .bottom-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px; width: 100%; }
    .list-item { display: flex; align-items: center; gap: 12px; padding: 10px 0; min-width: 0; }
    .list-item:not(:last-child) { border-bottom: 1px solid #f5efe6; }
    .list-thumb { width: 36px; height: 36px; border-radius: 8px; background: #f7f1e8; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 18px; overflow: hidden; }
    .list-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .list-info { flex: 1; min-width: 0; }
    .list-info strong { display: block; font-size: 12px; font-weight: 600; color: #3f3025; margin-bottom: 2px; line-height: 1.4; word-break: break-word; }
    .list-info span { display: block; font-size: 10px; color: #8a7a6a; line-height: 1.4; }
    .progress-track { width: 100%; height: 6px; background: #f0e8dd; border-radius: 99px; overflow: hidden; margin-top: 6px; }
    .progress-fill { height: 100%; background: #6b4d38; border-radius: 99px; }
    .qty-label { font-size: 10px; color: #8a7a6a; margin-left: 6px; flex-shrink: 0; white-space: nowrap; }
    .badge-stock { font-size: 10px; font-weight: 600; padding: 4px 10px; border-radius: 99px; background: #6b4d38; color: #fff; flex-shrink: 0; white-space: nowrap; }
    .empty-list { padding: 20px 0; text-align: center; color: #a89a8c; font-size: 11px; }

    @media (max-width: 1200px) {
        .stat-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .mid-grid { grid-template-columns: 1fr; }
        .bottom-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 900px) {
        .dashboard-wrap { gap: 14px; padding-top: 20px; }
        .dash-welcome h1 { font-size: 24px; }
        .dash-welcome p { font-size: 13px; }
        .dash-user-info { display: none; }
        .stat-info .stat-value { font-size: 22px; }
        .doughnut-wrap { gap: 16px; }
        .doughnut-svg { width: 150px; height: 150px; }
    }
    @media (max-width: 700px) {
        .dashboard-wrap { gap: 12px; padding-top: 6px; }
        .dash-header { flex-direction: column; gap: 12px; }
        .dash-welcome h1 { font-size: 21px; }
        .dash-welcome p { font-size: 12px; }
        .dash-header-right { width: 100%; display: flex; flex-wrap: nowrap; align-items: center; justify-content: flex-start; gap: 7px; }
        .dash-date { flex: 1; min-width: 0; font-size: 11px; padding: 7px 9px; }
        .dash-icon-btn { width: 34px; height: 34px; }
        .dash-user-avatar { width: 34px; height: 34px; font-size: 12px; }
        .dash-user-info { display: none; }
        .dash-user > i { display: none; }
        .dash-hero { height: 75px; }
        .dash-hero img { height: 85px; max-width: 85%; }
        .stat-grid { grid-template-columns: 1fr; gap: 10px; }
        .stat-card { min-height: 120px; padding: 16px 18px; }
        .mid-grid { grid-template-columns: 1fr; gap: 10px; }
        .panel { padding: 16px 17px; }
        .bottom-grid { grid-template-columns: 1fr; gap: 10px; }
        .doughnut-wrap { flex-direction: column; align-items: center; gap: 18px; }
        .doughnut-legend { width: 100%; }
    }
</style>


<div class="dashboard-wrap">

    {{-- HEADER --}}
    <div class="dash-header">

        <div class="dash-welcome">
            <h1>Selamat Datang, {{ Auth::user()->name ?? 'Admin' }} 👋</h1>
            <p>Kelola stok roti dan pantau keuntungan toko dengan mudah</p>
        </div>

        <div class="dash-header-right">

            {{-- Jam Real-time --}}
            <div class="dash-date">
                <i data-lucide="clock" class="dash-date-icon"></i>
                <span id="realtime-clock" class="dash-clock-text">Memuat...</span>
            </div>

            {{-- Notification --}}
            <div class="dash-icon-btn">
                <i data-lucide="bell" style="width:17px;height:17px;"></i>
            </div>

            {{-- USER + DROPDOWN --}}
            <div class="dash-user-wrap" id="userWrap">

                <div class="dash-user" onclick="toggleUserDropdown(event)">
                    <div class="dash-user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
                    </div>
                    <div class="dash-user-info">
                        <strong>{{ Auth::user()->name ?? 'Penjual' }}</strong>
                        <span>Pemilik Toko</span>
                    </div>
                    <i data-lucide="chevron-down"></i>
                </div>

                {{-- Dropdown --}}
                <div class="dash-user-dropdown">

                    <div class="dropdown-head">
                        <div class="dropdown-avatar">
                            {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
                        </div>
                        <div class="dropdown-info">
                            <strong>{{ Auth::user()->name ?? 'Penjual' }}</strong>
                            <span>{{ Auth::user()->email ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="dropdown-body">
                        <a href="javascript:void(0)"
                           onclick="alert('Halaman profil belum tersedia')"
                           class="dropdown-item">
                            <i data-lucide="user"></i>
                            Profil Saya
                        </a>

                        <a href="javascript:void(0)"
                           onclick="alert('Halaman pengaturan belum tersedia')"
                           class="dropdown-item">
                            <i data-lucide="settings"></i>
                            Pengaturan
                        </a>

                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <i data-lucide="log-out"></i>
                                Logout
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>

    {{-- HERO --}}
    <div class="dash-hero">
        <img src="{{ asset('images/hero-bakery.png') }}" alt="Bakery Illustration">
    </div>

    {{-- STAT CARDS --}}
    <div class="stat-grid">

        {{-- Total Produk --}}
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon brown"><i data-lucide="box"></i></div>
                <div class="stat-info">
                    <h4>Total Produk</h4>
                    <div class="stat-value">{{ $totalProduk }}</div>
                    <div class="stat-desc">Jenis produk tersedia</div>
                </div>
            </div>
            <a href="{{ route('produk.index') }}" class="stat-link">
                Lihat produk <i data-lucide="arrow-right"></i>
            </a>
        </div>

        {{-- Total Stok --}}
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon yellow"><i data-lucide="package"></i></div>
                <div class="stat-info">
                    <h4>Total Stok</h4>
                    <div class="stat-value">{{ $totalStok }}</div>
                    <div class="stat-desc">Pcs tersedia</div>
                </div>
            </div>
            <a href="{{ route('produk.index') }}" class="stat-link">
                Lihat stok <i data-lucide="arrow-right"></i>
            </a>
        </div>

        {{-- Penjualan Hari Ini --}}
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon green"><i data-lucide="shopping-cart"></i></div>
                <div class="stat-info">
                    <h4>Penjualan Hari Ini</h4>
                    <div class="stat-value">{{ $totalItemHariIni }}</div>
                    <div class="stat-desc">Produk terjual</div>
                </div>
            </div>
            <a href="{{ route('penjualan.index') }}" class="stat-link">
                Lihat penjualan <i data-lucide="arrow-right"></i>
            </a>
        </div>

        {{-- Laba Hari Ini --}}
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon red"><i data-lucide="dollar-sign"></i></div>
                <div class="stat-info">
                    <h4>Laba Hari Ini</h4>
                    <div class="stat-value">Rp {{ number_format($labaHariIni, 0, ',', '.') }}</div>
                    <div class="stat-desc">Laba bersih</div>
                </div>
            </div>
            <a href="{{ route('laporan_laba.index') }}" class="stat-link">
                Lihat laporan laba <i data-lucide="arrow-right"></i>
            </a>
        </div>

    </div>

    {{-- MIDDLE --}}
    <div class="mid-grid">

        {{-- RINGKASAN PENJUALAN --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <div class="panel-icon"><i data-lucide="line-chart"></i></div>
                    <div>
                        <h3>Ringkasan Penjualan</h3>
                        <span>6 hari terakhir</span>
                    </div>
                </div>
                <div class="panel-total">
                    <span>Total</span>
                    <strong>Rp {{ number_format($totalChart, 0, ',', '.') }}</strong>
                </div>
            </div>

            <div class="chart-line-wrap">

                {{-- Y Labels --}}
                <div class="chart-y-labels">
                    <span>{{ $maxChart > 0 ? number_format($maxChart / 1000, 0) . ' rb' : '0' }}</span>
                    <span>{{ $maxChart > 0 ? number_format(($maxChart * 0.8) / 1000, 0) . ' rb' : '0' }}</span>
                    <span>{{ $maxChart > 0 ? number_format(($maxChart * 0.6) / 1000, 0) . ' rb' : '0' }}</span>
                    <span>{{ $maxChart > 0 ? number_format(($maxChart * 0.4) / 1000, 0) . ' rb' : '0' }}</span>
                    <span>{{ $maxChart > 0 ? number_format(($maxChart * 0.2) / 1000, 0) . ' rb' : '0' }}</span>
                    <span>0</span>
                </div>

                @php
                    // Hitung titik chart (viewBox 600x200)
                    $points = [];
                    $count = count($chartData);
                    $stepX = $count > 1 ? 600 / ($count - 1) : 0;

                    foreach ($chartData as $i => $value) {
                        $x = $i * $stepX;
                        $y = $maxChart > 0 ? 200 - (($value / $maxChart) * 180) : 180;
                        $points[] = round($x, 1) . ',' . round($y, 1);
                    }
                @endphp

                <svg viewBox="0 0 600 200" preserveAspectRatio="none">
                    <g stroke="#f0e8dd" stroke-width="1">
                        <line x1="0" y1="0" x2="600" y2="0" />
                        <line x1="0" y1="40" x2="600" y2="40" />
                        <line x1="0" y1="80" x2="600" y2="80" />
                        <line x1="0" y1="120" x2="600" y2="120" />
                        <line x1="0" y1="160" x2="600" y2="160" />
                        <line x1="0" y1="200" x2="600" y2="200" />
                    </g>

                    <polyline
                        points="{{ implode(' ', $points) }}"
                        fill="none"
                        stroke="#6b4d38"
                        stroke-width="2.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                    <g fill="#6b4d38">
                        @foreach($points as $point)
                            @php [$cx, $cy] = explode(',', $point); @endphp
                            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="4" />
                        @endforeach
                    </g>
                </svg>
            </div>

            <div class="chart-x-labels">
                @foreach($chartLabels as $label)
                    <span>{{ $label }}</span>
                @endforeach
            </div>
        </div>

        {{-- LABA BERSIH (DOUGHNUT) --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <div class="panel-icon"><i data-lucide="pie-chart"></i></div>
                    <div>
                        <h3>Laba Bersih</h3>
                        <span>6 hari terakhir</span>
                    </div>
                </div>
            </div>

            <div class="doughnut-wrap">

                @php
                    // Hitung proporsi doughnut
                    $total = $totalPenjualan6Hari ?: 1;
                    $persenPenjualan = $totalPenjualan6Hari / $total;
                    $persenModal = $totalModal6Hari / $total;
                    $persenLaba = max($labaBersih6Hari, 0) / $total;

                    // Keliling circle r=38 → 2πr = 238.76
                    $circ = 238.76;

                    $dashPenjualan = $persenPenjualan * $circ;
                    $dashModal = $persenModal * $circ;
                    $dashLaba = $persenLaba * $circ;
                @endphp

                <div class="doughnut-svg">
                    <svg viewBox="0 0 100 100">
                        {{-- Background --}}
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#f0e8dd" stroke-width="18" />

                        {{-- Penjualan --}}
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#6b4d38" stroke-width="18"
                                stroke-dasharray="{{ $dashPenjualan }} {{ $circ }}"
                                stroke-dashoffset="0" />

                        {{-- Modal --}}
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#a88a6d" stroke-width="18"
                                stroke-dasharray="{{ $dashModal }} {{ $circ }}"
                                stroke-dashoffset="-{{ $dashPenjualan }}" />

                        {{-- Laba --}}
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#e8ded3" stroke-width="18"
                                stroke-dasharray="{{ $dashLaba }} {{ $circ }}"
                                stroke-dashoffset="-{{ $dashPenjualan + $dashModal }}" />
                    </svg>

                    <div class="doughnut-center">
                        <span>Total Laba</span>
                        <strong>Rp {{ number_format($labaBersih6Hari, 0, ',', '.') }}</strong>
                    </div>
                </div>

                <div class="doughnut-legend">
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#6b4d38;"></div>
                        <div class="legend-item-info">
                            <strong>Penjualan</strong>
                            <span>Rp {{ number_format($totalPenjualan6Hari, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#a88a6d;"></div>
                        <div class="legend-item-info">
                            <strong>Modal</strong>
                            <span>Rp {{ number_format($totalModal6Hari, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#e8ded3;"></div>
                        <div class="legend-item-info">
                            <strong>Laba Bersih</strong>
                            <span>Rp {{ number_format($labaBersih6Hari, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- BOTTOM --}}
    <div class="bottom-grid">

        {{-- KATEGORI TERLARIS --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <div class="panel-icon"><i data-lucide="bar-chart-3"></i></div>
                    <div>
                        <h3>Kategori Terlaris</h3>
                        <span>Berdasarkan jumlah terjual</span>
                    </div>
                </div>
            </div>

            @forelse($kategoriTerlaris as $kategori)
                @php $persen = $maxTerjual > 0 ? round(($kategori->total_terjual / $maxTerjual) * 100) : 0; @endphp
                <div class="list-item">
                    <div class="list-thumb">
                        @if($kategori->gambar_sample)
                            <img src="{{ asset('images/' . $kategori->gambar_sample) }}" alt="{{ $kategori->nama_kategori }}">
                        @else
                            <i data-lucide="package" style="width:16px;height:16px;color:#6b4d38;"></i>
                        @endif
                    </div>
                    <div class="list-info">
                        <strong>{{ $kategori->nama_kategori }}</strong>
                        <div class="progress-track">
                            <div class="progress-fill" style="width:{{ $persen }}%;"></div>
                        </div>
                    </div>
                    <span class="qty-label">{{ $kategori->total_terjual }} pcs</span>
                </div>
            @empty
                <div class="empty-list">Belum ada data penjualan</div>
            @endforelse
        </div>

        {{-- STOK MENIPIS --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <div class="panel-icon"><i data-lucide="alert-triangle"></i></div>
                    <div>
                        <h3>Stok Menipis</h3>
                        <span>Produk dengan stok rendah</span>
                    </div>
                </div>
            </div>

            @forelse($stokMenipisList as $produk)
                <div class="list-item">
                    <div class="list-thumb">
                        @if($produk->gambar)
                            <img src="{{ asset('images/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                        @else
                            <i data-lucide="package" style="width:16px;height:16px;color:#6b4d38;"></i>
                        @endif
                    </div>
                    <div class="list-info">
                        <strong>{{ $produk->nama_produk }}</strong>
                        <span>{{ $produk->kategori->nama_kategori ?? '-' }}</span>
                    </div>
                    <span class="badge-stock">Stok: {{ $produk->stok }} Pcs</span>
                </div>
            @empty
                <div class="empty-list">Semua stok aman 👍</div>
            @endforelse
        </div>

        {{-- AKTIVITAS TERBARU --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <div class="panel-icon"><i data-lucide="clock"></i></div>
                    <div>
                        <h3>Aktivitas Terbaru</h3>
                        <span>Transaksi terbaru yang terjadi</span>
                    </div>
                </div>
            </div>

            @forelse($aktivitasTerbaru as $aktivitas)
                <div class="list-item">
                    <div class="list-thumb">
                        <i data-lucide="shopping-cart" style="width:16px;height:16px;color:#6b4d38;"></i>
                    </div>
                    <div class="list-info">
                        <strong>
                            Penjualan {{ $aktivitas->jumlah }} pcs
                            {{ $aktivitas->produk->nama_produk ?? '-' }}
                        </strong>
                        <span>
                            {{ $aktivitas->penjualan->tanggal->format('d M Y') ?? '-' }},
                            {{ $aktivitas->created_at->format('H:i') }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="empty-list">Belum ada aktivitas</div>
            @endforelse
        </div>

    </div>
</div>

{{-- LUCIDE --}}
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

{{-- JAM REAL-TIME --}}
<script>
    function updateClock() {
        const now = new Date();
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        const date = now.getDate();
        const month = months[now.getMonth()];
        const year = now.getFullYear();
        const hh = String(now.getHours()).padStart(2, '0');
        const mm = String(now.getMinutes()).padStart(2, '0');
        const clockElement = document.getElementById('realtime-clock');
        if (clockElement) {
            clockElement.textContent = `${date} ${month} ${year} • ${hh}:${mm}`;
        }
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>

{{-- DROPDOWN USER --}}
<script>
    function toggleUserDropdown(event) {
        event.stopPropagation();
        const wrap = document.getElementById('userWrap');
        wrap.classList.toggle('open');
    }

    // Klik di luar → tutup dropdown
    document.addEventListener('click', function (event) {
        const wrap = document.getElementById('userWrap');
        if (wrap && !wrap.contains(event.target)) {
            wrap.classList.remove('open');
        }
    });

    // ESC → tutup
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const wrap = document.getElementById('userWrap');
            if (wrap) wrap.classList.remove('open');
        }
    });
</script>

@endsection
