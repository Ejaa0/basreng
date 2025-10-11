<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

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

    // Validasi
    $rules = [
        'customer_name'  => 'required|string|max:255',
        'customer_phone' => 'required|string|max:15',
        'payment_method' => 'required|string',
    ];

    // Buat bukti_transfer wajib jika bukan COD
    if ($request->payment_method !== 'cod') {
        $rules['bukti_transfer'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
    }

    $request->validate($rules);

    $buktiPath = null;
    if ($request->hasFile('bukti_transfer')) {
        $buktiPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
    }

    Order::create([
        'product_id'     => $product->id,
        'quantity'       => 1,
        'total_price'    => $product->price,
        'customer_name'  => $request->customer_name,
        'customer_phone' => $request->customer_phone,
        'payment_method' => $request->payment_method,
        'bukti_transfer' => $buktiPath,
        'status'         => 'pending',
    ]);

    return redirect()->route('checkout.success')->with('success', 'Pembelian berhasil!');
}


    public function success()
    {
        return view('checkout.success');
    }
}
