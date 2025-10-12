<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class PembeliController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pembeli.index', compact('products'));
    }

    public function orders(Request $request)
    {
        $orders = collect(); // kosongkan dulu, jadi tidak tampil apapun

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
