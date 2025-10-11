@extends('layouts.pembeli')

@section('title', 'Beranda Toko Basreng & Dessert')

@section('content')
    <div class="p-6">
        <h2 class="text-4xl font-extrabold text-green-600 mb-8 text-center md:text-left">
            Produk Terbaru
        </h2>

        @if ($products->isEmpty())
            <p class="text-center text-gray-500 text-lg">Belum ada produk tersedia.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <div
                        class="bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transform hover:-translate-y-1 transition duration-300">

                        <!-- Gambar Produk -->
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-56 object-cover transition-transform duration-300 hover:scale-105">
                        @else
                            <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-400 text-lg">
                                Tidak ada gambar
                            </div>
                        @endif

                        <!-- Detail Produk -->
                        <div class="p-4 flex flex-col justify-between h-48">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-2 truncate">{{ $product->name }}</h3>
                                <p class="text-green-600 font-bold text-xl mb-1">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-gray-600 text-sm">Stok: {{ $product->stock }}</p>
                            </div>

                            <!-- Tombol Beli -->
                            <a href="{{ route('products.show', $product->id) }}"
                                class="mt-4 inline-block w-full text-center bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700 shadow-md hover:shadow-lg transition duration-300">
                                Lihat Detail / Beli
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
