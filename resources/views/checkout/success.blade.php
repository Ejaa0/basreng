@extends('layouts.pembeli')

@section('title', 'Pembelian Berhasil')

@section('content')
<div class="max-w-md mx-auto mt-16 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center">
    <h2 class="text-3xl font-bold text-green-600 mb-4">✅ Pembelian Berhasil!</h2>
    <p class="text-gray-700 dark:text-gray-300 mb-6">
        Terima kasih telah melakukan pembelian di <span class="font-semibold">Basreng & Dessert</span>.
    </p>
    <a href="{{ route('pembeli.index') }}" 
       class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition">
        Kembali ke Beranda
    </a>
</div>
@endsection
