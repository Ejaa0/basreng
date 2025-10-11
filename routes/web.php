<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua route aplikasi didefinisikan di sini.
| Pastikan urutan route aman agar tidak terjadi konflik.
|
*/

// Redirect root ke halaman admin
Route::get('/', function () {
    return redirect()->route('admin.index');
});

// Halaman admin utama
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Resource routes
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('orders', OrderController::class);

// Halaman pembeli
Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli.index');

// ---------------------------
// Checkout Routes
// ---------------------------

// Halaman checkout sukses harus diletakkan **di atas** route dengan {id}
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

// Form checkout berdasarkan produk
Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('checkout.show');

// Submit checkout
Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('checkout.store');
