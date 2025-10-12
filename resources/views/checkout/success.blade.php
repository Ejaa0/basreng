@extends('layouts.pembeli')

@section('title', 'Checkout Berhasil')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center">
    <h2 class="text-2xl font-bold text-green-600 mb-3">Pembelian Berhasil!</h2>

    @if(session('success'))
        <p class="text-gray-700 dark:text-gray-300 mb-4">{{ session('success') }}</p>
    @endif

    @if($orderCode)
        <div class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg">
            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                Kode Pesanan:
                <span class="text-blue-600 dark:text-blue-400">{{ $orderCode }}</span>
            </p>
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
            Simpan kode ini untuk melacak pesanan Anda.
        </p>
    @endif

    <a href="{{ route('pembeli.index') }}" class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
        Kembali ke Beranda
    </a>
</div>
@endsection
