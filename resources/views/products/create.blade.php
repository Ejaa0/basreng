@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-green-600 mb-4">Tambah Produk Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Nama Produk -->
        <div>
            <label class="block font-semibold mb-1">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description') }}</textarea>
        </div>

        <!-- Harga -->
        <div>
            <label class="block font-semibold mb-1">Harga</label>
            <input type="number" name="price" value="{{ old('price') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <!-- Stok -->
        <div>
            <label class="block font-semibold mb-1">Stok</label>
            <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <!-- Gambar -->
        <div>
            <label class="block font-semibold mb-1">Gambar Produk</label>
            <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <!-- Tombol -->
        <div class="flex justify-between">
            <a href="{{ route('admin.products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition duration-200">
                Kembali
            </a>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-200">
                Simpan Produk
            </button>
        </div>
    </form>
</div>
@endsection
