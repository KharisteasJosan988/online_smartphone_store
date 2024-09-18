@extends('layouts.appAdmin')

@section('title', 'Tambah Produk')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Form Tambah Produk</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Produk --}}
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" value="{{ old('name') }}" placeholder="Masukkan Nama Produk">
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
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                            id="price" value="{{ old('price') }}" placeholder="Masukkan Harga Produk">
                        @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi Produk --}}
                <div class="form-group">
                    <label for="description">Deskripsi Produk</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                        placeholder="Masukkan Deskripsi Produk">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Stok Produk --}}
                <div class="form-group">
                    <label for="stock">Stok Produk</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                        id="stock" value="{{ old('stock') }}" placeholder="Masukkan Jumlah Stok">
                    @error('stock')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="merk">Merk Produk</label>
                            <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror"
                                id="merk" value="{{ old('merk') }}" placeholder="Masukkan Merk Produk">
                            @error('merk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="color">Warna Produk</label>
                            <input type="string" name="color" class="form-control @error('color') is-invalid @enderror"
                                id="color" value="{{ old('color') }}">
                            @error('color')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- Storage Produk --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="storage">Storage Produk</label>
                            <div class="input-group">
                                <input type="text" name="storage"
                                    class="form-control @error('storage') is-invalid @enderror" id="storage"
                                    value="{{ old('storage') }}" placeholder="Masukkan Storage Produk">
                                <div class="input-group-append">
                                    <span class="input-group-text">GB</span>
                                </div>
                                @error('storage')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- Gambar Produk --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Gambar Produk</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                id="image">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Kategori Produk --}}
                <div class="form-group">
                    <label for="category_id">Kategori Produk</label>
                    <select name="category_id" id="category_id"
                        class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Tombol Submit dan Kembali --}}
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
