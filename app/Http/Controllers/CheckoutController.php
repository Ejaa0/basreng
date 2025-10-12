<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('checkout.form', compact('product'));
    }

    public function store(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Validasi input
    $rules = [
        'customer_name'  => 'required|string|max:255',
        'customer_phone' => 'required|string|max:15',
        'payment_method' => 'required|string',
        'quantity'       => 'required|integer|min:1', // ✅ Tambah validasi quantity
    ];

    // Bukti transfer wajib jika bukan COD
    if ($request->payment_method !== 'cod') {
        $rules['bukti_transfer'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
    }

    $request->validate($rules);

    // Simpan bukti transfer jika ada
    $buktiPath = null;
    if ($request->hasFile('bukti_transfer')) {
        $buktiPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
    }

    // Buat kode unik pesanan
    $orderCode = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

    // Simpan ke database ✅ pakai quantity dari form
    $order = Order::create([
        'product_id'     => $product->id,
        'quantity'       => $request->quantity,
        'total_price'    => $product->price * $request->quantity, // ✅ otomatis hitung total
        'customer_name'  => $request->customer_name,
        'customer_phone' => $request->customer_phone,
        'payment_method' => $request->payment_method,
        'bukti_transfer' => $buktiPath,
        'status'         => 'pending',
        'order_code'     => $orderCode,
    ]);

    // Redirect ke halaman sukses
    return redirect()->route('checkout.success')->with([
        'success' => 'Pembelian berhasil!',
        'order_code' => $orderCode,
    ]);
}

    public function success()
    {
        $orderCode = session('order_code');
        return view('checkout.success', compact('orderCode'));
    }
}
