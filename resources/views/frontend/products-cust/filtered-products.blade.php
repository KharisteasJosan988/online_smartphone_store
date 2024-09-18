<div class="row" id="store-products">
    @forelse ($products as $product)
        <div class="col-md-4 col-xs-6">
            <div class="product">
                <div class="product-img">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" height="220px">
                </div>
                <div class="product-body">
                    <p class="product-category">{{ $product->category->name }}</p>
                    <h3 class="product-name"><a
                            href="{{ route('products.detail', $product->id) }}">{{ $product->name }}</a>
                    </h3>
                    <h4 class="product-price">Rp {{ number_format($product->price, 2, ',', '.') }}</h4>
                    <p class="product-brand">{{ $product->merk }}</p>
                </div>
                <div class="add-to-cart">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="add-to-cart-btn">
                            <i class="fa fa-shopping-cart"></i> Add to cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <h5 class="text-center">Produk tidak ditemukan.</h5>
        </div>
    @endforelse
</div>
