<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Basreng & Dessert')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-green-600">Basreng & Dessert</h1>
            <nav class="space-x-4">
                <a href="{{ route('pembeli.index') }}" class="text-gray-700 hover:text-green-600 transition">Beranda</a>
                <a href="#" class="text-gray-700 hover:text-green-600 transition">Kategori</a>
                <a href="#" class="text-gray-700 hover:text-green-600 transition">Pesanan Saya</a>
                <a href="#" class="text-gray-700 hover:text-green-600 transition">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Konten utama -->
    <main class="max-w-7xl mx-auto px-6 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner mt-12">
        <div class="max-w-7xl mx-auto px-6 py-4 text-center text-gray-600">
            &copy; {{ date('Y') }} Basreng & Dessert. All Rights Reserved.
        </div>
    </footer>

</body>
</html>
