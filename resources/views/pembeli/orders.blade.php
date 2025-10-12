@extends('layouts.pembeli')

@section('title', 'Daftar Pesanan Saya')

@section('content')
    <div class="p-6 max-w-6xl mx-auto">

        <h2 class="text-3xl font-extrabold text-green-600 mb-6 text-center md:text-left">
            Daftar Pesanan Saya
        </h2>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Pencarian Pesanan Berdasarkan Kode --}}
        <form action="{{ route('pembeli.orders') }}" method="GET" class="mb-6 flex justify-center md:justify-end">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Masukkan kode pesanan Anda..."
                class="w-64 md:w-80 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-green-400 focus:outline-none"
            >
            <button
                type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-r-lg"
            >
                Cari
            </button>
        </form>

        {{-- Pesan petunjuk --}}
        @if (!request('search'))
            <div class="text-center text-gray-500 text-lg mt-10">
                💡 Masukkan kode pesanan Anda di atas untuk melihat detail pesanan.
            </div>
        @elseif ($orders->isEmpty())
            <p class="text-center text-gray-500 text-lg">
                Tidak ada pesanan dengan kode:
                <strong>{{ request('search') }}</strong>.
            </p>
        @else
            {{-- Daftar Pesanan --}}
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr class="text-gray-700 uppercase text-sm">
                            <th class="px-6 py-3 text-left">Kode Pesanan</th>
                            <th class="px-6 py-3 text-left">Produk</th>
                            <th class="px-6 py-3 text-left">Jumlah</th>
                            <th class="px-6 py-3 text-left">Total Harga</th>
                            <th class="px-6 py-3 text-left">Metode Pembayaran</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Bukti Transfer</th>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-3 font-semibold text-green-600">
                                    {{ $order->order_code }}
                                </td>
                                <td class="px-6 py-3">{{ $order->product->name ?? 'Produk Tidak Ditemukan' }}</td>
                                <td class="px-6 py-3">{{ $order->quantity }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-3">{{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</td>
                                <td class="px-6 py-3">
                                    @if ($order->status == 'pending')
                                        <span class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded-full text-xs font-semibold">
                                            Pending
                                        </span>
                                    @elseif ($order->status == 'paid')
                                        <span class="px-2 py-1 bg-green-200 text-green-800 rounded-full text-xs font-semibold">
                                            Lunas
                                        </span>
                                    @elseif ($order->status == 'cancelled')
                                        <span class="px-2 py-1 bg-red-200 text-red-800 rounded-full text-xs font-semibold">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-3">
                                    @if ($order->bukti_transfer)
                                        <a href="{{ asset('storage/' . $order->bukti_transfer) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $order->bukti_transfer) }}" alt="Bukti Transfer"
                                                class="w-20 h-20 object-cover rounded shadow">
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
@endsection
