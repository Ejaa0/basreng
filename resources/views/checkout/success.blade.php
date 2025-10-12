@extends('layouts.pembeli')

@section('title', 'Checkout Berhasil')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg text-center">
    <h2 class="text-2xl font-bold text-green-600 mb-3">Pembelian Berhasil!</h2>

    @if(session('success'))
        <p class="text-gray-700 dark:text-gray-300 mb-4">{{ session('success') }}</p>
    @endif

    @if($orderCode)
        <div class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg mb-2">
            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                Kode Pesanan:
                <span id="orderCode" class="text-blue-600 dark:text-blue-400 cursor-pointer">{{ $orderCode }}</span>
            </p>
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
            Klik kode pesanan untuk menyalinnya.
        </p>
    @endif

    <button id="copyButton" class="mb-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
        Salin Kode Pesanan
    </button>

    <a id="homeButton" href="{{ route('pembeli.index') }}" 
       class="mt-6 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg opacity-50 pointer-events-none hover:bg-blue-600">
        Kembali ke Beranda
    </a>
</div>

<script>
    const copyButton = document.getElementById('copyButton');
    const orderCode = document.getElementById('orderCode');
    const homeButton = document.getElementById('homeButton');

    copyButton.addEventListener('click', () => {
        // Salin kode pesanan ke clipboard
        navigator.clipboard.writeText(orderCode.textContent).then(() => {
            alert('Kode pesanan berhasil disalin!');
            // Aktifkan tombol kembali ke beranda
            homeButton.classList.remove('opacity-50', 'pointer-events-none');
        }).catch(err => {
            alert('Gagal menyalin kode pesanan: ' + err);
        });
    });
</script>
@endsection
