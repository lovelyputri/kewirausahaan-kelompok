<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Congek Bakes - Bakery Store')
    </title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Ginzel:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Lucide Icon -->
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- ✅ Flatpickr (date range picker) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =====================================================
           VARIABLE
        ===================================================== */

        :root {
            --brown: #6b4d38;
            --brown-dark: #60432f;
            --brown-hover: #4a3526;

            --cream: #fbf7f1;
            --cream-active: #e8ded3;

            --white: #ffffff;

            --sidebar-width: 268px;
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {
            min-height: 100vh;
            background: var(--cream);
            color: #3f3025;
            font-family: "Inter", sans-serif;
        }


        /* =====================================================
           RENDA ATAS
        ===================================================== */

        .top-renda {
            position: fixed;

            top: -10px;
            left: 0;

            width: 100%;

            height: auto;
            min-height: 60px;

            z-index: 1200;

            pointer-events: none;

            overflow: hidden;
        }


        .top-renda img {
            display: block;

            width: 100%;

            height: auto;

            object-fit: contain;
            object-position: top center;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            position: fixed;

            top: 0;
            left: 0;

            width: var(--sidebar-width);
            height: 100vh;

            background: var(--brown);

            padding: 74px 18px 22px;

            z-index: 1000;

            overflow: hidden;

            display: flex;
            flex-direction: column;
        }


        /* =====================================================
           BRAND
        ===================================================== */

        .brand {
            display: flex;

            align-items: center;

            gap: 14px;

            padding: 0 6px;

            margin-bottom: 26px;

            flex-shrink: 0;
        }


        .brand-logo {
            width: 70px;
            height: 70px;

            flex-shrink: 0;

            background: transparent;

            display: flex;

            align-items: center;
            justify-content: center;

            overflow: hidden;
        }


        .brand-logo img {
            width: 100%;
            height: 100%;

            object-fit: contain;
        }


        .brand-info {
            color: white;

            min-width: 0;
        }


        .brand-name {
            font-family: "Ginzel", serif;

            font-size: 17px;

            font-weight: 600;

            line-height: 1.2;

            margin-bottom: 4px;

            letter-spacing: 1px;
        }


        .brand-subtitle {
            font-family: "Inter", sans-serif;

            font-size: 11px;

            font-weight: 400;

            opacity: 0.85;

            letter-spacing: 0.4px;
        }


        /* =====================================================
           NAVIGATION
        ===================================================== */

        .navigation {
            display: flex;

            flex-direction: column;

            gap: 14px;

            flex-shrink: 0;
        }


        .nav-item {
            width: 100%;
            height: 54px;

            display: flex;

            align-items: center;

            gap: 18px;

            padding: 0 18px;

            border: 1px solid rgba(255, 255, 255, 0.9);

            border-radius: 6px;

            color: #ffffff;

            text-decoration: none;

            transition: 0.2s ease;

            background: transparent;
        }


        .nav-item:hover {
            background: var(--cream-active);

            border-color: var(--cream-active);

            color: var(--brown);
        }


        .nav-item.active {
            background: var(--cream-active);

            border-color: var(--cream-active);

            color: var(--brown);
        }


        .nav-icon {
            width: 22px;
            height: 22px;

            flex-shrink: 0;

            stroke-width: 2;
        }


        .nav-text {
            font-size: 14px;

            font-weight: 600;

            line-height: 1.1;
        }


        .nav-text small {
            display: block;

            margin-top: 3px;

            font-size: 9px;

            font-weight: 600;

            opacity: 0.9;
        }


        /* =====================================================
           BOTTOM DECORATION
        ===================================================== */

        .bakery-decoration {
            position: relative;

            margin-top: auto;

            width: 100%;

            height: 260px;

            flex-shrink: 0;

            pointer-events: none;

            overflow: visible;
        }


        /* =====================================================
           GAMBAR ROTI
        ===================================================== */

        .bakery-decoration .bakery-image {
            position: absolute;

            left: -20px;
            bottom: -35px;

            width: 220px;
            height: auto;

            pointer-events: none;

            z-index: 1;
        }


        /* =====================================================
           TEKS BAKERY
        ===================================================== */

        .bakery-copy {
            position: absolute;

            right: 5px;
            bottom: 95px;

            width: 125px;

            color: #ffffff;

            z-index: 5;

            text-align: left;

            overflow: visible;

            word-wrap: normal;
        }


        .bakery-copy h2 {
            font-family: "DM Serif Display", serif;

            font-size: 23px;

            font-weight: 400;

            line-height: 1.15;

            margin-bottom: 6px;

            letter-spacing: 0.5px;

            white-space: nowrap;

            text-shadow:
                0 1px 3px rgba(0, 0, 0, 0.35);
        }


        .bakery-copy p {
            font-size: 11px;

            line-height: 1.4;

            color: rgba(255, 255, 255, 0.95);

            text-shadow:
                0 1px 3px rgba(0, 0, 0, 0.35);
        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .main {
            min-height: 100vh;

            margin-left: var(--sidebar-width);

            background: var(--cream);
        }


        .content {
            min-height: 100vh;

            padding: 92px 36px 36px 36px;
        }


        /* =====================================================
           GLOBAL LOGOUT STYLE (HANYA UNTUK LOGOUT)
        ===================================================== */

        .logout-btn,
        a.logout-btn,
        button.logout-btn,
        .content a[href*="logout"] {
            background: transparent !important;

            border: none !important;

            box-shadow: none !important;

            color: #3f3025 !important;

            text-decoration: none !important;

            padding: 0 !important;

            margin: 0 !important;

            cursor: pointer;

            font-family: inherit;

            font-size: inherit;

            outline: none;
        }


        .logout-btn:hover,
        a.logout-btn:hover,
        button.logout-btn:hover,
        .content a[href*="logout"]:hover {
            background: transparent !important;

            text-decoration: underline !important;
        }


        /* =====================================================
           MOBILE HEADER
        ===================================================== */

        .mobile-header {
            display: none;

            position: fixed;

            top: 0;
            left: 0;

            width: 100%;
            height: 60px;

            background: var(--brown);

            z-index: 1300;

            align-items: center;

            justify-content: space-between;

            padding: 0 18px;
        }


        .mobile-brand {
            display: flex;

            align-items: center;

            gap: 10px;

            color: white;
        }


        .mobile-logo {
            width: 34px;
            height: 34px;

            background: transparent;

            display: flex;

            align-items: center;
            justify-content: center;

            overflow: hidden;
        }


        .mobile-logo img {
            width: 100%;
            height: 100%;

            object-fit: contain;
        }


        .mobile-brand-text strong {
            display: block;

            font-family: "Ginzel", serif;

            font-size: 13px;

            font-weight: 600;

            letter-spacing: 1px;
        }


        .mobile-brand-text span {
            display: block;

            font-size: 9px;

            opacity: 0.85;
        }


        .mobile-menu-button {
            border: none;

            background: transparent;

            color: white;

            cursor: pointer;

            padding: 4px;
        }


        .mobile-menu-button i {
            width: 22px;
            height: 22px;
        }


        /* =====================================================
           OVERLAY MOBILE
        ===================================================== */

        .sidebar-overlay {
            display: none;

            position: fixed;

            inset: 0;

            background: rgba(0, 0, 0, 0.35);

            z-index: 900;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 900px) {

            :root {
                --sidebar-width: 246px;
            }


            .sidebar {
                padding: 68px 14px 18px;
            }


            .brand {
                gap: 12px;

                margin-bottom: 22px;
            }


            .brand-logo {
                width: 60px;
                height: 60px;
            }


            .brand-name {
                font-size: 15px;
            }


            .brand-subtitle {
                font-size: 10px;
            }


            .navigation {
                gap: 12px;
            }


            .nav-item {
                height: 50px;

                gap: 15px;

                padding: 0 15px;
            }


            .nav-icon {
                width: 20px;
                height: 20px;
            }


            .nav-text {
                font-size: 13px;
            }


            .bakery-decoration {
                height: 230px;
            }


            .bakery-decoration .bakery-image {
                left: -20px;

                bottom: -12px;

                width: 190px;
            }


            .bakery-copy {
                right: 3px;

                bottom: 85px;

                width: 120px;
            }


            .bakery-copy h2 {
                font-size: 22px;
            }


            .bakery-copy p {
                font-size: 10px;
            }


            .content {
                padding: 86px 26px 26px 26px;
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 700px) {

            .top-renda {
                display: none;
            }


            .mobile-header {
                display: flex;
            }


            .sidebar {
                left: -290px;

                width: 268px;

                padding-top: 78px;

                transition: left 0.3s ease;
            }


            .sidebar.open {
                left: 0;
            }


            .sidebar-overlay.active {
                display: block;
            }


            .main {
                margin-left: 0;

                padding-top: 60px;
            }


            .content {
                min-height: calc(100vh - 60px);

                padding: 22px 20px 26px 20px;
            }

        }


        /* =====================================================
           SMALL MOBILE
        ===================================================== */

        @media (max-width: 400px) {

            .sidebar {
                width: 250px;

                left: -270px;
            }


            .bakery-decoration {
                height: 210px;
            }


            .bakery-decoration .bakery-image {
                width: 170px;
            }


            .bakery-copy {
                right: 3px;

                bottom: 78px;

                width: 112px;
            }


            .bakery-copy h2 {
                font-size: 20px;
            }


            .bakery-copy p {
                font-size: 9px;
            }


            .content {
                padding: 18px 16px 22px 16px;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         RENDA ATAS
    ====================================================== -->

    <div class="top-renda">

        <img
            src="{{ asset('images/renda.png') }}"
            alt="Renda coklat putih"
        >

    </div>



    <!-- =====================================================
         MOBILE HEADER
    ====================================================== -->

    <header class="mobile-header">

        <div class="mobile-brand">

            <div class="mobile-logo">

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="ROTIÉRA"
                >

            </div>


            <div class="mobile-brand-text">

                <strong>
                    ROTIÉRA
                </strong>

                <span>
                    Bakery Store
                </span>

            </div>

        </div>


        <button
            type="button"
            class="mobile-menu-button"
            onclick="toggleSidebar()"
        >

            <i data-lucide="menu"></i>

        </button>

    </header>



    <!-- =====================================================
         OVERLAY
    ====================================================== -->

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        onclick="toggleSidebar()"
    ></div>



    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <aside
        class="sidebar"
        id="sidebar"
    >


        <!-- BRAND -->

        <div class="brand">

            <div class="brand-logo">

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Logo ROTIÉRA"
                >

            </div>


            <div class="brand-info">

                <div class="brand-name">
                    ROTIÉRA
                </div>

                <div class="brand-subtitle">
                    Bakery Store
                </div>

            </div>

        </div>



        <!-- NAVIGATION -->

        <nav class="navigation">


            <!-- Dashboard -->

            <a
                href="{{ route('dashboard') }}"
                class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >

                <i
                    data-lucide="house"
                    class="nav-icon"
                ></i>

                <span class="nav-text">
                    Dashboard
                </span>

            </a>



            <!-- Produk -->

            <a
                href="{{ route('produk.index') }}"
                class="nav-item {{ request()->routeIs('produk.*') ? 'active' : '' }}"
            >

                <i
                    data-lucide="box"
                    class="nav-icon"
                ></i>

                <span class="nav-text">
                    Produk
                </span>

            </a>



            <!-- Penjualan -->

            <a
                href="{{ route('penjualan.index') }}"
                class="nav-item {{ request()->routeIs('penjualan.*') ? 'active' : '' }}"
            >

                <i
                    data-lucide="receipt-text"
                    class="nav-icon"
                ></i>

                <span class="nav-text">

                    Penjualan

                    <small>
                        (Kurangi Stok)
                    </small>

                </span>

            </a>



            <!-- Pemasukan Barang -->

            <a
                href="{{ route('pemasukan_barang.index') }}"
                class="nav-item {{ request()->routeIs('pemasukan_barang.*') ? 'active' : '' }}"
            >

                <i
                    data-lucide="package-plus"
                    class="nav-icon"
                ></i>

                <span class="nav-text">
                    Pemasukan Barang
                </span>

            </a>



            <!-- Kerugian -->

            <a
                href="{{ route('kerugian.index') }}"
                class="nav-item {{ request()->routeIs('kerugian.*') ? 'active' : '' }}"
            >

                <i
                    data-lucide="alert-triangle"
                    class="nav-icon"
                ></i>

                <span class="nav-text">
                    Kerugian
                </span>

            </a>



            <!-- Laporan Laba -->

            <a
                href="#"
                class="nav-item {{ request()->is('laporan*') ? 'active' : '' }}"
            >

                <i
                    data-lucide="chart-column"
                    class="nav-icon"
                ></i>

                <span class="nav-text">
                    Laporan Laba
                </span>

            </a>



            <!-- Riwayat -->

            <a
                href="{{ route('riwayat_transaksi.index') }}"
                class="nav-item {{ request()->routeIs('riwayat_transaksi.*') ? 'active' : '' }}"
            >

                <i
                    data-lucide="history"
                    class="nav-icon"
                ></i>

                <span class="nav-text">
                    Riwayat Transaksi
                </span>

            </a>



            <!-- Pengaturan -->

            <a
                href="#"
                class="nav-item {{ request()->is('pengaturan*') ? 'active' : '' }}"
            >

                <i
                    data-lucide="settings"
                    class="nav-icon"
                ></i>

                <span class="nav-text">
                    Pengaturan
                </span>

            </a>

        </nav>



        <!-- =================================================
             BOTTOM BAKERY
        ================================================== -->

        <div class="bakery-decoration">

            <!-- Gambar roti -->

            <img
                src="{{ asset('images/roti.png') }}"
                alt="Aneka roti"
                class="bakery-image"
            >


            <!-- Tulisan -->

            <div class="bakery-copy">

                <h2>
                    Make ur day<br>
                    sweeter
                </h2>

                <p>
                    freshly baked<br>
                    just for you
                </p>

            </div>

        </div>


    </aside>



    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->

    <main class="main">

        <section class="content">

            @yield('content')

        </section>

    </main>



    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        // Lucide Icons
        lucide.createIcons();


        // Toggle Sidebar
        function toggleSidebar() {

            const sidebar =
                document.getElementById("sidebar");

            const overlay =
                document.getElementById("sidebarOverlay");


            sidebar.classList.toggle("open");

            overlay.classList.toggle("active");

        }


        // Tutup sidebar ketika menu dipilih di mobile
        document
            .querySelectorAll(".nav-item")
            .forEach(function(item) {

                item.addEventListener("click", function() {

                    if (window.innerWidth <= 700) {

                        document
                            .getElementById("sidebar")
                            .classList.remove("open");

                        document
                            .getElementById("sidebarOverlay")
                            .classList.remove("active");

                    }

                });

            });

    </script>


</body>

</html>
