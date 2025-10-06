@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="p-6 space-y-6 bg-gray-50">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
        <h1 class="text-3xl font-extrabold text-green-600 mb-4 md:mb-0">
            Selamat datang, Admin!
        </h1>
        <p class="text-gray-600">Pantau semua produk, kategori, dan pesanan dari dashboard ini.</p>
    </div>

    <!-- Statistik Cepat -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Produk -->
        <div class="bg-white shadow-xl rounded-lg p-6 flex items-center space-x-4 hover:scale-105 transform transition duration-300">
            <div class="p-4 bg-green-200 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Total Produk</h2>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ \App\Models\Product::count() ?? 0 }}</p>
            </div>
        </div>

        <!-- Total Pesanan -->
        <div class="bg-white shadow-xl rounded-lg p-6 flex items-center space-x-4 hover:scale-105 transform transition duration-300">
            <div class="p-4 bg-yellow-200 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18M3 18h18"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Total Pesanan</h2>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ \App\Models\Order::count() ?? 0 }}</p>
            </div>
        </div>

        <!-- Pendapatan -->
        <div class="bg-white shadow-xl rounded-lg p-6 flex items-center space-x-4 hover:scale-105 transform transition duration-300">
            <div class="p-4 bg-pink-200 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.333 0-2.667.667-3.333 1.333S7 11 7 12s.667 2.667 1.333 3.333S10.667 17 12 17s2.667-.667 3.333-1.333S17 13 17 12s-.667-2.667-1.333-3.333S13.333 8 12 8z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Pendapatan</h2>
                <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format(\App\Models\Order::sum('total_price') ?? 0,0,',','.') }}</p>
            </div>
        </div>
    </div>

    <!-- Tips / Notifikasi (opsional) -->
    <div class="mt-6 bg-blue-50 text-blue-700 p-4 rounded-lg shadow">
        <p class="font-medium">Tips:</p>
        <p class="text-sm mt-1">Pastikan produk terbaru selalu diperbarui agar pelanggan tertarik dan pesanan meningkat!</p>
    </div>

</div>
@endsection
