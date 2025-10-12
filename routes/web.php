<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\CheckoutController;

// Redirect root ke halaman admin
Route::get('/', function () {
    return redirect()->route('admin.index');
});

// ---------------------------
// ROUTE ADMIN
// ---------------------------
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Resource routes untuk admin
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('orders', OrderController::class); // hanya untuk admin

// ---------------------------
// ROUTE PEMBELI
// ---------------------------
Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
Route::get('/pembeli/orders', [PembeliController::class, 'orders'])->name('pembeli.orders');

// ---------------------------
// CHECKOUT
// ---------------------------
// urutan ini PENTING — success HARUS di atas {id}
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('checkout.store');
