<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Kasir')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="w-56 bg-gray-800 text-white flex flex-col">

            {{-- Logo --}}
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-lg font-bold">Congek Bakes</h1>
                <p class="text-xs text-gray-400">Bakery Store</p>
            </div>

            {{-- Menu --}}
            <nav class="flex-1 p-2">

                <a href="{{ route('dashboard') }}"
                   class="block px-3 py-2 rounded mb-1 text-sm
                          {{ request()->routeIs('dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                    🏠 Dashboard
                </a>

                <a href="{{ route('produk.index') }}"
                   class="block px-3 py-2 rounded mb-1 text-sm
                          {{ request()->routeIs('produk.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                    📦 Produk
                </a>

            </nav>

        </aside>

        {{-- KONTEN UTAMA --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

</body>
</html>
