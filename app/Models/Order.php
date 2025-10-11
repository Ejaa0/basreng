<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    'customer_name',
    'customer_phone', // tambah field ini
    'product_id',
    'quantity',
    'total_price',
    'payment_method',
    'bukti_transfer',
    'status',
];


    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // pastikan kolom benar
    }
}
