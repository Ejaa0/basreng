<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-gray-100 text-gray-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md min-h-screen">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-green-600">Basreng & Dessert</h2>
        </div>

        <nav class="mt-6">
            <a href="{{ route('admin.index') }}" class="block px-6 py-3 hover:bg-green-100 rounded transition duration-200">
                Dashboard
            </a>
            <a href="{{ route('products.index') }}" class="block px-6 py-3 hover:bg-green-100 rounded transition duration-200">
                Produk
            </a>
            <a href="{{ route('categories.index') }}" class="block px-6 py-3 hover:bg-green-100 rounded transition duration-200">
                Kategori
            </a>
            <a href="{{ route('orders.index') }}" class="block px-6 py-3 hover:bg-green-100 rounded transition duration-200">
                Pesanan
            </a>
            <a href="#" class="block px-6 py-3 hover:bg-green-100 rounded transition duration-200">
                Laporan
            </a>
        </nav>

        <div class="absolute bottom-0 w-64 p-6 border-t border-gray-200">
            <a href="#" class="block text-red-500 hover:underline">Logout</a>
        </div>
    </aside>

    <!-- Konten utama -->
    <main class="flex-1 p-6 bg-gray-100">
        @yield('content')
    </main>

</body>
</html>
