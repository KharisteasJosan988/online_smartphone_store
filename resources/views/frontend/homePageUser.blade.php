<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Semicolon - Online Smartphone Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        .cart-btns {
            margin: 0;
            /* Hilangkan margin */
            padding: 0;
            /* Hilangkan padding */
            text-align: center;
            /* Teks tombol tetap di tengah */
        }

        .cart-btn-full span {
            display: inline-block;
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .cart-btn-full:hover span {
            transform: translateX(5px);
        }

        /* Top Selling Section */
        .top-selling-section {
            margin-bottom: 20px;
        }

        .top-selling-title {
            font-weight: bold;
            font-size: 1.5rem;
            color: #333;
            text-transform: uppercase;
        }

        /* Product Card */
        .product-card-container {
            margin-bottom: 20px;
        }

        .product-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            background-color: #fff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            max-height: 150px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
        }

        .product-price {
            font-size: 1rem;
            color: #777;
        }

        /* No Products Message */
        .no-products-message {
            font-size: 1rem;
            color: #999;
            text-align: center;
            margin-top: 20px;
        }

        /* Utility Classes */
        .mb-3 {
            margin-bottom: 15px !important;
        }

        .modal-dialog-centered {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .modal-body {
            text-align: center;
        }

        .profile-link {
            color: #d50000;
            /* Warna merah */
            font-weight: bold;
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            text-decoration: none;
            display: block;
            /* Pastikan kedua elemen memiliki gaya blok */
            padding: 5px 15px;
            /* Sesuaikan padding agar rata */
        }

        .profile-link.text-danger:hover {
            color: #a71d2a;
            /* Warna saat hover */
            text-decoration: underline;
            /* Tambahkan garis bawah saat hover */
        }

        .dropdown-item.profile-link {
            padding: 5px 15px;
            /* Samakan padding pada kedua elemen */
            margin: 0;
            /* Hapus margin tambahan */
            line-height: 1.5;
            /* Sesuaikan tinggi teks agar konsisten */
        }

        .dropdown-menu {
            padding: 0;
            /* Hapus padding dropdown agar lebih rapi */
            border-radius: 5px;
            /* Tambahkan sudut bulat jika diperlukan */
        }

        .profile-link.text-danger {
            color: #dc3545;
            /* Warna merah */
        }

        .profile-link:hover {
            text-decoration: underline;
            color: #b71c1c;
        }

        .header-profile {
            display: flex;
            align-items: center;
        }

        .header-profile img {
            border-radius: 50%;
            width: 40px;
            margin-right: 10px;
        }

        .main-nav {
            list-style: none;
            padding-left: 0;
            margin: 0;
            display: flex;
            justify-content: space-around;
        }

        .main-nav li {
            margin: 0 10px;
        }

        .main-nav a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            font-weight: bold;
        }

        .main-nav a:hover {
            color: #e53935;
        }
    </style>

</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +6288902347912</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> a.semicolon.ppl@gmail.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> Jl UKRIM</a></li>
                </ul>
                <ul class="header-links pull-right">
                    @guest
                        <!-- Jika belum login -->
                        <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> Login</a></li>
                    @else
                        <!-- Jika sudah login -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle header-profile" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/img/scolon-removebg-preview.png') }}" alt="Profile Picture">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a href="{{ url('profile') }}" class="profile-link text-danger">Profile</a>
                                <a class="profile-link text-danger dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3 d-flex align-items-center">
                        <div class="header-logo">
                            <a href="{{ url('/start') }}" class="logo">
                                <img src="{{ asset('assets/img/SEMICOLON__2_-removebg-preview.png') }}"
                                    class="img-fluid" width="30%" height="30%" alt="Logo Semicolon">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-7">
                        <div class="header-search">
                            <form action="{{ route('search') }}" method="GET">
                                <input class="input" type="text" name="query" placeholder="Search products here"
                                    required>
                                <button class="search-btn" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-2 clearfix">
                        <div class="header-ctn">
                            {{-- <!-- Wishlist -->
                            <div>
                                <a href="#">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <div class="qty">2</div>
                                </a>
                            </div>
                            <!-- /Wishlist --> --}}

                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart ({{ session('cart') ? count(session('cart')) : 0 }})</span>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        @foreach (session('cart', []) as $id => $item)
                                            <div class="product-widget">
                                                <div class="product-img">
                                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name"><a href="#">{{ $item['name'] }}</a>
                                                    </h3>
                                                    <h4 class="product-price"><span
                                                            class="qty">{{ $item['quantity'] }}x</span>
                                                        Rp{{ number_format($item['price'], 2, ',', '.') }}</h4>
                                                </div>
                                                <form action="{{ route('cart.remove') }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $id }}">
                                                    <button type="submit" class="delete"><i
                                                            class="fa fa-close"></i></button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                    @php
                                        $cart = session('cart', []);
                                        $totalPrice = 0;
                                        foreach ($cart as $item) {
                                            $totalPrice += $item['price'] * $item['quantity'];
                                        }
                                    @endphp
                                    <div class="cart-summary">
                                        <h5>Your Cart</h5>
                                        <ul>
                                            @foreach (session('cart', []) as $item)
                                                <li>{{ $item['name'] }} - {{ $item['quantity'] }} x Rp
                                                    {{ number_format($item['price'], 0, ',', '.') }}</li>
                                            @endforeach
                                        </ul>
                                        <h4>Total Price: Rp {{ number_format($totalPrice, 0, ',', '.') }}</h4>
                                    </div>

                                    <div class="cart-btns">
                                        <a href="{{ route('cart.index') }}" class="cart-btn-full">
                                            View Cart <span>&#10140;</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <nav id="navigation">
        <div id="responsive-nav">
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="{{ route('customer-categories.index') }}">Categories</a></li>
                <li><a href="{{ route('products.customer') }}">Smartphones</a></li>
                <li><a href="{{ route('orders.my') }}">Pesanan Saya</a></li>
            </ul>
        </div>
    </nav>

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                <!-- shop -->
                <div class="col-md-6">
                    <div class="shop d-flex align-items-center justify-content-center">
                        <div class="shop-img">
                            <img src="{{ asset('assets/img/ios image.jpeg') }}" class="img-fluid"
                                style="object-fit: cover; height: 300px; width: 100%;" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>IOS<br>Collection</h3>
                            <a href="{{ route('products.customer', ['category_id' => $iosCategoryId]) }}"
                                class="cta-btn">
                                Shop now <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-6">
                    <div class="shop d-flex align-items-center justify-content-center">
                        <div class="shop-img">
                            <img src="{{ asset('assets/img/andro-image.jpeg') }}" class="img-fluid"
                                style="object-fit: cover; height: 300px; width: 100%;" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Android<br>Collection</h3>
                            <a href="{{ route('products.customer', ['category_id' => $androidCategoryId]) }}"
                                class="cta-btn">
                                Shop now <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach ($products as $product)
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}" height="250px">
                                                <div class="product-label">
                                                    <!-- Menampilkan label 'NEW' -->
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">
                                                    {{ $product->category->name ?? 'Uncategorized' }}</p>
                                                <h3 class="product-name"><a
                                                        href="{{ route('products.detail', $product->id) }}">{{ $product->name }}</a>
                                                </h3>
                                                <h4 class="product-price">
                                                    Rp{{ number_format($product->price, 0, ',', '.') }}</h4>
                                                {{-- <div class="product-rating">
                                                    <!-- Jika ada rating di masa depan, tambahkan logika di sini -->
                                                </div> --}}
                                            </div>
                                            <div class="add-to-cart">
                                                <form action="{{ route('cart.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $product->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <!-- Default quantity -->
                                                    <button type="submit" class="add-to-cart-btn">
                                                        <i class="fa fa-shopping-cart"></i> Add to cart
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>

                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    {{-- <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection Up to 50% OFF</p>
                        <a class="primary-btn cta-btn" href="{{ route('products.customer') }}">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION --> --}}

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top selling</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab-top-selling" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    @if ($topSellingProducts->isNotEmpty())
                                        @foreach ($topSellingProducts as $product)
                                            <div class="product">
                                                <div class="product-img">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}">
                                                    {{-- <div class="product-label"> --}}
                                                    {{-- @if ($product->sale_percentage)
                                                            <!-- If there is a sale -->
                                                            <span
                                                                class="sale">-{{ $product->sale_percentage }}%</span>
                                                        @endif --}}
                                                    {{-- @if ($product->is_new)
                                                            <!-- If the product is new -->
                                                            <span class="new">NEW</span>
                                                        @endif --}}
                                                    {{-- </div> --}}
                                                </div>
                                                <div class="product-body">
                                                    <p class="product-category">
                                                        {{ $product->category->name ?? 'No category' }}</p>
                                                    <h3 class="product-name">
                                                        <a
                                                            href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                                    </h3>
                                                    <h4 class="product-price">
                                                        Rp{{ number_format($product->price, 2, ',', '.') }}
                                                        @if ($product->old_price)
                                                            <del
                                                                class="product-old-price">Rp{{ number_format($product->old_price, 2) }}</del>
                                                        @endif
                                                    </h4>
                                                    {{-- <div class="product-rating">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <i
                                                                class="fa fa-star{{ $i < $product->rating ? '' : '-o' }}"></i>
                                                        @endfor
                                                    </div> --}}
                                                </div>
                                                {{-- <div class="product-btns">
                                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                            class="tooltipp">add to wishlist</span></button>
                                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                            class="tooltipp">add to compare</span></button>
                                                    <button class="quick-view"><i class="fa fa-eye"></i><span
                                                            class="tooltipp">quick view</span></button>
                                                </div> --}}
                                                <div class="add-to-cart">
                                                    <form action="{{ route('cart.add') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <button type="submit" class="add-to-cart-btn"><i
                                                                class="fa fa-shopping-cart"></i> Add to Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12">
                                            <h3>No top-selling products found.</h3>
                                        </div>
                                    @endif
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Top Selling iOS -->
                <div class="col-md-6 col-xs-12">
                    <div class="section-title text-center">
                        <h4 class="title">Top Selling (iOS)</h4>
                    </div>
                    <div class="products-widget-slick">
                        <div class="row">
                            @if ($iosBestSelling->isNotEmpty())
                                @foreach ($iosBestSelling as $product)
                                    <div class="col-md-6 col-xs-12">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name">{{ $product->name }}</h3>
                                                <h4 class="product-price">Rp{{ number_format($product->price, 2) }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="no-products-message">Tidak ada top selling di kategori IOS</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Top Selling Android -->
                <div class="col-md-6 col-xs-12">
                    <div class="section-title text-center">
                        <h4 class="title">Top Selling (Android)</h4>
                    </div>
                    <div class="products-widget-slick">
                        <div class="row">
                            @if ($androidBestSelling->isNotEmpty())
                                @foreach ($androidBestSelling as $product)
                                    <div class="col-md-6 col-xs-12">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}" width="30px" height="60">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name">{{ $product->name }}</h3>
                                                <h4 class="product-price">Rp{{ number_format($product->price, 2) }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="no-products-message">Tidak ada top selling di kategori Android</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


    {{-- <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER --> --}}

    <!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>Semicolon - toko smartphone online yang menyediakan beragam smartphone ios dan android
                                dengan harga terjangkau.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>Jl UKRIM</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+6288902347912</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>a.semicolon.ppl@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li>IOS</li>
                                <li>Android</li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    {{-- <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div> --}}

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="{{ route('profile.show') }}">My Profile</a></li>
                                <li><a href="{{ route('cart.index') }}">View Cart</a></li>
                                <li><a href="{{ route('orders.my') }}">My Order</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        {{-- <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer --> --}}
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.products-slick').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true,
                appendArrows: '#slick-nav-1',
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>

</body>

</html>
