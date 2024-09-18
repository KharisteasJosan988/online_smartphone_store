@extends('layouts.appAdmin')

@section('title', 'Edit Produk')

@section('page-title', 'Edit Produk')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Produk</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama Produk --}}
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" value="{{ old('name', $product->name) }}" placeholder="Masukkan Nama Produk">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Harga Produk --}}
                <div class="form-group">
                    <label for="price">Harga Produk</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                            id="price" value="{{ old('price', $product->price) }}" placeholder="Masukkan Harga Produk">
                        @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Kategori Produk --}}
                <div class="form-group">
                    <label for="category_id">Kategori Produk</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror"
                        id="category_id">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Deskripsi Produk --}}
                <div class="form-group">
                    <label for="description">Deskripsi Produk</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                        placeholder="Masukkan Deskripsi Produk">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Stok Produk --}}
                <div class="form-group">
                    <label for="stock">Stok Produk</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                        id="stock" value="{{ old('stock', $product->stock) }}" placeholder="Masukkan Jumlah Stok">
                    @error('stock')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Merk Produk --}}
                <div class="form-group">
                    <label for="merk">Merk Produk</label>
                    <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror"
                        id="merk" value="{{ old('merk', $product->merk) }}" placeholder="Masukkan Merk Produk">
                    @error('merk')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Warna Produk --}}
                <div class="form-group">
                    <label for="color">Warna Produk</label>
                    <input type="text" name="color" class="form-control @error('color') is-invalid @enderror"
                        id="color" value="{{ old('color', $product->color) }}">
                    @error('color')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Storage Produk --}}
                <div class="form-group">
                    <label for="storage">Storage Produk</label>
                    <input type="text" name="storage" class="form-control @error('storage') is-invalid @enderror"
                        id="storage" value="{{ old('storage', $product->storage) }}"
                        placeholder="Masukkan Storage Produk">
                    @error('storage')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Gambar Produk --}}
                <div class="form-group">
                    <label for="image">Gambar Produk</label>
                    @if ($product->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk"
                                style="max-width: 100px; max-height: 100px;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                        id="image">
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tombol Submit dan Kembali --}}
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
