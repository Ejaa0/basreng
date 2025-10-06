<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PembeliController;

Route::get('/', function () {
    return redirect()->route('admin.index');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('orders', OrderController::class);
Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
