@extends('layout')

@section('title', 'Dashboard')

@section('content')

<style>
    /* =====================================================
       DASHBOARD
    ===================================================== */

    .dashboard-wrap {
        display: flex;
        flex-direction: column;
        gap: 18px;
        padding-top: 28px;
        width: 100%;
        max-width: 100%;
        overflow: hidden;
    }


    /* =====================================================
       HEADER
    ===================================================== */

    .dash-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 0;
        width: 100%;
    }

    .dash-welcome {
        min-width: 0;
    }

    .dash-welcome h1 {
        font-family: "Inter", sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #3f3025;
        margin-bottom: 6px;
        line-height: 1.25;
    }

    .dash-welcome p {
        font-size: 14px;
        color: #7a6a5a;
        line-height: 1.5;
    }


    /* =====================================================
       HEADER RIGHT
    ===================================================== */

    .dash-header-right {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        flex-shrink: 0;
    }


    /* =====================================================
       JAM REAL-TIME
    ===================================================== */

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


    /* =====================================================
       ICON BUTTON
    ===================================================== */

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

        flex-shrink: 0;
    }


    /* =====================================================
       USER
    ===================================================== */

    .dash-user {
        display: flex;
        align-items: center;
        gap: 8px;

        cursor: pointer;

        flex-shrink: 0;
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

        flex-shrink: 0;
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

        margin-top: 2px;
    }


    /* =====================================================
       HERO ILLUSTRATION
    ===================================================== */

    .dash-hero {
        position: relative;

        width: 100%;
        height: 100px;

        margin: 0;

        display: flex;
        justify-content: flex-end;
        align-items: flex-end;

        overflow: hidden;
    }

    .dash-hero img {
        height: 115px;
        width: auto;

        max-width: 100%;

        object-fit: contain;

        position: absolute;

        right: 0;
        bottom: 0;
    }


    /* =====================================================
       STAT CARDS
    ===================================================== */

    .stat-grid {
        display: grid;

        grid-template-columns: repeat(4, minmax(0, 1fr));

        gap: 12px;

        width: 100%;
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

        min-width: 0;

        transition: 0.2s ease;
    }

    .stat-card:hover {
        box-shadow: 0 4px 14px rgba(107, 77, 56, 0.08);
    }

    .stat-top {
        display: flex;
        align-items: center;

        gap: 14px;

        min-width: 0;
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

    .stat-icon.brown {
        background: #efe3d5;
        color: #6b4d38;
    }

    .stat-icon.yellow {
        background: #fdf1cf;
        color: #c9a227;
    }

    .stat-icon.green {
        background: #ddf3dd;
        color: #4caf50;
    }

    .stat-icon.red {
        background: #fbe0e0;
        color: #e05252;
    }

    .stat-info {
        min-width: 0;
    }

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

        word-break: break-word;
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

    .stat-link:hover {
        color: #6b4d38;
    }

    .stat-link i {
        width: 16px;
        height: 16px;

        color: #3f3025;

        flex-shrink: 0;
    }


    /* =====================================================
       MIDDLE GRID
    ===================================================== */

    .mid-grid {
        display: grid;

        grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);

        gap: 12px;

        width: 100%;
    }


    /* =====================================================
       PANEL
    ===================================================== */

    .panel {
        background: #fff;

        border: 1px solid #f0e8dd;

        border-radius: 12px;

        padding: 20px 22px;

        min-width: 0;

        overflow: hidden;
    }

    .panel-header {
        display: flex;

        justify-content: space-between;
        align-items: flex-start;

        gap: 15px;

        margin-bottom: 18px;

        min-width: 0;
    }

    .panel-title {
        display: flex;

        align-items: center;

        gap: 12px;

        min-width: 0;
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

        flex-shrink: 0;
    }

    .panel-icon i {
        width: 18px;
        height: 18px;
    }

    .panel-title > div:last-child {
        min-width: 0;
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

        flex-shrink: 0;
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

        white-space: nowrap;
    }


    /* =====================================================
       LINE CHART
    ===================================================== */

    .chart-line-wrap {
        position: relative;

        height: 200px;

        width: 100%;

        overflow: hidden;
    }

    .chart-line-wrap svg {
        width: calc(100% - 50px);

        height: 100%;

        margin-left: 50px;

        overflow: visible;

        display: block;
    }

    .chart-y-labels {
        position: absolute;

        left: 0;
        top: 0;

        width: 45px;
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

        padding-left: 50px;
        padding-right: 5px;

        margin-top: 8px;

        gap: 5px;
    }

    .chart-x-labels span {
        white-space: nowrap;
    }


    /* =====================================================
       DOUGHNUT
    ===================================================== */

    .doughnut-wrap {
        display: flex;

        align-items: center;

        gap: 20px;

        min-width: 0;
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

        padding: 10px;
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

        line-height: 1.3;
    }

    .doughnut-legend {
        display: flex;

        flex-direction: column;

        gap: 14px;

        flex: 1;

        min-width: 0;
    }

    .legend-item {
        display: flex;

        align-items: flex-start;

        gap: 10px;

        min-width: 0;
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

        min-width: 0;
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

        word-break: break-word;
    }


    /* =====================================================
       BOTTOM GRID
    ===================================================== */

    .bottom-grid {
        display: grid;

        grid-template-columns: repeat(3, minmax(0, 1fr));

        gap: 12px;

        width: 100%;
    }


    /* =====================================================
       LIST
    ===================================================== */

    .list-item {
        display: flex;

        align-items: center;

        gap: 12px;

        padding: 10px 0;

        min-width: 0;
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

        line-height: 1.4;

        word-break: break-word;
    }

    .list-info span {
        display: block;

        font-size: 10px;

        color: #8a7a6a;

        line-height: 1.4;
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

        white-space: nowrap;
    }

    .badge-stock {
        font-size: 10px;

        font-weight: 600;

        padding: 4px 10px;

        border-radius: 99px;

        background: #6b4d38;

        color: #fff;

        flex-shrink: 0;

        white-space: nowrap;
    }


    /* =====================================================
       TABLET BESAR
       <= 1200px
    ===================================================== */

    @media (max-width: 1200px) {

        .stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .mid-grid {
            grid-template-columns: 1fr;
        }

        .bottom-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }


    /* =====================================================
       TABLET
       <= 900px
    ===================================================== */

    @media (max-width: 900px) {

        .dashboard-wrap {
            gap: 14px;

            padding-top: 20px;
        }


        /* Header */

        .dash-header {
            gap: 14px;
        }

        .dash-welcome h1 {
            font-size: 24px;
        }

        .dash-welcome p {
            font-size: 13px;
        }


        /* Header kanan */

        .dash-header-right {
            gap: 8px;
        }

        .dash-date {
            font-size: 12px;

            padding: 7px 10px;
        }

        .dash-icon-btn {
            width: 36px;
            height: 36px;
        }

        .dash-user-avatar {
            width: 36px;
            height: 36px;
        }

        .dash-user-info {
            display: none;
        }


        /* Stat */

        .stat-info .stat-value {
            font-size: 22px;
        }


        /* Doughnut */

        .doughnut-wrap {
            gap: 16px;
        }

        .doughnut-svg {
            width: 150px;
            height: 150px;
        }

    }


    /* =====================================================
       MOBILE
       <= 700px
    ===================================================== */

    @media (max-width: 700px) {

        .dashboard-wrap {
            gap: 12px;

            padding-top: 6px;
        }


        /* Header */

        .dash-header {
            flex-direction: column;

            gap: 12px;
        }

        .dash-welcome {
            width: 100%;
        }

        .dash-welcome h1 {
            font-size: 21px;

            margin-bottom: 5px;
        }

        .dash-welcome p {
            font-size: 12px;

            line-height: 1.5;
        }


        /* Header kanan */

        .dash-header-right {
            width: 100%;

            display: flex;

            flex-wrap: nowrap;

            align-items: center;

            justify-content: flex-start;

            gap: 7px;
        }

        .dash-date {
            flex: 1;

            min-width: 0;

            font-size: 11px;

            padding: 7px 9px;
        }

        .dash-date-icon {
            width: 13px;
            height: 13px;
        }

        .dash-clock-text {
            font-size: 11px;
        }

        .dash-icon-btn {
            width: 34px;
            height: 34px;
        }

        .dash-user {
            gap: 0;
        }

        .dash-user-avatar {
            width: 34px;
            height: 34px;

            font-size: 12px;
        }

        .dash-user-info {
            display: none;
        }

        .dash-user > i {
            display: none;
        }


        /* Hero */

        .dash-hero {
            height: 75px;
        }

        .dash-hero img {
            height: 85px;

            max-width: 85%;
        }


        /* Stat */

        .stat-grid {
            grid-template-columns: 1fr;

            gap: 10px;
        }

        .stat-card {
            min-height: 120px;

            padding: 16px 18px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
        }

        .stat-icon i {
            width: 20px;
            height: 20px;
        }

        .stat-info h4 {
            font-size: 12px;
        }

        .stat-info .stat-value {
            font-size: 21px;
        }

        .stat-info .stat-desc {
            font-size: 10px;
        }


        /* Middle */

        .mid-grid {
            grid-template-columns: 1fr;

            gap: 10px;
        }


        /* Panel */

        .panel {
            padding: 16px 17px;

            border-radius: 11px;
        }

        .panel-header {
            gap: 10px;

            margin-bottom: 14px;
        }

        .panel-title {
            gap: 9px;
        }

        .panel-icon {
            width: 34px;
            height: 34px;

            border-radius: 7px;
        }

        .panel-icon i {
            width: 16px;
            height: 16px;
        }

        .panel-title h3 {
            font-size: 13px;
        }

        .panel-title span {
            font-size: 9px;
        }

        .panel-total span {
            font-size: 9px;
        }

        .panel-total strong {
            font-size: 11px;
        }


        /* Chart */

        .chart-line-wrap {
            height: 160px;
        }

        .chart-line-wrap svg {
            width: calc(100% - 40px);

            margin-left: 40px;
        }

        .chart-y-labels {
            width: 35px;

            font-size: 9px;
        }

        .chart-x-labels {
            padding-left: 40px;

            font-size: 8px;

            margin-top: 6px;
        }


        /* Doughnut */

        .doughnut-wrap {
            flex-direction: column;

            align-items: center;

            gap: 18px;
        }

        .doughnut-svg {
            width: 145px;
            height: 145px;
        }

        .doughnut-legend {
            width: 100%;

            gap: 11px;
        }


        /* Bottom */

        .bottom-grid {
            grid-template-columns: 1fr;

            gap: 10px;
        }


        /* List */

        .list-item {
            gap: 10px;

            padding: 9px 0;
        }

        .list-thumb {
            width: 34px;
            height: 34px;

            font-size: 16px;
        }

        .list-info strong {
            font-size: 11px;
        }

        .list-info span {
            font-size: 9px;
        }

        .qty-label {
            font-size: 9px;
        }

        .badge-stock {
            font-size: 9px;

            padding: 4px 8px;
        }

    }


    /* =====================================================
       MOBILE KECIL
       <= 450px
    ===================================================== */

    @media (max-width: 450px) {

        .dashboard-wrap {
            padding-top: 4px;

            gap: 10px;
        }


        /* Header */

        .dash-welcome h1 {
            font-size: 18px;
        }

        .dash-welcome p {
            font-size: 11px;
        }


        /* Header kanan */

        .dash-header-right {
            gap: 6px;
        }

        .dash-date {
            padding: 6px 8px;

            gap: 5px;
        }

        .dash-clock-text {
            font-size: 9px;
        }

        .dash-date-icon {
            width: 11px;
            height: 11px;
        }

        .dash-icon-btn {
            width: 32px;
            height: 32px;
        }

        .dash-icon-btn i {
            width: 15px !important;
            height: 15px !important;
        }

        .dash-user-avatar {
            width: 32px;
            height: 32px;

            font-size: 11px;
        }


        /* Hero */

        .dash-hero {
            height: 62px;
        }

        .dash-hero img {
            height: 72px;
        }


        /* Stat */

        .stat-card {
            padding: 14px 15px;

            min-height: 112px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
        }

        .stat-icon i {
            width: 18px;
            height: 18px;
        }

        .stat-top {
            gap: 10px;
        }

        .stat-info h4 {
            font-size: 11px;
        }

        .stat-info .stat-value {
            font-size: 19px;
        }

        .stat-info .stat-desc {
            font-size: 9px;
        }

        .stat-link {
            font-size: 10px;

            margin-top: 10px;

            padding-top: 8px;
        }

        .stat-link i {
            width: 14px;
            height: 14px;
        }


        /* Panel */

        .panel {
            padding: 14px 14px;
        }

        .panel-title h3 {
            font-size: 12px;
        }

        .panel-title span {
            font-size: 8px;
        }

        .panel-total strong {
            font-size: 10px;
        }


        /* Chart */

        .chart-line-wrap {
            height: 140px;
        }

        .chart-x-labels {
            font-size: 7px;

            padding-left: 35px;
        }

        .chart-line-wrap svg {
            width: calc(100% - 35px);

            margin-left: 35px;
        }

        .chart-y-labels {
            width: 30px;

            font-size: 8px;
        }


        /* Doughnut */

        .doughnut-svg {
            width: 125px;
            height: 125px;
        }

        .doughnut-center span {
            font-size: 8px;
        }

        .doughnut-center strong {
            font-size: 9px;
        }


        /* List */

        .list-thumb {
            width: 32px;
            height: 32px;
        }

        .list-info strong {
            font-size: 10px;
        }

        .qty-label {
            font-size: 8px;
        }

        .badge-stock {
            font-size: 8px;

            padding: 3px 7px;
        }

    }

</style>


<div class="dashboard-wrap">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="dash-header">

        <div class="dash-welcome">

            <h1>
                Selamat Datang, Admin 👋
            </h1>

            <p>
                Kelola stok roti dan pantau keuntungan toko dengan mudah
            </p>

        </div>


        <div class="dash-header-right">

            <!-- Jam Real-time -->

            <div class="dash-date">

                <i
                    data-lucide="clock"
                    class="dash-date-icon"
                ></i>

                <span
                    id="realtime-clock"
                    class="dash-clock-text"
                >
                    Memuat...
                </span>

            </div>


            <!-- Notification -->

            <div class="dash-icon-btn">

                <i
                    data-lucide="bell"
                    style="width:17px;height:17px;"
                ></i>

            </div>


            <!-- User -->

            <div class="dash-user">

                <div class="dash-user-avatar">
                    P
                </div>

                <div class="dash-user-info">

                    <strong>
                        Penjual
                    </strong>

                    <span>
                        Pemilik Toko
                    </span>

                </div>

                <i
                    data-lucide="chevron-down"
                    style="width:14px;height:14px;color:#7a6a5a;"
                ></i>

            </div>

        </div>

    </div>



    <!-- =====================================================
         HERO ILLUSTRATION
    ====================================================== -->

    <div class="dash-hero">

        <img
            src="{{ asset('images/hero-bakery.png') }}"
            alt="Bakery Illustration"
        >

    </div>



    <!-- =====================================================
         STAT CARDS
    ====================================================== -->

    <div class="stat-grid">


        <!-- TOTAL PRODUK -->

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon brown">

                    <i data-lucide="box"></i>

                </div>

                <div class="stat-info">

                    <h4>
                        Total Produk
                    </h4>

                    <div class="stat-value">
                        12
                    </div>

                    <div class="stat-desc">
                        Jenis produk tersedia
                    </div>

                </div>

            </div>


            <a href="#" class="stat-link">

                Lihat produk

                <i data-lucide="arrow-right"></i>

            </a>

        </div>



        <!-- TOTAL STOK -->

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon yellow">

                    <i data-lucide="package"></i>

                </div>

                <div class="stat-info">

                    <h4>
                        Total Stok
                    </h4>

                    <div class="stat-value">
                        156
                    </div>

                    <div class="stat-desc">
                        Pcs tersedia
                    </div>

                </div>

            </div>


            <a href="#" class="stat-link">

                Lihat stok

                <i data-lucide="arrow-right"></i>

            </a>

        </div>



        <!-- PENJUALAN HARI INI -->

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon green">

                    <i data-lucide="shopping-cart"></i>

                </div>

                <div class="stat-info">

                    <h4>
                        Penjualan Hari Ini
                    </h4>

                    <div class="stat-value">
                        37
                    </div>

                    <div class="stat-desc">
                        Produk terjual
                    </div>

                </div>

            </div>


            <a href="#" class="stat-link">

                Lihat penjualan

                <i data-lucide="arrow-right"></i>

            </a>

        </div>



        <!-- LABA HARI INI -->

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon red">

                    <i data-lucide="dollar-sign"></i>

                </div>

                <div class="stat-info">

                    <h4>
                        Laba Hari Ini
                    </h4>

                    <div class="stat-value">
                        Rp 235.000
                    </div>

                    <div class="stat-desc">
                        Laba bersih
                    </div>

                </div>

            </div>


            <a href="#" class="stat-link">

                Lihat laporan laba

                <i data-lucide="arrow-right"></i>

            </a>

        </div>

    </div>



    <!-- =====================================================
         MIDDLE ROW
    ====================================================== -->

    <div class="mid-grid">


        <!-- RINGKASAN PENJUALAN -->

        <div class="panel">

            <div class="panel-header">

                <div class="panel-title">

                    <div class="panel-icon">

                        <i data-lucide="line-chart"></i>

                    </div>

                    <div>

                        <h3>
                            Ringkasan Penjualan
                        </h3>

                        <span>
                            6 hari terakhir
                        </span>

                    </div>

                </div>


                <div class="panel-total">

                    <span>
                        Total
                    </span>

                    <strong>
                        Rp 1.645.000
                    </strong>

                </div>

            </div>


            <div class="chart-line-wrap">

                <div class="chart-y-labels">

                    <span>500 rb</span>
                    <span>400 rb</span>
                    <span>300 rb</span>
                    <span>200 rb</span>
                    <span>100 rb</span>
                    <span>0</span>

                </div>


                <svg
                    viewBox="0 0 600 200"
                    preserveAspectRatio="none"
                >

                    <g
                        stroke="#f0e8dd"
                        stroke-width="1"
                    >

                        <line
                            x1="0"
                            y1="0"
                            x2="600"
                            y2="0"
                        />

                        <line
                            x1="0"
                            y1="40"
                            x2="600"
                            y2="40"
                        />

                        <line
                            x1="0"
                            y1="80"
                            x2="600"
                            y2="80"
                        />

                        <line
                            x1="0"
                            y1="120"
                            x2="600"
                            y2="120"
                        />

                        <line
                            x1="0"
                            y1="160"
                            x2="600"
                            y2="160"
                        />

                        <line
                            x1="0"
                            y1="200"
                            x2="600"
                            y2="200"
                        />

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

                        <circle
                            cx="30"
                            cy="140"
                            r="4"
                        />

                        <circle
                            cx="130"
                            cy="165"
                            r="4"
                        />

                        <circle
                            cx="230"
                            cy="110"
                            r="4"
                        />

                        <circle
                            cx="330"
                            cy="85"
                            r="4"
                        />

                        <circle
                            cx="430"
                            cy="135"
                            r="4"
                        />

                        <circle
                            cx="530"
                            cy="90"
                            r="4"
                        />

                    </g>

                </svg>

            </div>


            <div class="chart-x-labels">

                <span>12 Sep</span>
                <span>13 Sep</span>
                <span>14 Sep</span>
                <span>15 Sep</span>
                <span>16 Sep</span>
                <span>17 Sep</span>

            </div>

        </div>



        <!-- LABA BERSIH -->

        <div class="panel">

            <div class="panel-header">

                <div class="panel-title">

                    <div class="panel-icon">

                        <i data-lucide="pie-chart"></i>

                    </div>

                    <div>

                        <h3>
                            Laba Bersih
                        </h3>

                        <span>
                            6 hari terakhir
                        </span>

                    </div>

                </div>

            </div>


            <div class="doughnut-wrap">


                <!-- Doughnut -->

                <div class="doughnut-svg">

                    <svg viewBox="0 0 100 100">

                        <circle
                            cx="50"
                            cy="50"
                            r="38"
                            fill="none"
                            stroke="#f0e8dd"
                            stroke-width="18"
                        />

                        <circle
                            cx="50"
                            cy="50"
                            r="38"
                            fill="none"
                            stroke="#6b4d38"
                            stroke-width="18"
                            stroke-dasharray="143 96"
                            stroke-dashoffset="0"
                        />

                        <circle
                            cx="50"
                            cy="50"
                            r="38"
                            fill="none"
                            stroke="#a88a6d"
                            stroke-width="18"
                            stroke-dasharray="72 167"
                            stroke-dashoffset="-143"
                        />

                        <circle
                            cx="50"
                            cy="50"
                            r="38"
                            fill="none"
                            stroke="#e8ded3"
                            stroke-width="18"
                            stroke-dasharray="24 215"
                            stroke-dashoffset="-215"
                        />

                    </svg>


                    <div class="doughnut-center">

                        <span>
                            Total Laba
                        </span>

                        <strong>
                            Rp 1.645.000
                        </strong>

                    </div>

                </div>



                <!-- Legend -->

                <div class="doughnut-legend">


                    <div class="legend-item">

                        <div
                            class="legend-dot"
                            style="background:#6b4d38;"
                        ></div>

                        <div class="legend-item-info">

                            <strong>
                                Penjualan
                            </strong>

                            <span>
                                Rp 2.890.000
                            </span>

                        </div>

                    </div>


                    <div class="legend-item">

                        <div
                            class="legend-dot"
                            style="background:#a88a6d;"
                        ></div>

                        <div class="legend-item-info">

                            <strong>
                                Modal (Harga Beli)
                            </strong>

                            <span>
                                Rp 1.245.000
                            </span>

                        </div>

                    </div>


                    <div class="legend-item">

                        <div
                            class="legend-dot"
                            style="background:#e8ded3;"
                        ></div>

                        <div class="legend-item-info">

                            <strong>
                                Laba Bersih
                            </strong>

                            <span>
                                Rp 1.645.000
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- =====================================================
         BOTTOM ROW
    ====================================================== -->

    <div class="bottom-grid">


        <!-- KATEGORI TERLARIS -->

        <div class="panel">

            <div class="panel-header">

                <div class="panel-title">

                    <div class="panel-icon">

                        <i data-lucide="bar-chart-3"></i>

                    </div>

                    <div>

                        <h3>
                            Kategori Terlaris
                        </h3>

                        <span>
                            Berdasarkan jumlah terjual
                        </span>

                    </div>

                </div>

            </div>


            <!-- Roti Manis -->

            <div class="list-item">

                <div class="list-thumb">
                    🍞
                </div>

                <div class="list-info">

                    <strong>
                        Roti Manis
                    </strong>

                    <div class="progress-track">

                        <div
                            class="progress-fill"
                            style="width:80%;"
                        ></div>

                    </div>

                </div>

                <span class="qty-label">
                    45 pcs
                </span>

            </div>


            <!-- Roti Asin -->

            <div class="list-item">

                <div class="list-thumb">
                    🥐
                </div>

                <div class="list-info">

                    <strong>
                        Roti Asin
                    </strong>

                    <div class="progress-track">

                        <div
                            class="progress-fill"
                            style="width:40%;"
                        ></div>

                    </div>

                </div>

                <span class="qty-label">
                    12 pcs
                </span>

            </div>


            <!-- Pastry -->

            <div class="list-item">

                <div class="list-thumb">
                    🥨
                </div>

                <div class="list-info">

                    <strong>
                        Pastry
                    </strong>

                    <div class="progress-track">

                        <div
                            class="progress-fill"
                            style="width:30%;"
                        ></div>

                    </div>

                </div>

                <span class="qty-label">
                    10 pcs
                </span>

            </div>


            <!-- Donat -->

            <div class="list-item">

                <div class="list-thumb">
                    🍩
                </div>

                <div class="list-info">

                    <strong>
                        Donat
                    </strong>

                    <div class="progress-track">

                        <div
                            class="progress-fill"
                            style="width:20%;"
                        ></div>

                    </div>

                </div>

                <span class="qty-label">
                    8 pcs
                </span>

            </div>

        </div>



        <!-- STOK MENIPIS -->

        <div class="panel">

            <div class="panel-header">

                <div class="panel-title">

                    <div class="panel-icon">

                        <i data-lucide="alert-triangle"></i>

                    </div>

                    <div>

                        <h3>
                            Stok Menipis
                        </h3>

                        <span>
                            Produk dengan stok rendah
                        </span>

                    </div>

                </div>

            </div>


            <!-- Croissant -->

            <div class="list-item">

                <div class="list-thumb">
                    🥐
                </div>

                <div class="list-info">

                    <strong>
                        Croissant
                    </strong>

                </div>

                <span class="badge-stock">
                    Stok: 3 Pcs
                </span>

            </div>


            <!-- Cinnamon Roll -->

            <div class="list-item">

                <div class="list-thumb">
                    🌀
                </div>

                <div class="list-info">

                    <strong>
                        Cinnamon Roll
                    </strong>

                </div>

                <span class="badge-stock">
                    Stok: 1 Pcs
                </span>

            </div>


            <!-- Pretzel -->

            <div class="list-item">

                <div class="list-thumb">
                    🥨
                </div>

                <div class="list-info">

                    <strong>
                        Pretzel Salt
                    </strong>

                </div>

                <span class="badge-stock">
                    Stok: 3 Pcs
                </span>

            </div>


            <!-- Sourdough -->

            <div class="list-item">

                <div class="list-thumb">
                    🥖
                </div>

                <div class="list-info">

                    <strong>
                        Sourdough
                    </strong>

                </div>

                <span class="badge-stock">
                    Stok: 5 Pcs
                </span>

            </div>

        </div>



        <!-- AKTIVITAS TERBARU -->

        <div class="panel">

            <div class="panel-header">

                <div class="panel-title">

                    <div class="panel-icon">

                        <i data-lucide="clock"></i>

                    </div>

                    <div>

                        <h3>
                            Aktivitas Terbaru
                        </h3>

                        <span>
                            Transaksi terbaru yang terjadi
                        </span>

                    </div>

                </div>

            </div>


            <!-- Aktivitas 1 -->

            <div class="list-item">

                <div class="list-thumb">

                    <i
                        data-lucide="shopping-cart"
                        style="width:16px;height:16px;color:#6b4d38;"
                    ></i>

                </div>

                <div class="list-info">

                    <strong>
                        Penjualan 5 pcs Salt Bread
                    </strong>

                    <span>
                        06 Sep 2026, 15:50
                    </span>

                </div>

            </div>


            <!-- Aktivitas 2 -->

            <div class="list-item">

                <div class="list-thumb">

                    <i
                        data-lucide="shopping-cart"
                        style="width:16px;height:16px;color:#6b4d38;"
                    ></i>

                </div>

                <div class="list-info">

                    <strong>
                        Stok berkurang 3 pcs Cinnamon Roll
                    </strong>

                    <span>
                        06 Sep 2026, 13:10
                    </span>

                </div>

            </div>


            <!-- Aktivitas 3 -->

            <div class="list-item">

                <div class="list-thumb">

                    <i
                        data-lucide="shopping-cart"
                        style="width:16px;height:16px;color:#6b4d38;"
                    ></i>

                </div>

                <div class="list-info">

                    <strong>
                        Penjualan 2 pcs Sourdough
                    </strong>

                    <span>
                        06 Sep 2026, 12:47
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- =====================================================
     LUCIDE
====================================================== -->

<script>

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

</script>



<!-- =====================================================
     JAM REAL-TIME
====================================================== -->

<script>

    function updateClock() {

        const now = new Date();

        const months = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        const date = now.getDate();

        const month =
            months[now.getMonth()];

        const year =
            now.getFullYear();

        const hh =
            String(now.getHours())
                .padStart(2, '0');

        const mm =
            String(now.getMinutes())
                .padStart(2, '0');

        const clockElement =
            document.getElementById('realtime-clock');


        if (clockElement) {

            clockElement.textContent =
                `${date} ${month} ${year} • ${hh}:${mm}`;

        }

    }


    updateClock();

    setInterval(updateClock, 1000);

</script>

@endsection