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
    <aside class="w-64 bg-white shadow-md min-h-screen relative">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-green-600">Basreng & Dessert</h2>
        </div>

        <nav class="mt-6">
            <!-- Dashboard -->
            <a href="{{ route('admin.index') }}" 
               class="block px-6 py-3 hover:bg-green-100 rounded transition duration-200">
                Dashboard
            </a>

            <!-- Produk -->
            <a href="{{ route('admin.products.index') }}" 
               class="block px-6 py-3 hover:bg-green-100 rounded transition duration-200">
                Produk
            </a>

            <!-- Pesanan -->
            <a href="{{ route('admin.orders.index') }}" 
               class="block px-6 py-3 hover:bg-green-100 rounded transition duration-200">
                Pesanan
            </a>

            <!-- Laporan (belum ada route-nya, nanti bisa ditambah) -->
            <a href="#" 
               class="block px-6 py-3 hover:bg-green-100 rounded transition duration-200">
                Laporan
            </a>
        </nav>

        <!-- Tombol Logout -->
        <div class="absolute bottom-0 w-64 p-6 border-t border-gray-200">
            <a href="{{ route('logout') }}" 
               class="block text-red-500 hover:underline">Logout</a>
        </div>
    </aside>

    <!-- Konten utama -->
    <main class="flex-1 p-6 bg-gray-100">
        @yield('content')
    </main>

</body>
</html>
