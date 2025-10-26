<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Middleware\AdminSessionMiddleware;

// --------------------------------------------------
// REDIRECT ROOT KE PEMBELI
// --------------------------------------------------
Route::get('/', fn() => redirect()->route('pembeli.index'));

// --------------------------------------------------
// LOGIN SYSTEM (KHUSUS ADMIN, SESSION-BASED)
// --------------------------------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// --------------------------------------------------
// ADMIN AREA (PROTEKSI MENGGUNAKAN SESSION)
// --------------------------------------------------
Route::middleware([AdminSessionMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // CRUD Admin
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);

    // Update status pesanan
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// --------------------------------------------------
// HALAMAN PEMBELI (TANPA LOGIN)
// --------------------------------------------------
Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
Route::get('/pembeli/orders', [PembeliController::class, 'orders'])->name('pembeli.orders'); // ✅ harus di atas {id}
Route::get('/pembeli/kontak', fn() => view('pembeli.kontak'))->name('pembeli.kontak');
Route::get('/pembeli/{id}', [PembeliController::class, 'show'])->name('pembeli.show');

// --------------------------------------------------
// PRODUK (PUBLIC UNTUK PEMBELI)
// --------------------------------------------------
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// --------------------------------------------------
// CHECKOUT (TANPA LOGIN)
// --------------------------------------------------
Route::prefix('checkout')->group(function () {
    Route::get('/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/{id}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/{id}', [CheckoutController::class, 'store'])->name('checkout.store');
});

// --------------------------------------------------
// DETAIL PESANAN & STRUK (TANPA LOGIN)
// --------------------------------------------------
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
Route::get('/order/{id}/print', [OrderController::class, 'print'])->name('checkout.print');

// --------------------------------------------------
// FORGOT / RESET PASSWORD (KHUSUS ADMIN)
// --------------------------------------------------
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('forgot.form');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot.send');
Route::get('/reset-password/{username}', [ForgotPasswordController::class, 'showResetForm'])->name('reset.form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');
