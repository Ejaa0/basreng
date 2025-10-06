@extends('layouts.pembeli')

@section('title', 'Beranda Toko Basreng & Dessert')

@section('content')
<h2 class="text-3xl font-bold text-green-600 mb-6">Produk Terbaru</h2>

@if($products->isEmpty())
    <p class="text-gray-500">Belum ada produk tersedia.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white shadow rounded-lg overflow-hidden hover:scale-105 transform transition duration-200">
                <!-- Gambar Produk -->
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                        Tidak ada gambar
                    </div>
                @endif

                <!-- Detail Produk -->
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800">{{ $product->name }}</h3>
                    <p class="text-green-600 font-bold mt-2">Rp {{ number_format($product->price,0,',','.') }}</p>
                    <p class="text-gray-600 mt-1">Stok: {{ $product->stock }}</p>

                    <!-- Tombol Beli -->
                    <button class="mt-4 w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition duration-200">
                        Beli
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
