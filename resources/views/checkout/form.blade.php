@extends('layouts.pembeli')

@section('title', 'Checkout Produk')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
    <h2 class="text-2xl font-semibold text-center mb-4 text-gray-900">
        Checkout Produk
    </h2>

    {{-- Gambar produk --}}
    <div class="flex justify-center mb-4">
        <img src="{{ asset('storage/' . $product->image) }}" 
             alt="{{ $product->name }}" 
             class="w-48 h-48 object-cover rounded-lg shadow-md">
    </div>

    <form action="{{ route('checkout.store', $product->id) }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="space-y-5">
        @csrf

        {{-- Nama Pemesan --}}
        <div>
            <label for="customer_name" class="block text-gray-700 font-medium mb-2">
                Nama Pemesan:
            </label>
            <input 
                type="text" 
                id="customer_name" 
                name="customer_name"
                class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-green-500"
                placeholder="Masukkan nama Anda" 
                required>
        </div>

        {{-- Nomor Telepon --}}
        <div>
            <label for="customer_phone" class="block text-gray-700 font-medium mb-2">
                Nomor Telepon:
            </label>
            <input 
                type="tel" 
                id="customer_phone" 
                name="customer_phone"
                class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-green-500"
                placeholder="Masukkan nomor telepon Anda" 
                pattern="[0-9]{10,15}" 
                title="Masukkan nomor telepon yang valid (10-15 digit)" 
                required>
        </div>

        {{-- Informasi Produk --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">
                Produk:
            </label>
            <p class="p-2 border rounded-lg bg-gray-50 flex justify-between items-center">
                <span>{{ $product->name }}</span>
                <span class="font-semibold text-green-700" id="product_price" data-price="{{ $product->price }}">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                </span>
            </p>
        </div>

        {{-- Jumlah Pesanan --}}
        <div>
            <label for="quantity" class="block text-gray-700 font-medium mb-2">
                Jumlah Pesanan:
            </label>
            <input 
                type="number" 
                id="quantity" 
                name="quantity"
                class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-green-500"
                value="1" min="1" required>
        </div>

        {{-- Total Harga --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">
                Total Harga:
            </label>
            <p id="total_price" class="p-2 border rounded-lg bg-gray-50 font-semibold text-green-700">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </p>
        </div>

        {{-- Metode Pembayaran --}}
        <div>
            <label for="payment_method" class="block text-gray-700 font-medium mb-2">
                Metode Pembayaran:
            </label>
            <select 
                id="payment_method" 
                name="payment_method" 
                required
                class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                <option value="" disabled selected>Pilih metode pembayaran</option>
                <option value="mandiri">Transfer Mandiri</option>
                <option value="gopay">GoPay</option>
                <option value="dana">DANA</option>
                <option value="cod">Bayar di Tempat (COD)</option>
            </select>
        </div>

        {{-- Info Pembayaran --}}
        <div id="payment_info" class="hidden bg-gray-50 border p-3 rounded-lg">
            <p class="text-sm text-gray-700" id="payment_text"></p>
        </div>

        {{-- Bukti Transfer (muncul otomatis jika bukan COD) --}}
        <div id="bukti_transfer_section" class="hidden">
            <label for="bukti_transfer" class="block text-gray-700 font-medium mb-2">
                Upload Bukti Transfer:
            </label>
            <input 
                type="file" 
                id="bukti_transfer" 
                name="bukti_transfer"
                accept="image/*"
                class="w-full border p-2 rounded-lg cursor-pointer focus:ring-2 focus:ring-green-500">
            <p class="text-xs text-gray-500 mt-1">
                Format: JPG, PNG, maksimal 2MB.
            </p>
        </div>

        {{-- Tombol Submit --}}
        <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg transition">
            Lanjutkan Pembelian
        </button>
    </form>
</div>

{{-- Script interaktif --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const paymentSelect = document.getElementById('payment_method');
        const paymentInfo = document.getElementById('payment_info');
        const paymentText = document.getElementById('payment_text');
        const buktiSection = document.getElementById('bukti_transfer_section');
        const quantityInput = document.getElementById('quantity');
        const productPrice = document.getElementById('product_price');
        const totalPriceDisplay = document.getElementById('total_price');

        // Update total harga otomatis
        function updateTotal() {
            const price = parseInt(productPrice.dataset.price);
            const qty = parseInt(quantityInput.value);
            const total = price * qty;
            totalPriceDisplay.textContent = 'Rp' + total.toLocaleString('id-ID');
        }

        quantityInput.addEventListener('input', updateTotal);

        // Informasi metode pembayaran
        paymentSelect.addEventListener('change', function () {
            const method = this.value;
            let message = '';

            switch (method) {
                case 'mandiri':
                    message = 'Silakan transfer ke Mandiri: 1760001933181';
                    break;
                case 'gopay':
                case 'dana':
                    message = 'Silakan transfer ke DANA / GoPay: 081223236894';
                    break;
                case 'cod':
                    message = 'Pembayaran dilakukan di tempat saat barang diterima (COD).';
                    break;
            }

            paymentInfo.classList.remove('hidden');
            paymentText.textContent = message;

            // Tampilkan / sembunyikan bukti transfer
            if (method === 'cod') {
                buktiSection.classList.add('hidden');
            } else {
                buktiSection.classList.remove('hidden');
            }
        });
    });
</script>
@endsection
