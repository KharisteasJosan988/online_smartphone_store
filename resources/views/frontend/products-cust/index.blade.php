<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

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

        .main-nav.nav.navbar-nav {
            display: flex;
            flex-direction: row;
            list-style: none;
            justify-content: flex-start;
            /* Atur posisi elemen */
            padding: 0;
            margin: 0;
        }

        .main-nav.nav.navbar-nav li {
            margin: 0 15px;
        }

        .main-nav.nav.navbar-nav li a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
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

        .product {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .product-body {
            min-height: 180px;
            /* Tetapkan ketinggian minimum untuk bagian body produk */
        }

        .add-to-cart {
            margin-top: auto;
            /* Posisikan tombol add-to-cart di bagian bawah */
        }
    </style>

</head>

<body>
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

    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li><a href="{{ route('customer.home') }}">Home</a></li>
                    <li><a href="{{ route('customer-categories.index') }}">Categories</a></li>
                    <li><a href="{{ route('products.customer') }}">Smartphones</a></li>
                    <li><a href="{{ route('orders.my') }}">Pesanan Saya</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->

    <div class="section">
        <div class="container">
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- Categories Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Categories</h3>
                        <div class="checkbox-filter">
                            @foreach ($categories as $category)
                                <div class="input-checkbox">
                                    <input type="checkbox" class="category-filter" id="category-{{ $category->id }}"
                                        value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'checked' : '' }}>
                                    <label for="category-{{ $category->id }}">
                                        <span></span>
                                        {{ $category->name }}
                                        <small>({{ $category->products->count() }})</small>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <!-- Price Sort Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Sort By</h3>
                        <select id="price-sort" class="form-control">
                            <option value="">Pilih Opsi</option>
                            <option value="low_to_high">Dari Harga Terendah</option>
                            <option value="high_to_low">Dari Harga Tertinggi</option>
                        </select>
                    </div>



                    <!-- Brand Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Brand</h3>
                        <div class="checkbox-filter">
                            @foreach ($brands as $brand)
                                <div class="input-checkbox">
                                    <input type="checkbox" class="brand-filter" id="brand-{{ $brand->merk }}"
                                        value="{{ $brand->merk }}">
                                    <label for="brand-{{ $brand->merk }}">
                                        <span></span>
                                        {{ $brand->merk }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>




                    {{-- <!-- Top Selling Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Top selling</h3>
                        <div class="product-widget">
                            <!-- Produk-produk terlaris bisa ditambahkan di sini -->
                        </div>
                    </div> --}}
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- Store Products -->
                    <div class="row" id="store-products">
                        @foreach ($products as $product)
                            <div class="col-md-4 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        <img height="220px" src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product->category->name }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ route('products.detail', $product->id) }}">{{ $product->name }}</a>
                                        </h3>
                                        <h4 class="product-price">Rp{{ number_format($product->price, 2) }}</h4>
                                        <p class="product-brand">{{ $product->merk }}</p>
                                    </div>
                                    <div class="add-to-cart">
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <!-- Default quantity -->
                                            <button type="submit" class="add-to-cart-btn">
                                                <i class="fa fa-shopping-cart"></i> Add to cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <!-- Pagination -->
                    <div class="store-filter clearfix">
                        <ul class="store-pagination">
                            <li class="active">1</li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /STORE -->
            </div>
        </div>
    </div>

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
            // Fungsi untuk mem-filter produk
            function filterProducts() {
                var selectedCategories = [];
                var selectedBrands = [];
                var sortPrice = $('#price-sort').val();

                // Ambil kategori yang dipilih
                $('.category-filter:checked').each(function() {
                    selectedCategories.push($(this).val());
                });

                // Ambil merk yang dipilih
                $('.brand-filter:checked').each(function() {
                    selectedBrands.push($(this).val());
                });

                // Kirimkan AJAX request untuk filter produk
                $.ajax({
                    url: '{{ route('products.filter') }}',
                    method: 'GET',
                    data: {
                        categories: selectedCategories,
                        brands: selectedBrands,
                        sort_price: sortPrice
                    },
                    success: function(response) {
                        console.log('Response:', response);
                        $('#store-products').html(response); // Update produk yang difilter
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        console.log(xhr.responseText);
                    }
                });

            }

            // Trigger filter saat dropdown diubah
            $('#price-sort').on('change', function() {
                filterProducts();
            });

            // Event handler untuk filter
            $('.category-filter, .brand-filter').on('change', function() {
                filterProducts();
            });

        });
    </script>


</body>

</html>
