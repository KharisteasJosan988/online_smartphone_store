<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Gaya khusus untuk toastr sukses */
        .toast-success {
            background-color: #28a745 !important;
            /* Warna hijau */
            color: white !important;
            /* Teks putih */
        }

        /* Mengubah warna teks tombol tutup toastr */
        .toast-success .toast-close-button {
            color: white !important;
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .profile-container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        .profile-header h1 {
            font-size: 24px;
            font-weight: 500;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
        }

        .btn-primary {
            background-color: #d50000;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e02121;
        }

        /* Footer styling */
        footer {
            background-color: #2c2c2c;
            color: white;
            padding: 10px 0;
            font-size: 14px;
        }

        .footer h3 {
            color: #fff;
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .footer p {
            color: #bfbfbf;
            font-size: 14px;
        }

        .footer-links li {
            list-style: none;
            margin-bottom: 10px;
        }

        .footer-links li a {
            color: #bfbfbf;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-links li a i {
            margin-right: 10px;
            color: #ff5722;
        }

        .footer-payments li {
            display: inline-block;
            margin-right: 10px;
        }

        .footer-payments li a {
            color: white;
            font-size: 24px;
        }

        footer a:hover {
            color: #ff5722;
        }

        #bottom-footer {
            background-color: #222;
            padding: 20px 0;
            font-size: 12px;
        }

        #bottom-footer .copyright {
            color: #bfbfbf;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item fs-5">
                        <a class="nav-link" href="/home">Home</a>
                    </li>
                    <li class="nav-item fs-5">
                        <a class="nav-link" href="/profile">Profil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Profil -->
    <div class="container mb-5 mt-5">
        <div class="profile-container">
            <div class="profile-header">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&size=150"
                    alt="Profile Picture">
                <h1>{{ Auth::user()->name }}</h1>
            </div>


            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <!-- Input untuk nama -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('phone', $user->phone) }}" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control" id="address" name="address">{{ old('address', $user->address) }}</textarea>
                </div>


                <!-- Input untuk email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input untuk password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru (Opsional)</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input untuk konfirmasi password -->
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                </div>

                <!-- Tombol untuk submit -->
                <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
            </form>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/main.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
        };
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>

</body>

</html>
