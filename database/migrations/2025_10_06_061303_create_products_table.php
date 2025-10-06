<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // Nama produk
    $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null'); // Kategori
    $table->text('description')->nullable(); // Deskripsi
    $table->decimal('price', 10, 2); // Harga
    $table->integer('stock')->default(0); // Stok
    $table->string('image')->nullable(); // Gambar produk
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
