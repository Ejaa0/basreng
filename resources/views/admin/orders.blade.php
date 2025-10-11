@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Daftar Pesanan</h2>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <th class="px-6 py-3 text-left">Customer</th>
                    <th class="px-6 py-3 text-left">No. Telp</th>
                    <th class="px-6 py-3 text-left">Metode Pembayaran</th>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">Jumlah</th>
                    <th class="px-6 py-3 text-left">Total Harga</th>
                    <th class="px-6 py-3 text-left">Bukti Transfer</th> {{-- Kolom baru --}}
                    <th class="px-6 py-3 text-left">Tanggal</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $order->customer_name }}</td>
                        <td class="px-6 py-3">{{ $order->customer_phone }}</td>
                        <td class="px-6 py-3">{{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</td>
                        <td class="px-6 py-3">{{ $order->product->name ?? 'Produk Tidak Ditemukan' }}</td>
                        <td class="px-6 py-3">{{ $order->quantity }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
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
                        <td class="px-6 py-3">
                            <a href="{{ route('orders.show', $order->id) }}"
                               class="text-blue-600 hover:underline mr-2">Detail</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center px-6 py-4 text-gray-500">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
