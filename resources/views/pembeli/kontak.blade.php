@extends('layouts.pembeli')

@section('title', 'Kontak Kami')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold text-green-600 mb-6 text-center">Kontak Kami</h2>

    <p class="text-gray-700 dark:text-gray-300 mb-4 text-center">
        Silakan hubungi admin jika ada pertanyaan atau bantuan.
    </p>

    

        <div class="flex items-center">
            <span class="font-semibold w-32">No. WhatsApp:</span>
            <a href="https://wa.me/628123236894" target="_blank" class="text-green-600 dark:text-green-400 hover:underline">
                +62 812-2323-6894
            </a>
        </div>

        <div class="flex items-center">
            <span class="font-semibold w-32">Alamat:</span>
            <span>Universitas Advent Indonesia</span>
        </div>
    </div>

    <p class="mt-6 text-gray-500 dark:text-gray-400 text-sm text-center">
        Admin biasanya membalas dalam 24 jam kerja.
    </p>
</div>
@endsection
