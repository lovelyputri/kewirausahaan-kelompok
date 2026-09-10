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

            --sidebar-width: 320px;
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
            min-height: 70px;

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

            padding: 78px 15px 20px;

            z-index: 1000;

            overflow: hidden;
        }


        /* =====================================================
           BRAND
        ===================================================== */

        .brand {
            display: flex;

            align-items: center;

            gap: 18px;

            padding: 0 5px;

            margin-bottom: 22px;
        }


        .brand-logo {
            width: 100px;
            height: 100px;

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
        }


        /* 
         * DIUBAH: font-family ROTIÉRA memakai "Ginzel"
         */
        .brand-name {
            font-family: "Ginzel", serif;

            font-size: 20px;

            font-weight: 600;

            line-height: 1.2;

            margin-bottom: 3px;

            letter-spacing: 1px;
        }


        .brand-subtitle {
            font-family: "Inter", sans-serif;

            font-size: 13px;

            font-weight: 400;

            opacity: 0.85;

            letter-spacing: 0.5px;
        }


        /* =====================================================
           NAVIGATION
        ===================================================== */

        .navigation {
            display: flex;

            flex-direction: column;

            gap: 20px;
        }


        .nav-item {
            width: 100%;
            height: 59px;

            display: flex;

            align-items: center;

            gap: 25px;

            padding: 0 20px;

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
            width: 27px;
            height: 27px;

            flex-shrink: 0;

            stroke-width: 2;
        }


        .nav-text {
            font-size: 16px;

            font-weight: 600;

            line-height: 1.1;
        }


        .nav-text small {
            display: block;

            margin-top: 3px;

            font-size: 9px;

            font-weight: 600;
        }


        /* =====================================================
           BOTTOM DECORATION
        ===================================================== */

        .bakery-decoration {
            position: absolute;

            left: 0;
            bottom: 0;

            width: 100%;

            height: 280px;

            pointer-events: none;
        }


        .bakery-image {
            position: absolute;

            left: -10px;

            bottom: -20px;

            width: 250px;
            height: auto;

            object-fit: contain;

            z-index: 2;
        }


        .bakery-copy {
            position: absolute;

            left: 155px;
            bottom: 100px;

            width: 130px;

            color: #ffffff;

            z-index: 3;
        }


        .bakery-copy h2 {
            font-family: "DM Serif Display", serif;

            font-size: 22px;

            font-weight: 400;

            line-height: 1.15;

            margin-bottom: 6px;
        }


        .bakery-copy p {
            font-size: 9px;

            line-height: 1.4;

            color: rgba(255, 255, 255, 0.88);
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

            padding: 100px 40px 40px 40px;
        }


        /* =====================================================
           GLOBAL LOGOUT STYLE
        ===================================================== */

        .logout-btn,
        a.logout-btn,
        button.logout-btn,
        .content a[href*="logout"],
        .content button[type="submit"] {
            background: transparent !important;
            background-color: transparent !important;
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
        .content a[href*="logout"]:hover,
        .content button[type="submit"]:hover {
            background: transparent !important;
            background-color: transparent !important;
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
            height: 65px;

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
            width: 38px;
            height: 38px;

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


        /* 
         * DIUBAH: font ROTIÉRA di mobile juga memakai "Ginzel"
         */
        .mobile-brand-text strong {
            display: block;

            font-family: "Ginzel", serif;

            font-size: 14px;

            font-weight: 600;

            letter-spacing: 1px;
        }


        .mobile-brand-text span {
            display: block;

            font-size: 10px;

            opacity: 0.85;
        }


        .mobile-menu-button {
            border: none;

            background: transparent;

            color: white;

            cursor: pointer;
        }


        .mobile-menu-button i {
            width: 25px;
            height: 25px;
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
                --sidebar-width: 270px;
            }


            .brand {
                gap: 15px;

                margin-bottom: 20px;
            }


            .brand-logo {
                width: 80px;
                height: 80px;
            }


            .brand-name {
                font-size: 17px;
            }


            .brand-subtitle {
                font-size: 11px;
            }


            .nav-item {
                gap: 18px;
            }


            .bakery-image {
                left: -10px;

                bottom: -20px;

                width: 200px;
            }


            .bakery-copy {
                left: 130px;
                bottom: 90px;
            }


            .content {
                padding: 100px 25px 25px 25px;
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

                width: 280px;

                padding-top: 85px;

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

                padding-top: 65px;
            }


            .content {
                min-height: calc(100vh - 65px);

                padding: 20px;
            }

        }


        /* =====================================================
           SMALL MOBILE
        ===================================================== */

        @media (max-width: 400px) {

            .sidebar {
                width: 270px;
            }


            .content {
                padding: 15px;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         RENDA
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
                href="{{ url('/dashboard') }}"
                class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}"
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
                class="nav-item"
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
                href="#"
                class="nav-item"
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



            <!-- Laporan Laba -->

            <a
                href="#"
                class="nav-item"
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
                href="#"
                class="nav-item"
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
                class="nav-item"
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



        <!-- BOTTOM BAKERY -->

        <div class="bakery-decoration">

            <img
                src="{{ asset('images/roti.png') }}"
                alt="Aneka roti"
                class="bakery-image"
            >


            <div class="bakery-copy">

                <h2>
                    Make ur day<br>
                    sweeter
                </h2>

                <p>
                    freshly baked just for you
                </p>

            </div>

        </div>


    </aside>



    <!-- =====================================================
         MAIN
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

        lucide.createIcons();


        function toggleSidebar() {

            const sidebar =
                document.getElementById("sidebar");

            const overlay =
                document.getElementById("sidebarOverlay");


            sidebar.classList.toggle("open");

            overlay.classList.toggle("active");

        }


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