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

    <meta name="csrf-token" content="{{ csrf_token() }}">

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



        input[name="first-name"] {
            margin-top: 25px;
            ;
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

    <!-- SECTION -->
    <div class="section">
        <!-- Pesan Sukses/Error -->
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

        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Form untuk Shipping Cost -->
                <form id="shipping-cost-form" action="{{ route('shipping-cost') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Data Pemesanan</h3>
                            </div>

                            <!-- Pilih Provinsi -->
                            <div class="form-group">
                                <select name="province" id="province" class="form-control" required>
                                    <option value="">Pilih Asal Provinsi</option>
                                    @foreach ($provinsi as $province)
                                        <option value="{{ $province->id }}">{{ $province->province }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Kota -->
                            <div class="form-group">
                                <select name="city_id" id="city" class="form-control" required>
                                    <option value="">Pilih Kota Asal</option>
                                </select>
                            </div>

                            <!-- Kota Tujuan -->
                            <div class="form-group">
                                <select name="destination" id="destination" class="form-control" required>
                                    <option value="">Pilih Kota Tujuan</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Berat Barang -->
                            <div class="form-group">
                                <input type="number" name="weight" id="weight" class="form-control"
                                    placeholder="Berat (gram)" required>
                            </div>

                            <!-- Pilih Kurir -->
                            <div class="form-group">
                                <label for="courier">Pilih Kurir</label>
                                <select name="courier_id" id="courier" class="form-control" required>
                                    <option value="1">JNE</option>
                                    <option value="2">POS</option>
                                    <option value="3">TIKI</option>
                                </select>
                            </div>

                            <!-- Informasi Tambahan -->
                            <div class="form-group">
                                <input class="input" type="text" name="zip-code" placeholder="Kode Pos">
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" name="tel" placeholder="Nomor Telepon">
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="order-submit primary-btn">Hitung Ongkir</button>
                        </div>
                    </div>
                </form>

                <!-- Form Checkout -->
                <div class="col-md-6">
                    <form id="checkout-form">
                        <div class="form-group">
                            <input class="input" type="text" name="first-name" placeholder="Nama Awal" required>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="last-name" placeholder="Nama Akhir" required>
                        </div>
                        <div class="form-group">
                            <input class="input" type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <textarea class="input" name="address" id="address" placeholder="Alamat Lengkap" required></textarea>
                        </div>

                        <!-- Catatan Pesanan -->
                        <div class="order-notes">
                            <textarea class="input" placeholder="Order Notes"></textarea>
                        </div>
                    </form>
                </div>

                <!-- Order Details -->
                <div class="col-md-6 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Pesanan Anda</h3>
                    </div>
                    <div class="order-summary">
                        <!-- Ringkasan Pesanan -->
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            @php
                                $cart = session('cart', []);
                                $totalPrice = 0;
                                foreach ($cart as $item) {
                                    $totalPrice += $item['price'] * $item['quantity'];
                                }
                            @endphp
                            @foreach ($cart as $id => $item)
                                <div class="order-col">
                                    <div>{{ $item['quantity'] }}x {{ $item['name'] }}</div>
                                    <div>Rp{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Subtotal dan Ongkir -->
                        <div class="order-col">
                            <div><strong>Subtotal</strong></div>
                            <div><strong>Rp{{ number_format($totalPrice, 2, ',', '.') }}</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>Ongkos Kirim</strong></div>
                            <div id="ongkos-kirim">Rp0</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Total</strong></div>
                            <div id="total-price">Rp{{ number_format($totalPrice, 2, ',', '.') }}</div>
                        </div>

                        <div class="form-group">
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="qris">QRIS</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                        </div>

                        <!-- Informasi metode pembayaran -->
                        <div id="payment-info" class="mt-3" style="display: none;">
                            <!-- QRIS -->
                            <div id="qris-info" style="display: none;">
                                <h4>Informasi Pembayaran QRIS</h4>
                                <p>Scan QR Code di bawah ini untuk menyelesaikan pembayaran:</p>
                                <img src="{{ asset('assets/img/qris.png') }}" alt="QRIS QR Code"
                                    style="width: 200px;">
                            </div>

                            <!-- Transfer Bank -->
                            <div id="transfer-info" style="display: none;">
                                <h4>Informasi Pembayaran Transfer Bank</h4>
                                <p>Silakan transfer ke rekening berikut:</p>
                                <ul>
                                    <li><strong>Bank:</strong> BRI</li>
                                    <li><strong>Nomor Rekening:</strong> 1234567890</li>
                                    <li><strong>Atas Nama:</strong> PT Semicolon</li>
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" id="courier-id" name="courier_id" value="{{ $courier->id ?? '' }}">
                        <input type="hidden" name="weight" value="1000">
                        <input type="hidden" name="shipping_cost" id="hidden-shipping-cost" value="0">
                        <input type="hidden" name="total" id="hidden-total" value="{{ $totalPrice }}">
                    </div>

                    <!-- Tombol Pesan -->
                    <button type="button" id="order-now-button" class="primary-btn btn-block">Pesan
                        Sekarang</button>
                </div>

                <div id="shipping-cost-result"></div>
            </div>
            <!-- /Row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /SECTION -->

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#province').on('change', function() {
                var provinceId = $(this).val();

                // Kosongkan dropdown kota
                $('#city').html('<option value="">Pilih Kota Asal</option>');

                if (provinceId) {
                    // Panggil endpoint untuk mendapatkan data kota
                    $.ajax({
                        url: '/cart/get-cities',
                        type: 'GET',
                        data: {
                            province_id: provinceId
                        },
                        success: function(response) {
                            // Tambahkan data kota ke dropdown
                            $.each(response, function(key, city) {
                                $('#city').append('<option value="' + city.id + '">' +
                                    city.city_name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Gagal memuat data kota.');
                        }
                    });
                }
            });
        });
    </script>

    <script>
        document.getElementById('shipping-cost-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const city_id = document.getElementById('city').value;
            const destination = document.getElementById('destination').value;
            const weight = document.getElementById('weight').value;
            const courierId = document.getElementById('courier').value;

            if (!city_id || !destination || !weight || !courierId) {
                alert("Mohon lengkapi semua data!");
                return;
            }

            if (isNaN(weight) || weight <= 0) {
                alert("Berat barang harus lebih dari 0 gram.");
                return;
            }


            // Kirim permintaan menggunakan fetch
            fetch('{{ route('shipping-cost') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        city_id,
                        destination,
                        weight,
                        courier_id: courierId, // Menggunakan courier_id langsung
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data); // Debug data API
                    if (data.success && data.results.length > 0) {
                        const ongkos = data.results[0].costs[0].cost[0].value;
                        console.log("Ongkos kirim:", ongkos); // Debug

                        document.getElementById('hidden-shipping-cost').value = ongkos;

                        const subtotal = parseInt(
                            '{{ $totalPrice }}'); // Pastikan subtotal diambil dengan benar
                        const total = subtotal + ongkos;

                        console.log('Subtotal:', subtotal, 'Total:', total);

                        // Update tampilan ongkos kirim dan total
                        document.getElementById('ongkos-kirim').innerText =
                            `Rp${ongkos.toLocaleString('id-ID')}`;
                        document.getElementById('total-price').innerText = `Rp${total.toLocaleString('id-ID')}`;

                        // Simpan nilai untuk submit final
                        document.getElementById('hidden-total').value = total;
                    } else {
                        console.error('Error:', data);
                        alert('Ongkos kirim tidak ditemukan! Periksa input atau coba kurir lain.');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Gagal menghitung ongkos kirim.');
                });
        });


        document.getElementById('order-now-button').addEventListener('click', async function() {
            const address = document.getElementById('address')?.value;
            const paymentMethod = document.getElementById('payment_method')?.value;
            const courierId = document.getElementById('courier').value;
            const weight = document.getElementById('weight')?.value;
            const ongkos = parseInt(document.getElementById('hidden-shipping-cost')?.value || 0);

            if (!address) {
                alert('Alamat pengiriman harus diisi!');
                return;
            }

            if (!ongkos || ongkos <= 0) {
                alert('Ongkos kirim belum dihitung!');
                return;
            }

            if (!courierId) {
                alert('Kurir belum dipilih. Pastikan elemen courier_id ada di halaman.');
                return;
            }

            console.log({
                address,
                payment_method: paymentMethod,
                courier_id: courierId,
                shipping_cost: ongkos,
                weight,
            });

            const subtotal = parseInt(
                '{{ $totalPrice }}'); // Pastikan subtotal diambil dengan benar
            const total = subtotal + ongkos;

            console.log('Subtotal:', subtotal, 'Total:', total);

            try {
                const response = await fetch('/checkout/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        address,
                        payment_method: paymentMethod,
                        courier_id: courierId,
                        shipping_cost: ongkos,
                        weight,
                        total_jumlah: total,
                        city_id: 501, // Hardcoded atau ambil dari elemen input
                        destination: 419,
                    }),
                });

                const result = await response.json();

                if (response.ok) {
                    alert(result.message);
                    window.location.href = '/my-orders';
                } else {
                    alert(result.message || 'Terjadi kesalahan.');
                }
            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan saat memproses pesanan.');
            }
        });
    </script>

    <script>
        document.getElementById('payment_method').addEventListener('change', function() {
            const paymentInfo = document.getElementById('payment-info');
            const qrisInfo = document.getElementById('qris-info');
            const transferInfo = document.getElementById('transfer-info');

            // Reset display
            paymentInfo.style.display = 'none';
            qrisInfo.style.display = 'none';
            transferInfo.style.display = 'none';

            // Tampilkan informasi sesuai pilihan
            if (this.value === 'qris') {
                paymentInfo.style.display = 'block';
                qrisInfo.style.display = 'block';
            } else if (this.value === 'transfer') {
                paymentInfo.style.display = 'block';
                transferInfo.style.display = 'block';
            }
        });
    </script>
</body>

</html>
