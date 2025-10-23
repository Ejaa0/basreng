<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar semua pesanan
     */
    public function index()
    {
        // Ambil semua pesanan dengan relasi produk
        $orders = Order::with('product')->latest()->get();

        return view('admin.orders', compact('orders'));
    }

    /**
     * Tampilkan detail dari satu pesanan berdasarkan ID
     */
    public function show($id)
    {
        $order = Order::with('product')->findOrFail($id);
        return view('admin.order_show', compact('order'));
    }

    /**
     * Hapus pesanan berdasarkan ID
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    /**
     * Tambahkan pesanan baru (opsional)
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.order_create', compact('products'));
    }

    /**
     * Simpan pesanan baru (opsional)
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'product_id'    => 'required|exists:products,id',
            'quantity'      => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $totalPrice = $product->price * $request->quantity;

        Order::create([
            'customer_name' => $request->customer_name,
            'product_id'    => $product->id,
            'quantity'      => $request->quantity,
            'total_price'   => $totalPrice,
            'status'        => 'pending', // default status
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Update status pesanan
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
