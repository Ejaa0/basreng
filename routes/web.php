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

// ---------------------------
// REDIRECT ROOT
// ---------------------------
Route::get('/', fn() => redirect()->route('pembeli.index'));

// ---------------------------
// LOGIN SYSTEM (SESSION)
// ---------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ---------------------------
// ROUTE ADMIN (proteksi dengan session)
// ---------------------------
Route::middleware([AdminSessionMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Resource routes untuk admin
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);

    // Route khusus update status pesanan
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// ---------------------------
// ROUTE PEMBELI
// ---------------------------
Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
Route::get('/pembeli/orders', [PembeliController::class, 'orders'])->name('pembeli.orders');
Route::get('/pembeli/kontak', fn() => view('pembeli.kontak'))->name('pembeli.kontak');

// ---------------------------
// CHECKOUT
// ---------------------------
Route::prefix('checkout')->group(function () {
    Route::get('/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/{id}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/{id}', [CheckoutController::class, 'store'])->name('checkout.store');
});

// ---------------------------
// FORGOT / RESET PASSWORD
// ---------------------------
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('forgot.form');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot.send');
Route::get('/reset-password/{username}', [ForgotPasswordController::class, 'showResetForm'])->name('reset.form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');
