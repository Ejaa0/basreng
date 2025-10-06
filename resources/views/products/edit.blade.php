@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold text-green-600 mb-6">Edit Produk</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nama Produk -->
        <div>
            <label class="block font-semibold mb-1">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Harga -->
        <div>
            <label class="block font-semibold mb-1">Harga (Rp)</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" step="100">
        </div>

        <!-- Stok -->
        <div>
            <label class="block font-semibold mb-1">Stok</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <!-- Gambar -->
        <div>
            <label class="block font-semibold mb-1">Gambar Produk</label>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover mb-2 rounded">
            @endif
            <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <!-- Tombol Submit -->
        <div>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition duration-200">
                Perbarui Produk
            </button>
        </div>
    </form>
</div>
@endsection
