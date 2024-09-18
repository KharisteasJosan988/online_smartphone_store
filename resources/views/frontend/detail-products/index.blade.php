@extends('layouts.layout-customer')

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

    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-6">
                <div id="product-main-img">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-responsive">
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <div>
                        <h3 class="product-price">${{ number_format($product->price, 2) }}</h3>
                        <span class="product-available">{{ $product->stock > 0 ? 'Stok tersedia' : 'Stok habis' }}</span>
                    </div>
                    <p>{{ $product->description }}</p>

                    <div class="product-options">
                        <label>
                            Merk: {{ $product->merk }}
                        </label>
                        <label>
                            Color: {{ $product->color }}
                        </label>
                        <label>
                            Storage: {{ $product->storage }}
                        </label>
                    </div>

                    <div class="add-to-cart">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number" name="quantity" min="1" max="{{ $product->stock }}"
                                        value="1">
                                </div>
                            </div>
                            <!-- Kirim product_id -->
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="add-to-cart-btn">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        <li><a data-toggle="tab" href="#tab2">Details</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->

                        <!-- tab2  -->
                        <div id="tab2" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul>
                                        <li><strong>Merk:</strong> {{ $product->merk }}</li>
                                        <li><strong>Color:</strong> {{ $product->color }}</li>
                                        <li><strong>Storage:</strong> {{ $product->storage }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /tab2  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /Product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
@endsection
