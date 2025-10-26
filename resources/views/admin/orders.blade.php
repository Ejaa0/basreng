@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">📦 Daftar Pesanan</h2>

    {{-- ✅ Pesan sukses --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ Tabel pesanan --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm tracking-wider">
                    <th class="px-6 py-3 text-left">Kode Order</th>
                    <th class="px-6 py-3 text-left">Customer</th>
                    <th class="px-6 py-3 text-left">No. Telp</th>
                    <th class="px-6 py-3 text-left">Metode Pembayaran</th>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">Jumlah</th>
                    <th class="px-6 py-3 text-left">Total Harga</th>
                    <th class="px-6 py-3 text-left">Bukti Transfer</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Tanggal</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-6 py-3 font-mono text-sm text-gray-700">{{ $order->order_code ?? '-' }}</td>
                        <td class="px-6 py-3">{{ $order->customer_name }}</td>
                        <td class="px-6 py-3">{{ $order->customer_phone }}</td>
                        <td class="px-6 py-3">{{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</td>
                        <td class="px-6 py-3">{{ $order->product->name ?? 'Produk Tidak Ditemukan' }}</td>
                        <td class="px-6 py-3">{{ $order->quantity }}</td>
                        <td class="px-6 py-3 font-semibold text-gray-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>

                        {{-- ✅ Bukti transfer --}}
                        <td class="px-6 py-3">
                            @if($order->bukti_transfer)
                                <a href="{{ asset('storage/' . $order->bukti_transfer) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $order->bukti_transfer) }}" 
                                         alt="Bukti Transfer" 
                                         class="w-16 h-16 object-cover rounded-md border border-gray-200 shadow-sm hover:scale-105 transition">
                                </a>
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>

                        {{-- ✅ Update status --}}
                        <td class="px-6 py-3">
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                        class="border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>

                        <td class="px-6 py-3 text-sm text-gray-600">{{ $order->created_at->format('d-m-Y H:i') }}</td>

                        {{-- ✅ Tombol aksi --}}
                        <td class="px-6 py-3 space-x-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="text-blue-600 hover:underline font-medium">Detail</a>

                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-medium">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center px-6 py-6 text-gray-500">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
