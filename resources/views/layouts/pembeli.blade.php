<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Basreng & Dessert')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Enable dark mode class strategy
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <h1 class="text-2xl font-bold text-green-600">
                Hot n’ Sweet x BasrengBae

            </h1>

            <!-- Menu Navigasi -->
            <nav class="space-x-4 text-sm md:text-base">
                <a href="{{ route('pembeli.index') }}"
                    class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-500 font-medium transition">
                    Beranda
                </a>

                <a href="{{ route('pembeli.orders') }}"
                    class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-500 font-medium transition">
                    Pesanan Saya
                </a>

                <a href="{{ route('pembeli.kontak') }}"
                    class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-500 font-medium transition">
                    Kontak
                </a>

                <!-- Tombol Dark Mode Toggle -->
                <button id="darkToggle"
                    class="ml-2 px-2 py-1 rounded border border-gray-400 dark:border-gray-600 text-sm">
                    Dark Mode
                </button>
            </nav>
        </div>
    </header>

    <!-- Konten utama -->
    <main class="flex-grow max-w-7xl mx-auto px-6 py-6 w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 shadow-inner mt-12">
        <div class="max-w-7xl mx-auto px-6 py-4 text-center text-gray-600 dark:text-gray-400 text-sm">
            &copy; {{ date('Y') }}
            <span class="font-semibold text-green-600 dark:text-green-500">Basreng & Dessert</span>.
            All Rights Reserved.
        </div>
    </footer>

    <script>
        // Toggle Dark Mode
        const darkToggle = document.getElementById('darkToggle');
        darkToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            // Simpan preferensi di localStorage
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });

        // Set dark mode otomatis berdasarkan localStorage
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>

</html>
