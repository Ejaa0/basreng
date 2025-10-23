@extends('layouts.pembeli')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-2xl font-semibold text-center mb-4 text-gray-900">
            Detail Pesanan
        </h2>

        {{-- Gambar produk --}}
        <div class="flex justify-center mb-4">
            <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}"
                class="w-48 h-48 object-cover rounded-lg shadow-md">
        </div>

        {{-- Informasi Pemesan --}}
        <div class="space-y-2 mb-5">
            <p><span class="font-semibold text-gray-700">Nama Pemesan:</span> {{ $order->customer_name }}</p>
            <p><span class="font-semibold text-gray-700">Produk:</span> {{ $order->product->name }}</p>
            <p><span class="font-semibold text-gray-700">Harga:</span>
                Rp{{ number_format($order->product->price, 0, ',', '.') }}</p>
            <p><span class="font-semibold text-gray-700">Metode Pembayaran:</span>
                {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</p>
        </div>

        {{-- Bukti Transfer (jika ada) --}}
        @if ($order->bukti_transfer)
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Bukti Transfer:</label>
                <img src="{{ asset('storage/' . $order->bukti_transfer) }}" alt="Bukti Transfer"
                    class="w-full max-h-64 object-contain border rounded-lg shadow-sm">
            </div>
        @endif

        {{-- Status Pembayaran --}}
        <div class="mb-4">
            <p class="font-semibold text-gray-700">Status Pembayaran:</p>
            @if ($order->payment_method === 'cod')
                <span class="text-yellow-600 font-medium">Menunggu pembayaran di tempat</span>
            @else
                <span class="text-green-600 font-medium">Sudah dibayar</span>
            @endif
        </div>

        {{-- Tombol Aksi --}}
        <div class="text-center mt-6 space-x-2">
            <a href="{{ route('home') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">
                Kembali ke Beranda
            </a>
            <a href="{{ route('checkout.print', $order->id) }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                Cetak Struk
            </a>
        </div>
    </div>
@endsection
