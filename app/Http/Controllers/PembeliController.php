<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class PembeliController extends Controller
{
    /**
     * Tampilkan semua produk
     */
    public function index()
    {
        $products = Product::all();
        return view('pembeli.index', compact('products'));
    }

    /**
     * Tampilkan detail produk berdasarkan id
     */
    public function show(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Tombol beli hanya muncul untuk pembeli
        $canBuy = $request->session()->has('role') && $request->session('role') == 'pembeli';

        return view('pembeli.show', compact('product', 'canBuy'));
    }

    /**
     * Tampilkan daftar order pembeli
     */
    public function orders(Request $request)
    {
        $orders = collect(); // default kosong

        // Jika user mencari berdasarkan kode pesanan
        if ($request->filled('search')) {
            $orders = Order::with('product')
                ->where('order_code', 'LIKE', '%' . $request->search . '%')
                ->latest()
                ->get();
        }

        return view('pembeli.orders', compact('orders'));
    }
}
