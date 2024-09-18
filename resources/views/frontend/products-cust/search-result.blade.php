@extends('layouts.layout-customer')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Search Results for: "{{ $query }}"</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            @if ($products->isNotEmpty())
                @foreach ($products as $product)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" height="350px">
                            </div>
                            <div class="product-body">
                                <h3 class="product-name"><a
                                        href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h3>
                                <h4 class="product-price">Rp{{ number_format($product->price, 2) }}</h4>
                            </div>
                            <div class="add-to-cart">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add
                                        to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <h3>Produk "{{ $query }}" tidak ditemukan</h3>
                </div>
            @endif
        </div>
    </div>
@endsection
