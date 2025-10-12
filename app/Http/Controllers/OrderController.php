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
        // Cari pesanan dengan relasi produk, jika tidak ditemukan tampilkan 404
        $order = Order::with('product')->findOrFail($id);

        return view('admin.order_show', compact('order'));
    }

    /**
     * Hapus pesanan berdasarkan ID
     */
    public function destroy($id)
    {
        // Cari pesanan, jika tidak ditemukan tampilkan 404
        $order = Order::findOrFail($id);

        // Hapus data pesanan
        $order->delete();

        // Redirect kembali ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    /**
     * (Opsional) Tambahkan pesanan baru - jika nanti ingin ada fitur create
     */
    public function create()
    {
        $products = Product::all(); // untuk dropdown pilihan produk
        return view('admin.order_create', compact('products'));
    }

    /**
     * (Opsional) Simpan pesanan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'product_id'    => 'required|exists:products,id',
            'quantity'      => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Hitung total harga
        $totalPrice = $product->price * $request->quantity;

        Order::create([
            'customer_name' => $request->customer_name,
            'product_id'    => $product->id,
            'quantity'      => $request->quantity,
            'total_price'   => $totalPrice,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }
}
