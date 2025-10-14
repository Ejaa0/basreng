@extends('layouts.pembeli')

@section('title', $product->name)

@section('content')
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-10">
        <div class="grid md:grid-cols-2">
            <!-- Gambar Produk -->
            <div class="bg-gray-100">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-[400px] object-cover">
                @else
                    <div class="flex items-center justify-center w-full h-[400px] bg-gray-200 text-gray-500">
                        Tidak ada gambar
                    </div>
                @endif
            </div>

            <!-- Detail Produk -->
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                <p class="text-green-600 text-2xl font-bold mb-2">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
                <p class="text-gray-600 mb-4">Stok tersedia: {{ $product->stock }}</p>

                <div class="border-t border-gray-200 my-4"></div>

                <h2 class="font-semibold text-gray-700 mb-2">Deskripsi Produk</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    {{ $product->description ?? 'Tidak ada deskripsi.' }}
                </p>

                <!-- Tombol Beli Sekarang -->
                <a href="{{ route('checkout.show', $product->id) }}"
                    class="block w-full text-center bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition duration-200">
                    🛒 Beli Sekarang
                </a>

                <!-- Tombol Kembali -->
                <a href="{{ route('pembeli.index') }}"
                    class="block w-full text-center bg-gray-200 text-gray-800 py-2 rounded-lg mt-3 hover:bg-gray-300 transition duration-200">
                    ⬅️ Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
@endsection
