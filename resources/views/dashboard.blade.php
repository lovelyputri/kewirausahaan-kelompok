@extends('layout')

@section('title', 'Dashboard')

@section('content')

<style>
    /* =====================================================
    DASHBOARD STYLES
    ===================================================== */

    .dashboard-wrap {
        display: flex;
        flex-direction: column;
        gap: 18px;
        padding-top: 20px;
    }

    /* ---------- HEADER ---------- */

    .dash-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 4px;
    }

    .dash-welcome h1 {
        font-family: "Inter", sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #3f3025;
        margin-bottom: 6px;
    }

    .dash-welcome p {
        font-size: 14px;
        color: #7a6a5a;
        line-height: 1.5;
    }

    .dash-header-right {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }

    /* ---------- JAM REAL-TIME ---------- */

    .dash-date {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        border: 1px solid #e8ded3;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 13px;
        color: #3f3025;
        font-weight: 500;
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
        min-width: 0;
        max-width: 100%;
        overflow: hidden;
    }

    .dash-date-icon {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        color: #6b4d38;
    }

    .dash-clock-text {
        display: inline-block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* ---------- ICON BUTTON & USER ---------- */

    .dash-icon-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #fff;
        border: 1px solid #e8ded3;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #6b4d38;
    }

    .dash-user {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .dash-user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #6b4d38;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
    }

    .dash-user-info {
        line-height: 1.2;
    }

    .dash-user-info strong {
        display: block;
        font-size: 13px;
        color: #3f3025;
        font-weight: 600;
    }

    .dash-user-info span {
        display: block;
        font-size: 11px;
        color: #7a6a5a;
    }

    /* ---------- HERO ILLUSTRATION ---------- */

    .dash-hero {
        position: relative;
        height: 100px;
        margin-bottom: 0;
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        overflow: hidden;
    }

    .dash-hero img {
        height: 115px;
        width: auto;
        object-fit: contain;
        position: absolute;
        right: 0;
        bottom: 0;
    }

    /* ---------- STAT CARDS ---------- */

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #f0e8dd;
        border-radius: 12px;
        padding: 18px 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 130px;
        transition: 0.2s ease;
    }

    .stat-card:hover {
        box-shadow: 0 4px 14px rgba(107, 77, 56, 0.08);
    }

    .stat-top {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon i {
        width: 22px;
        height: 22px;
    }

    .stat-icon.brown  { background: #efe3d5; color: #6b4d38; }
    .stat-icon.yellow { background: #fdf1cf; color: #c9a227; }
    .stat-icon.green  { background: #ddf3dd; color: #4caf50; }
    .stat-icon.red    { background: #fbe0e0; color: #e05252; }

    .stat-info h4 {
        font-size: 13px;
        font-weight: 600;
        color: #3f3025;
        margin-bottom: 4px;
    }

    .stat-info .stat-value {
        font-size: 26px;
        font-weight: 700;
        color: #3f3025;
        line-height: 1.1;
        margin-bottom: 4px;
    }

    .stat-info .stat-desc {
        font-size: 11px;
        color: #8a7a6a;
    }

    .stat-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        font-weight: 600;
        color: #3f3025;
        text-decoration: none;
        margin-top: 14px;
        padding-top: 10px;
        border-top: 1px solid #f5efe6;
    }

    .stat-link i {
        width: 16px;
        height: 16px;
        color: #3f3025;
    }

    /* ---------- MIDDLE ROW ---------- */

    .mid-grid {
        display: grid;
        grid-template-columns: 1.4fr 1fr;
        gap: 12px;
    }

    .panel {
        background: #fff;
        border: 1px solid #f0e8dd;
        border-radius: 12px;
        padding: 20px 22px;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 18px;
    }

    .panel-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .panel-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: #f7f1e8;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b4d38;
    }

    .panel-icon i {
        width: 18px;
        height: 18px;
    }

    .panel-title h3 {
        font-size: 14px;
        font-weight: 700;
        color: #3f3025;
        margin-bottom: 2px;
    }

    .panel-title span {
        font-size: 11px;
        color: #8a7a6a;
    }

    .panel-total {
        text-align: right;
    }

    .panel-total span {
        display: block;
        font-size: 11px;
        color: #8a7a6a;
        margin-bottom: 2px;
    }

    .panel-total strong {
        font-size: 14px;
        font-weight: 700;
        color: #3f3025;
    }

    /* ---------- CHART (SVG LINE) ---------- */

    .chart-line-wrap {
        position: relative;
        height: 200px;
        width: 100%;
    }

    .chart-line-wrap svg {
        width: 100%;
        height: 100%;
        overflow: visible;
    }

    .chart-y-labels {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        font-size: 10px;
        color: #8a7a6a;
        padding: 6px 0;
    }

    .chart-x-labels {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        color: #8a7a6a;
        padding: 0 6px;
        margin-top: 8px;
    }

    /* ---------- DOUGHNUT CHART ---------- */

    .doughnut-wrap {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .doughnut-svg {
        position: relative;
        width: 170px;
        height: 170px;
        flex-shrink: 0;
    }

    .doughnut-svg svg {
        width: 100%;
        height: 100%;
        transform: rotate(-90deg);
    }

    .doughnut-center {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .doughnut-center span {
        font-size: 10px;
        color: #8a7a6a;
        margin-bottom: 2px;
    }

    .doughnut-center strong {
        font-size: 12px;
        font-weight: 700;
        color: #3f3025;
    }

    .doughnut-legend {
        display: flex;
        flex-direction: column;
        gap: 14px;
        flex: 1;
    }

    .legend-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 3px;
    }

    .legend-item-info {
        line-height: 1.3;
    }

    .legend-item-info strong {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #3f3025;
        margin-bottom: 2px;
    }

    .legend-item-info span {
        display: block;
        font-size: 11px;
        color: #8a7a6a;
    }

    /* ---------- BOTTOM ROW ---------- */

    .bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 12px;
    }

    .list-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
    }

    .list-item:not(:last-child) {
        border-bottom: 1px solid #f5efe6;
    }

    .list-thumb {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #f7f1e8;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
    }

    .list-info {
        flex: 1;
        min-width: 0;
    }

    .list-info strong {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #3f3025;
        margin-bottom: 2px;
    }

    .list-info span {
        display: block;
        font-size: 10px;
        color: #8a7a6a;
    }

    .progress-track {
        width: 100%;
        height: 6px;
        background: #f0e8dd;
        border-radius: 99px;
        overflow: hidden;
        margin-top: 6px;
    }

    .progress-fill {
        height: 100%;
        background: #6b4d38;
        border-radius: 99px;
    }

    .qty-label {
        font-size: 10px;
        color: #8a7a6a;
        margin-left: 6px;
        flex-shrink: 0;
    }

    .badge-stock {
        font-size: 10px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 99px;
        background: #6b4d38;
        color: #fff;
        flex-shrink: 0;
    }

    /* =====================================================
    RESPONSIVE
    ===================================================== */

    /* Tablet Besar */
    @media (max-width: 1200px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .mid-grid {
            grid-template-columns: 1fr;
        }
        .bottom-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    /* Tablet */
    @media (max-width: 900px) {
        .dashboard-wrap {
            gap: 14px;
            padding-top: 10px;
        }

        .dash-welcome h1 {
            font-size: 24px;
        }

        .dash-welcome p {
            font-size: 13px;
        }

        .stat-info .stat-value {
            font-size: 22px;
        }

        .doughnut-wrap {
            flex-direction: column;
            align-items: flex-start;
        }

        .dash-date {
            font-size: 12px;
            padding: 7px 12px;
        }
    }

    /* Mobile */
    @media (max-width: 700px) {
        .dashboard-wrap {
            gap: 12px;
            padding-top: 6px;
        }

        .dash-header {
            flex-direction: column;
            gap: 14px;
        }

        .dash-welcome h1 {
            font-size: 20px;
        }

        .dash-welcome p {
            font-size: 12px;
        }

        .dash-header-right {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }

        .dash-date {
            font-size: 11px;
            padding: 6px 10px;
            flex: 1 1 auto;
            min-width: 0;
        }

        .dash-clock-text {
            font-size: 11px;
        }

        .dash-date-icon {
            width: 13px;
            height: 13px;
        }

        .dash-user-info span {
            display: none;
        }

        .dash-hero {
            height: 80px;
        }

        .dash-hero img {
            height: 90px;
        }

        .stat-grid {
            grid-template-columns: 1fr;
        }

        .bottom-grid {
            grid-template-columns: 1fr;
        }

        .panel {
            padding: 16px 18px;
        }

        .panel-title h3 {
            font-size: 13px;
        }

        .panel-title span {
            font-size: 10px;
        }

        .chart-line-wrap {
            height: 160px;
        }

        .doughnut-svg {
            width: 140px;
            height: 140px;
        }
    }

    /* Mobile Kecil */
    @media (max-width: 450px) {
        .dash-welcome h1 {
            font-size: 18px;
        }

        .dash-welcome p {
            font-size: 11px;
        }

        .stat-info .stat-value {
            font-size: 20px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
        }

        .stat-icon i {
            width: 18px;
            height: 18px;
        }

        .dash-icon-btn {
            width: 34px;
            height: 34px;
        }

        .dash-user-avatar {
            width: 34px;
            height: 34px;
            font-size: 12px;
        }

        .dash-hero {
            height: 70px;
        }

        .dash-hero img {
            height: 80px;
        }

        .doughnut-svg {
            width: 120px;
            height: 120px;
        }

        .dash-date {
            font-size: 10px;
            padding: 5px 8px;
            gap: 6px;
        }

        .dash-date-icon {
            width: 12px;
            height: 12px;
        }

        .dash-clock-text {
            font-size: 10px;
        }
    }
</style>

<div class="dashboard-wrap">

    <!-- =====================================================
        HEADER
    ====================================================== -->
    <div class="dash-header">

        <div class="dash-welcome">
            <h1>Selamat Datang, Admin 👋</h1>
            <p>Kelola stok roti dan pantau keuntungan toko andengan mudah</p>
        </div>

        <div class="dash-header-right">
            <!-- Jam Real-time (tanpa hari, tanpa detik, tanpa dropdown) -->
            <div class="dash-date">
                <i data-lucide="clock" class="dash-date-icon"></i>
                <span id="realtime-clock" class="dash-clock-text">Memuat...</span>
            </div>

            <div class="dash-icon-btn">
                <i data-lucide="bell" style="width:17px;height:17px;"></i>
            </div>

            <div class="dash-user">
                <div class="dash-user-avatar">P</div>
                <div class="dash-user-info">
                    <strong>Penjual</strong>
                    <span>Pemilik Toko</span>
                </div>
                <i data-lucide="chevron-down" style="width:14px;height:14px;color:#7a6a5a;"></i>
            </div>
        </div>
    </div>

    <!-- =====================================================
        HERO ILLUSTRATION
    ====================================================== -->
    <div class="dash-hero">
        <img src="{{ asset('images/hero-bakery.png') }}" alt="Bakery Illustration">
    </div>

    <!-- =====================================================
        STAT CARDS
    ====================================================== -->
    <div class="stat-grid">

        <!-- Total Produk -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon brown">
                    <i data-lucide="box"></i>
                </div>
                <div class="stat-info">
                    <h4>Total Produk</h4>
                    <div class="stat-value">12</div>
                    <div class="stat-desc">Jenis produk tersedia</div>
                </div>
            </div>
            <a href="#" class="stat-link">
                Lihat produk
                <i data-lucide="arrow-right"></i>
            </a>
        </div>

        <!-- Total Stok -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon yellow">
                    <i data-lucide="package"></i>
                </div>
                <div class="stat-info">
                    <h4>Total Stok</h4>
                    <div class="stat-value">156</div>
                    <div class="stat-desc">Pcs tersedia</div>
                </div>
            </div>
            <a href="#" class="stat-link">
                Lihat stok
                <i data-lucide="arrow-right"></i>
            </a>
        </div>

        <!-- Penjualan Hari Ini -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon green">
                    <i data-lucide="shopping-cart"></i>
                </div>
                <div class="stat-info">
                    <h4>Penjualan Hari Ini</h4>
                    <div class="stat-value">37</div>
                    <div class="stat-desc">Produk terjual</div>
                </div>
            </div>
            <a href="#" class="stat-link">
                Lihat penjualan
                <i data-lucide="arrow-right"></i>
            </a>
        </div>

        <!-- Laba Hari Ini -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon red">
                    <i data-lucide="dollar-sign"></i>
                </div>
                <div class="stat-info">
                    <h4>Laba Hari Ini</h4>
                    <div class="stat-value">Rp 235.000</div>
                    <div class="stat-desc">Laba bersih</div>
                </div>
            </div>
            <a href="#" class="stat-link">
                Lihat laporan laba
                <i data-lucide="arrow-right"></i>
            </a>
        </div>

    </div>

    <!-- =====================================================
        MIDDLE ROW (Line Chart + Doughnut)
    ====================================================== -->
    <div class="mid-grid">

        <!-- Ringkasan Penjualan -->
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <div class="panel-icon">
                        <i data-lucide="line-chart"></i>
                    </div>
                    <div>
                        <h3>Ringkasan Penjualan</h3>
                        <span>6 hari terakhir</span>
                    </div>
                </div>
                <div class="panel-total">
                    <span>Total</span>
                    <strong>Rp 1.645.000</strong>
                </div>
            </div>

            <div class="chart-line-wrap">
                <div class="chart-y-labels" style="position:absolute;left:0;top:0;height:200px;">
                    <span>500 rb</span>
                    <span>400 rb</span>
                    <span>300 rb</span>
                    <span>200 rb</span>
                    <span>100 rb</span>
                    <span>0</span>
                </div>

                <svg viewBox="0 0 600 200" preserveAspectRatio="none" style="padding-left:50px;">
                    <g stroke="#f0e8dd" stroke-width="1">
                        <line x1="0" y1="0"   x2="600" y2="0"/>
                        <line x1="0" y1="40"  x2="600" y2="40"/>
                        <line x1="0" y1="80"  x2="600" y2="80"/>
                        <line x1="0" y1="120" x2="600" y2="120"/>
                        <line x1="0" y1="160" x2="600" y2="160"/>
                        <line x1="0" y1="200" x2="600" y2="200"/>
                    </g>

                    <polyline
                        points="30,140 130,165 230,110 330,85 430,135 530,90"
                        fill="none"
                        stroke="#6b4d38"
                        stroke-width="2.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                    <g fill="#6b4d38">
                        <circle cx="30"  cy="140" r="4"/>
                        <circle cx="130" cy="165" r="4"/>
                        <circle cx="230" cy="110" r="4"/>
                        <circle cx="330" cy="85"  r="4"/>
                        <circle cx="430" cy="135" r="4"/>
                        <circle cx="530" cy="90"  r="4"/>
                    </g>
                </svg>
            </div>

            <div class="chart-x-labels" style="padding-left:50px;">
                <span>12 sep</span>
                <span>13 sep</span>
                <span>14 sep</span>
                <span>15 sep</span>
                <span>16 sep</span>
                <span>17 sep</span>
            </div>
        </div>

        <!-- Laba Bersih (Doughnut) -->
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <div class="panel-icon">
                        <i data-lucide="pie-chart"></i>
                    </div>
                    <div>
                        <h3>Laba Bersih</h3>
                        <span>6 hari terakhir</span>
                    </div>
                </div>
            </div>

            <div class="doughnut-wrap">
                <div class="doughnut-svg">
                    <svg viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="38"
                                fill="none"
                                stroke="#f0e8dd"
                                stroke-width="18"/>

                        <circle cx="50" cy="50" r="38"
                                fill="none"
                                stroke="#6b4d38"
                                stroke-width="18"
                                stroke-dasharray="143 96"
                                stroke-dashoffset="0"/>

                        <circle cx="50" cy="50" r="38"
                                fill="none"
                                stroke="#a88a6d"
                                stroke-width="18"
                                stroke-dasharray="72 167"
                                stroke-dashoffset="-143"/>

                        <circle cx="50" cy="50" r="38"
                                fill="none"
                                stroke="#e8ded3"
                                stroke-width="18"
                                stroke-dasharray="24 215"
                                stroke-dashoffset="-215"/>
                    </svg>

                    <div class="doughnut-center">
                        <span>Total Laba</span>
                        <strong>Rp 1.645.000</strong>
                    </div>
                </div>

                <div class="doughnut-legend">
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#6b4d38;"></div>
                        <div class="legend-item-info">
                            <strong>Penjualan</strong>
                            <span>Rp 2.890.000</span>
                        </div>
                    </div>

                    <div class="legend-item">
                        <div class="legend-dot" style="background:#a88a6d;"></div>
                        <div class="legend-item-info">
                            <strong>Modal (Harga Beli)</strong>
                            <span>Rp 1.245.000</span>
                        </div>
                    </div>

                    <div class="legend-item">
                        <div class="legend-dot" style="background:#e8ded3;"></div>
                        <div class="legend-item-info">
                            <strong>Laba Bersih</strong>
                            <span>Rp 1.645.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- =====================================================
        BOTTOM ROW (3 panels)
    ====================================================== -->
    <div class="bottom-grid">

        <!-- Kategori Terlaris -->
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <div class="panel-icon">
                        <i data-lucide="bar-chart-3"></i>
                    </div>
                    <div>
                        <h3>Kategori Terlaris</h3>
                        <span>Berdasarkan jumlah terjual</span>
                    </div>
                </div>
            </div>

            <div class="list-item">
                <div class="list-thumb">🍞</div>
                <div class="list-info">
                    <strong>Roti Manis</strong>
                    <div class="progress-track">
                        <div class="progress-fill" style="width:80%;"></div>
                    </div>
                </div>
                <span class="qty-label">45 pcs</span>
            </div>

            <div class="list-item">
                <div class="list-thumb">🥐</div>
                <div class="list-info">
                    <strong>Roti Asin</strong>
                    <div class="progress-track">
                        <div class="progress-fill" style="width:40%;"></div>
                    </div>
                </div>
                <span class="qty-label">12 Pcs</span>
            </div>

            <div class="list-item">
                <div class="list-thumb">🥨</div>
                <div class="list-info">
                    <strong>Pastry</strong>
                    <div class="progress-track">
                        <div class="progress-fill" style="width:30%;"></div>
                    </div>
                </div>
                <span class="qty-label">10 Pcs</span>
            </div>

            <div class="list-item">
                <div class="list-thumb">🍩</div>
                <div class="list-info">
                    <strong>Donat</strong>
                    <div class="progress-track">
                        <div class="progress-fill" style="width:20%;"></div>
                    </div>
                </div>
                <span class="qty-label">8 Pcs</span>
            </div>
        </div>

        <!-- Stok Menipis -->
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <div class="panel-icon">
                        <i data-lucide="alert-triangle"></i>
                    </div>
                    <div>
                        <h3>Stok Menipis</h3>
                        <span>Produk dengan stok rendah</span>
                    </div>
                </div>
            </div>

            <div class="list-item">
                <div class="list-thumb">🥐</div>
                <div class="list-info">
                    <strong>Croissant</strong>
                </div>
                <span class="badge-stock">Stok: 3 Pcs</span>
            </div>

            <div class="list-item">
                <div class="list-thumb">🌀</div>
                <div class="list-info">
                    <strong>Cinnamon Roll</strong>
                </div>
                <span class="badge-stock">Stok: 1 Pcs</span>
            </div>

            <div class="list-item">
                <div class="list-thumb">🥨</div>
                <div class="list-info">
                    <strong>Pretzel Salt</strong>
                </div>
                <span class="badge-stock">Stok: 3 Pcs</span>
            </div>

            <div class="list-item">
                <div class="list-thumb">🥖</div>
                <div class="list-info">
                    <strong>Sourdough</strong>
                </div>
                <span class="badge-stock">Stok: 5 Pcs</span>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <div class="panel-icon">
                        <i data-lucide="clock"></i>
                    </div>
                    <div>
                        <h3>Aktivitas Terbaru</h3>
                        <span>Transaksi terbaru yang terjadi</span>
                    </div>
                </div>
            </div>

            <div class="list-item">
                <div class="list-thumb">
                    <i data-lucide="shopping-cart" style="width:16px;height:16px;color:#6b4d38;"></i>
                </div>
                <div class="list-info">
                    <strong>Penjualan 5 pcs Salt Bread</strong>
                    <span>06 Sep 2026, 15:50</span>
                </div>
            </div>

            <div class="list-item">
                <div class="list-thumb">
                    <i data-lucide="shopping-cart" style="width:16px;height:16px;color:#6b4d38;"></i>
                </div>
                <div class="list-info">
                    <strong>Stok berkurang 3 pcs Cinnamon Roll</strong>
                    <span>06 Sep 2026, 13:10</span>
                </div>
            </div>

            <div class="list-item">
                <div class="list-thumb">
                    <i data-lucide="shopping-cart" style="width:16px;height:16px;color:#6b4d38;"></i>
                </div>
                <div class="list-info">
                    <strong>Penjualan 2 pcs Sourdough</strong>
                    <span>06 Sep 2026, 12:47</span>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Re-init Lucide icons -->
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

<!-- =====================================================
    JAM REAL-TIME (TANPA HARI, TANPA DETIK)
    ====================================================== -->
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

    // Update tiap detik agar menit selalu akurat saat berubah
    updateClock();
    setInterval(updateClock, 1000);
</script>

@endsection
