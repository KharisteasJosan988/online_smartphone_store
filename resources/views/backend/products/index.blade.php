@extends('layouts.appAdmin')

@section('title', 'Product List')

@section('page-title', 'Daftar Produk')

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
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="{{ route('products.create') }}" class="btn btn-info btn-lg fas fa-plus"> Tambah Produk</a>
        </div>
        <div class="card-body">
            @if ($products->isEmpty())
                <p>No products available.</p>
            @else
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Merk</th>
                            <th>Warna</th>
                            <th>Penyimpanan</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'Tidak ada kategori' }}</td>
                                <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->merk }}</td>
                                <td>{{ $product->color }}</td>
                                <td>{{ $product->storage }}</td>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-warning btn-sm fas fa-edit"></a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm fas fa-trash"
                                            onclick="return confirm('Are you sure you want to delete this product?')"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
