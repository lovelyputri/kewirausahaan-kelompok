<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Aplikasi Kasir</h1>

            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">
                    Halo, <strong>{{ Auth::user()->nama }}</strong>
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1.5 rounded-lg transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang! 🎉</h2>
            <p class="text-gray-600">Login berhasil sebagai <strong>{{ Auth::user()->nama }}</strong></p>
        </div>
    </div>

</body>
</html>
