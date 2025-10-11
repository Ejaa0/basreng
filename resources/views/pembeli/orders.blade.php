@extends('layouts.pembeli')

@section('title', 'Daftar Pesanan Saya')

@section('content')
<div class="p-6 max-w-6xl mx-auto">

    <h2 class="text-3xl font-extrabold text-green-600 mb-6 text-center md:text-left">
        Daftar Pesanan Saya
    </h2>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <p class="text-center text-gray-500 text-lg">Belum ada pesanan.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr class="text-gray-700 uppercase text-sm">
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
                    @foreach($orders as $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $order->product->name ?? 'Produk Tidak Ditemukan' }}</td>
                            <td class="px-6 py-3">{{ $order->quantity }}</td>
                            <td class="px-6 py-3">Rp {{ number_format($order->total_price,0,',','.') }}</td>
                            <td class="px-6 py-3">{{ strtoupper(str_replace('_',' ',$order->payment_method)) }}</td>
                            <td class="px-6 py-3">
                                @if($order->status == 'pending')
                                    <span class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded-full text-xs font-semibold">
                                        Pending
                                    </span>
                                @elseif($order->status == 'paid')
                                    <span class="px-2 py-1 bg-green-200 text-green-800 rounded-full text-xs font-semibold">
                                        Lunas
                                    </span>
                                @elseif($order->status == 'cancelled')
                                    <span class="px-2 py-1 bg-red-200 text-red-800 rounded-full text-xs font-semibold">
                                        Dibatalkan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3">
                                @if($order->bukti_transfer)
                                    <a href="{{ asset('storage/' . $order->bukti_transfer) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $order->bukti_transfer) }}" 
                                             alt="Bukti Transfer" class="w-20 h-20 object-cover rounded shadow">
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
