<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PembeliController extends Controller
{
    public function index()
    {
        $products = Product::all(); // ambil semua produk
        return view('pembeli.index', compact('products'));
    }
}
