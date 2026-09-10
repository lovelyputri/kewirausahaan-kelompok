<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Kasir</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'DM Sans', sans-serif;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        body {
            overflow: hidden;
        }

        /* =========================
           PAGE ANIMATION
        ========================= */

        .login-image {
            animation: pageLeft .9s cubic-bezier(.22, 1, .36, 1) both;
        }

        .login-content {
            animation: pageRight .9s cubic-bezier(.22, 1, .36, 1) both;
        }

        /* =========================
           LOGO
        ========================= */

        .logo-animation {
            animation: logoIn .8s cubic-bezier(.22, 1, .36, 1) .15s both;
        }

        /* =========================
           IMAGE
        ========================= */

        .display-animation {
            animation: displayIn 1s cubic-bezier(.22, 1, .36, 1) .3s both;
        }

        .bakery-image {
            animation: imageZoom 13s ease-in-out infinite alternate;
        }

        .image-shine {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .image-shine::after {
            content: "";
            position: absolute;
            top: 0;
            left: -120%;
            width: 45%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, .18),
                transparent
            );
            transform: skewX(-18deg);
            animation: shine 8s ease-in-out 2s infinite;
        }

        /* =========================
           TEXT
        ========================= */

        .welcome-animation {
            animation: textIn .7s ease-out .65s both;
        }

        .title-animation {
            animation: textIn .7s ease-out .78s both;
        }

        .description-animation {
            animation: textIn .7s ease-out .9s both;
        }

        /* =========================
           BAKERY DECOR
        ========================= */

        .bakery-decor {
            position: absolute;
            color: #e8c39f;
            opacity: .17;
            pointer-events: none;
            animation: bakeryFloat 6s ease-in-out infinite;
        }

        .right-motif {
            position: absolute;
            color: #9a7659;
            opacity: .055;
            pointer-events: none;
            animation: bakeryFloat 8s ease-in-out infinite;
        }

        /* =========================
           FORM
        ========================= */

        .form-card {
            background: rgba(255, 255, 255, .72);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(139, 94, 60, .08);
            box-shadow: 0 25px 70px rgba(91, 57, 38, .07);
            animation: formIn .8s cubic-bezier(.22, 1, .36, 1) .25s both;
        }

        .input-box {
            transition:
                border-color .25s ease,
                box-shadow .25s ease,
                transform .25s ease;
        }

        .input-box:focus-within {
            border-color: #8b5e3c;
            box-shadow:
                0 0 0 4px rgba(139, 94, 60, .08),
                0 8px 20px rgba(111, 73, 48, .04);
            transform: translateY(-1px);
        }

        .login-button {
            position: relative;
            overflow: hidden;
            transition:
                transform .25s ease,
                box-shadow .25s ease,
                background-color .25s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(91, 57, 38, .18);
            background-color: #70492f;
        }

        .login-button::after {
            content: "";
            position: absolute;
            top: 0;
            left: -120%;
            width: 45%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, .15),
                transparent
            );
            transform: skewX(-18deg);
        }

        .login-button:hover::after {
            animation: buttonShine .8s ease;
        }

        /* =========================
           KEYFRAMES
        ========================= */

        @keyframes pageLeft {
            from {
                opacity: 0;
                transform: translateX(-35px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pageRight {
            from {
                opacity: 0;
                transform: translateX(35px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes logoIn {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes displayIn {
            from {
                opacity: 0;
                transform: translateY(35px) scale(.97);
                filter: blur(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        @keyframes imageZoom {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.055);
            }
        }

        @keyframes shine {
            0% {
                left: -120%;
            }

            20% {
                left: 140%;
            }

            100% {
                left: 140%;
            }
        }

        @keyframes textIn {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bakeryFloat {
            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-8px) rotate(2deg);
            }
        }

        @keyframes formIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes buttonShine {
            from {
                left: -120%;
            }

            to {
                left: 140%;
            }
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 767px) {
            body {
                overflow: auto;
            }
        }
    </style>
</head>

<body class="bg-[#f8f3ed]">

    <main class="min-h-screen w-full flex">

        <!-- =====================================================
             LEFT SIDE
        ====================================================== -->

        <section
            class="login-image hidden md:flex md:w-[52%] lg:w-[55%] min-h-screen bg-[#5b3926] relative overflow-hidden">

            <!-- BACKGROUND -->

            <div class="absolute inset-0 bg-[#5b3926]"></div>

            <div
                class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-[#8b5e3c] opacity-20 blur-3xl">
            </div>

            <div
                class="absolute -bottom-40 -right-20 w-[500px] h-[500px] rounded-full bg-[#d19a6a] opacity-10 blur-3xl">
            </div>


            <!-- BREAD TOP RIGHT -->

            <svg
                class="bakery-decor top-8 right-10 w-20 h-20"
                viewBox="0 0 100 100"
                fill="none">

                <path
                    d="M20 60C20 42 34 29 50 29C66 29 80 42 80 60V68C80 73 76 77 71 77H29C24 77 20 73 20 68V60Z"
                    stroke="currentColor"
                    stroke-width="2.5" />

                <path
                    d="M34 48C36 43 40 40 45 39"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

                <path
                    d="M51 43C54 38 58 36 63 36"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

            </svg>


            <!-- WHEAT TOP LEFT -->

            <svg
                class="bakery-decor top-28 left-7 w-16 h-16"
                viewBox="0 0 100 100"
                fill="none"
                style="animation-delay:1s">

                <path
                    d="M50 82C50 82 49 52 50 22"
                    stroke="currentColor"
                    stroke-width="2.5"
                    stroke-linecap="round" />

                <path
                    d="M49 35C38 30 32 23 31 17"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

                <path
                    d="M50 45C61 40 67 33 68 27"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

                <path
                    d="M50 57C39 52 34 46 33 40"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

                <path
                    d="M50 67C61 62 66 55 67 49"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

            </svg>


            <!-- CROISSANT BOTTOM RIGHT -->

            <svg
                class="bakery-decor bottom-20 right-8 w-24 h-24"
                viewBox="0 0 120 100"
                fill="none"
                style="animation-delay:2s">

                <path
                    d="M18 63C24 35 45 20 60 20C75 20 96 35 102 63C88 73 32 73 18 63Z"
                    stroke="currentColor"
                    stroke-width="2.5" />

                <path
                    d="M38 33C32 44 31 55 35 65"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

                <path
                    d="M57 25C52 39 52 53 57 68"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

                <path
                    d="M76 32C82 43 84 55 81 65"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

            </svg>


            <!-- CAKE BOTTOM LEFT -->

            <svg
                class="bakery-decor bottom-10 left-8 w-20 h-20"
                viewBox="0 0 100 100"
                fill="none"
                style="animation-delay:3s">

                <path
                    d="M22 45H78V70C78 75 74 79 69 79H31C26 79 22 75 22 70V45Z"
                    stroke="currentColor"
                    stroke-width="2.5" />

                <path
                    d="M22 45C22 38 30 34 38 34C46 34 54 38 50 45"
                    stroke="currentColor"
                    stroke-width="2.5" />

                <path
                    d="M50 45C50 38 58 34 66 34C74 34 80 38 78 45"
                    stroke="currentColor"
                    stroke-width="2.5" />

                <path
                    d="M36 53V67"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

                <path
                    d="M64 53V67"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round" />

            </svg>


            <!-- DOTS -->

            <div
                class="absolute top-[24%] right-[18%] w-2 h-2 rounded-full bg-[#e8c39f] opacity-20">
            </div>

            <div
                class="absolute bottom-[28%] left-[17%] w-1.5 h-1.5 rounded-full bg-[#e8c39f] opacity-20">
            </div>

            <div
                class="absolute top-[38%] left-[10%] w-1 h-1 rounded-full bg-[#e8c39f] opacity-20">
            </div>


            <!-- =================================================
                 LEFT CONTENT
            ================================================== -->

            <div
                class="relative z-10 w-full h-full flex flex-col px-9 py-8 lg:px-12 lg:py-10 xl:px-14 xl:py-11">

                <!-- LOGO -->

                <div class="logo-animation flex items-center gap-3 mb-14">

                    <div
                        class="w-11 h-11 rounded-2xl bg-[#f4dfc9] flex items-center justify-center shadow-lg shadow-black/10">

                        <svg
                            class="w-6 h-6 text-[#6f4930]"
                            viewBox="0 0 24 24"
                            fill="none">

                            <path
                                d="M5 10C5 6.7 7.7 4 11 4C14.3 4 17 6.7 17 10V17C17 18.1 16.1 19 15 19H7C5.9 19 5 18.1 5 17V10Z"
                                stroke="currentColor"
                                stroke-width="1.8" />

                            <path
                                d="M8 9C8.8 7.5 9.7 7 11 7"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round" />

                            <path
                                d="M13 8C14 7.5 14.7 7.8 15.5 8.7"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round" />

                        </svg>

                    </div>

                    <div>

                        <p class="text-[#f4dfc9] text-xl font-bold tracking-wide">
                            Toko Roti
                        </p>

                        <p class="text-[#d9b99a] text-[11px] uppercase tracking-[.25em]">
                            Kasir & Inventory
                        </p>

                    </div>

                </div>


                <!-- =================================================
                     MAIN CONTENT
                     DITURUNKAN DENGAN mt-10
                ================================================== -->

                <div class="w-full max-w-xl mt-10">

                    <!-- IMAGE -->

                    <div
                        class="display-animation relative h-56 lg:h-64 xl:h-68 rounded-[27px] overflow-hidden mb-10 shadow-2xl shadow-black/20">

                        <img
                            src="{{ asset('images/bakery-display.jpg') }}"
                            alt="Etalase bakery"
                            class="bakery-image w-full h-full object-cover">

                        <!-- OVERLAY -->

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-[#3d2417]/65 via-transparent to-transparent">
                        </div>

                        <!-- SHINE -->

                        <div class="image-shine"></div>

                        <!-- LABEL -->

                        <div
                            class="absolute left-5 bottom-5 px-4 py-2 rounded-xl bg-black/20 backdrop-blur-md border border-white/10">

                            <p
                                class="text-white text-[10px] uppercase tracking-[.25em] font-semibold">
                                Fresh Everyday
                            </p>

                        </div>

                    </div>


                    <!-- WELCOME -->

                    <div class="welcome-animation mb-3">

                        <p
                            class="text-[#d9b99a] text-xs font-semibold uppercase tracking-[.32em]">

                            Selamat datang

                        </p>

                    </div>


                    <!-- TITLE -->

                    <h1
                        class="title-animation font-display text-white text-4xl lg:text-5xl xl:text-[52px] leading-[1.05] font-semibold max-w-lg">

                        Kelola toko roti
                        <span class="text-[#e8c39f]">
                            lebih mudah.
                        </span>

                    </h1>


                    <!-- DESCRIPTION -->

                    <p
                        class="description-animation mt-5 text-[#d6bda7] text-sm lg:text-[15px] leading-7 max-w-md">

                        Kelola stok, penjualan, dan keuntungan toko
                        dalam satu sistem yang sederhana dan praktis.

                    </p>

                </div>


                <!-- FOOTER -->

                <div class="mt-auto pt-6">

                    <div
                        class="w-12 h-[1px] bg-[#d9b99a]/40 mb-3">
                    </div>

                    <p
                        class="text-[#b99578] text-[10px] uppercase tracking-[.3em]">

                        Sistem Kasir & Inventory

                    </p>

                </div>

            </div>

        </section>


        <!-- =====================================================
             RIGHT SIDE : LOGIN
        ====================================================== -->

        <section
            class="login-content w-full md:w-[48%] lg:w-[45%] min-h-screen bg-[#f8f3ed] flex items-center justify-center relative overflow-hidden">

            <!-- BACKGROUND -->

            <div
                class="absolute -top-40 -right-40 w-[420px] h-[420px] rounded-full bg-[#ead7c3] opacity-40 blur-3xl">
            </div>

            <div
                class="absolute -bottom-44 -left-40 w-[450px] h-[450px] rounded-full bg-[#dfc3a7] opacity-20 blur-3xl">
            </div>


            <!-- WHEAT -->

            <svg
                class="right-motif top-12 right-12 w-28 h-28"
                viewBox="0 0 100 100"
                fill="none">

                <path
                    d="M50 88C50 88 49 54 50 18"
                    stroke="currentColor"
                    stroke-width="2" />

                <path
                    d="M50 32C39 28 33 22 32 16"
                    stroke="currentColor"
                    stroke-width="2" />

                <path
                    d="M50 43C61 38 67 32 68 26"
                    stroke="currentColor"
                    stroke-width="2" />

                <path
                    d="M50 55C40 51 34 45 33 39"
                    stroke="currentColor"
                    stroke-width="2" />

                <path
                    d="M50 67C61 62 66 56 67 50"
                    stroke="currentColor"
                    stroke-width="2" />

            </svg>


            <!-- CROISSANT -->

            <svg
                class="right-motif top-24 left-8 w-20 h-20"
                viewBox="0 0 100 80"
                fill="none"
                style="animation-delay:2s">

                <path
                    d="M12 52C18 29 35 18 50 18C65 18 82 29 88 52C73 61 27 61 12 52Z"
                    stroke="currentColor"
                    stroke-width="2" />

                <path
                    d="M30 28C26 37 26 45 29 52"
                    stroke="currentColor"
                    stroke-width="1.7" />

                <path
                    d="M49 21C45 31 45 43 49 54"
                    stroke="currentColor"
                    stroke-width="1.7" />

                <path
                    d="M68 28C73 37 73 45 70 52"
                    stroke="currentColor"
                    stroke-width="1.7" />

            </svg>


            <!-- BREAD -->

            <svg
                class="right-motif bottom-12 right-10 w-24 h-24"
                viewBox="0 0 100 100"
                fill="none"
                style="animation-delay:4s">

                <path
                    d="M18 61C18 42 32 29 50 29C68 29 82 42 82 61V69C82 74 78 78 73 78H27C22 78 18 74 18 69V61Z"
                    stroke="currentColor"
                    stroke-width="2" />

                <path
                    d="M34 48C36 43 40 40 45 39"
                    stroke="currentColor"
                    stroke-width="1.8" />

                <path
                    d="M52 44C55 39 59 37 64 37"
                    stroke="currentColor"
                    stroke-width="1.8" />

            </svg>


            <!-- DOTS -->

            <div
                class="absolute top-[20%] right-[23%] w-2 h-2 rounded-full bg-[#8b5e3c]/10">
            </div>

            <div
                class="absolute bottom-[22%] left-[20%] w-1.5 h-1.5 rounded-full bg-[#8b5e3c]/10">
            </div>


            <!-- =================================================
                 FORM
            ================================================== -->

            <div class="relative z-10 w-full max-w-md px-6 sm:px-8">

                <div
                    class="form-card rounded-[28px] px-7 py-8 sm:px-9 sm:py-9">

                    <!-- MOBILE LOGO -->

                    <div class="flex md:hidden items-center gap-3 mb-8">

                        <div
                            class="w-10 h-10 rounded-xl bg-[#6f4930] flex items-center justify-center">

                            <svg
                                class="w-5 h-5 text-[#f4dfc9]"
                                viewBox="0 0 24 24"
                                fill="none">

                                <path
                                    d="M5 10C5 6.7 7.7 4 11 4C14.3 4 17 6.7 17 10V17C17 18.1 16.1 19 15 19H7C5.9 19 5 18.1 5 17V10Z"
                                    stroke="currentColor"
                                    stroke-width="1.8" />

                            </svg>

                        </div>

                        <div>

                            <p class="font-bold text-[#5b3926]">
                                Toko Roti
                            </p>

                            <p
                                class="text-[10px] uppercase tracking-[.2em] text-[#9a7659]">
                                Kasir & Inventory
                            </p>

                        </div>

                    </div>


                    <!-- HEADING -->

                    <div class="mb-8">

                        <div class="flex items-center gap-3 mb-3">

                            <div class="w-8 h-[2px] bg-[#8b5e3c]"></div>

                            <span
                                class="text-[#9a7659] text-[10px] font-bold uppercase tracking-[.25em]">

                                Login

                            </span>

                        </div>


                        <h2
                            class="font-display text-[#5b3926] text-3xl sm:text-[34px] font-semibold leading-tight">

                            Selamat datang
                            <br>

                            <span class="text-[#8b5e3c]">
                                kembali.
                            </span>

                        </h2>


                        <p class="mt-3 text-sm text-[#8d7b6c] leading-6">

                            Masuk untuk mengelola toko dan melihat
                            aktivitas kasir hari ini.

                        </p>

                    </div>


                    <!-- ERROR -->

                    @if ($errors->any())

                        <div
                            class="mb-5 rounded-xl bg-red-50 border border-red-100 px-4 py-3">

                            <ul class="text-xs text-red-600 space-y-1">

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <!-- FORM -->

                    <form
                        action="{{ route('login') }}"
                        method="POST"
                        class="space-y-5">

                        @csrf


                        <!-- EMAIL -->

                        <div>

                            <label
                                for="email"
                                class="block text-xs font-semibold text-[#6f4930] mb-2">

                                Email

                            </label>

                            <div
                                class="input-box flex items-center gap-3 bg-white/90 border border-[#eadfd4] rounded-2xl px-4 py-3.5">

                                <svg
                                    class="w-5 h-5 text-[#a48770] flex-shrink-0"
                                    viewBox="0 0 24 24"
                                    fill="none">

                                    <path
                                        d="M4 6.5C4 5.7 4.7 5 5.5 5H18.5C19.3 5 20 5.7 20 6.5V17.5C20 18.3 19.3 19 18.5 19H5.5C4.7 19 4 18.3 4 17.5V6.5Z"
                                        stroke="currentColor"
                                        stroke-width="1.7" />

                                    <path
                                        d="M5 7L12 12L19 7"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />

                                </svg>


                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    placeholder="Masukkan email"
                                    class="w-full bg-transparent outline-none text-sm text-[#5b3926] placeholder:text-[#b7a69a]">

                            </div>

                        </div>


                        <!-- PASSWORD -->

                        <div>

                            <label
                                for="password"
                                class="block text-xs font-semibold text-[#6f4930] mb-2">

                                Password

                            </label>

                            <div
                                class="input-box flex items-center gap-3 bg-white/90 border border-[#eadfd4] rounded-2xl px-4 py-3.5">

                                <svg
                                    class="w-5 h-5 text-[#a48770] flex-shrink-0"
                                    viewBox="0 0 24 24"
                                    fill="none">

                                    <rect
                                        x="5"
                                        y="10"
                                        width="14"
                                        height="10"
                                        rx="2"
                                        stroke="currentColor"
                                        stroke-width="1.7" />

                                    <path
                                        d="M8 10V7.5C8 5.57 9.57 4 11.5 4H12.5C14.43 4 16 5.57 16 7.5V10"
                                        stroke="currentColor"
                                        stroke-width="1.7" />

                                </svg>


                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    placeholder="Masukkan password"
                                    class="w-full bg-transparent outline-none text-sm text-[#5b3926] placeholder:text-[#b7a69a]">


                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="text-[#a48770] hover:text-[#6f4930] transition">

                                    <svg
                                        id="eyeIcon"
                                        class="w-5 h-5"
                                        viewBox="0 0 24 24"
                                        fill="none">

                                        <path
                                            d="M2.5 12C4.4 8.2 7.7 6 12 6C16.3 6 19.6 8.2 21.5 12C19.6 15.8 16.3 18 12 18C7.7 18 4.4 15.8 2.5 12Z"
                                            stroke="currentColor"
                                            stroke-width="1.7" />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="3"
                                            stroke="currentColor"
                                            stroke-width="1.7" />

                                    </svg>

                                </button>

                            </div>

                        </div>


                        <!-- REMEMBER -->

                        <div class="flex items-center justify-between pt-1">

                            <label
                                class="flex items-center gap-2 cursor-pointer">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="w-4 h-4 rounded border-[#d8c8ba] text-[#6f4930] focus:ring-[#8b5e3c]">

                                <span class="text-xs text-[#8d7b6c]">
                                    Ingat saya
                                </span>

                            </label>

                        </div>


                        <!-- LOGIN BUTTON -->

                        <button
                            type="submit"
                            class="login-button w-full rounded-2xl bg-[#6f4930] text-white font-semibold text-sm py-3.5 mt-2">

                            <span
                                class="relative z-10 flex items-center justify-center gap-2">

                                Masuk ke Dashboard

                                <svg
                                    class="w-4 h-4"
                                    viewBox="0 0 24 24"
                                    fill="none">

                                    <path
                                        d="M5 12H19"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round" />

                                    <path
                                        d="M13 6L19 12L13 18"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />

                                </svg>

                            </span>

                        </button>

                    </form>


                    <!-- FOOTER -->

                    <div class="mt-7 pt-5 border-t border-[#eadfd4]">

                        <div class="flex items-center justify-center gap-2">

                            <svg
                                class="w-4 h-4 text-[#b08a6c]"
                                viewBox="0 0 24 24"
                                fill="none">

                                <path
                                    d="M5 10C5 6.7 7.7 4 11 4C14.3 4 17 6.7 17 10V17C17 18.1 16.1 19 15 19H7C5.9 19 5 18.1 5 17V10Z"
                                    stroke="currentColor"
                                    stroke-width="1.5" />

                            </svg>

                            <span
                                class="text-[10px] uppercase tracking-[.25em] text-[#b08a6c]">

                                Sistem Kasir

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        function togglePassword() {

            const password = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (password.type === 'password') {

                password.type = 'text';

                icon.innerHTML = `
                    <path
                        d="M3 3L21 21"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                    />

                    <path
                        d="M10.6 6.2C11.05 6.07 11.52 6 12 6C16.3 6 19.6 8.2 21.5 12C20.82 13.37 19.92 14.5 18.85 15.4"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                    />

                    <path
                        d="M6.1 8.1C4.58 9.03 3.39 10.34 2.5 12C4.4 15.8 7.7 18 12 18C13.66 18 15.17 17.67 16.5 17.05"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                    />

                    <path
                        d="M9.88 9.88C9.32 10.44 9 11.2 9 12C9 13.66 10.34 15 12 15C12.8 15 13.56 14.68 14.12 14.12"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                    />
                `;

            } else {

                password.type = 'password';

                icon.innerHTML = `
                    <path
                        d="M2.5 12C4.4 8.2 7.7 6 12 6C16.3 6 19.6 8.2 21.5 12C19.6 15.8 16.3 18 12 18C7.7 18 4.4 15.8 2.5 12Z"
                        stroke="currentColor"
                        stroke-width="1.7"
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="3"
                        stroke="currentColor"
                        stroke-width="1.7"
                    />
                `;

            }
        }

    </script>

</body>

</html>
