<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar pesanan
     */
    public function index()
    {
        // Eager load product supaya nama produk bisa muncul
        $orders = Order::with('product')->latest()->get();

        return view('admin.orders', compact('orders'));
    }

    /**
     * Tampilkan detail pesanan
     */
    public function show($id)
    {
        $order = Order::with('product')->findOrFail($id);
        return view('admin.order_show', compact('order'));
    }

    /**
     * Hapus pesanan
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
