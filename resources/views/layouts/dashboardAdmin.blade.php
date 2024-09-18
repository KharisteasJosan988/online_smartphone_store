<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Semicolon | Dashboard</title>

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}" />
    <!-- Slick CSS (if needed for a slider) -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />
    <!-- nouislider CSS (if needed for range sliders) -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('vendor/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        {{-- <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Semicolon</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&size=150"
                            alt="User Image" class="img-circle elevation-2">
                    </div>
                    <div class="info">
                        <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                {{-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('products-admin') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Product
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.couriers.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Kurir
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Pesanan
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                {{-- <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid --> --}}
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                        <!-- Total Produk -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Produk</span>
                                    <span class="info-box-number">
                                        {{ $totalProducts }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Total Pesanan -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i
                                        class="fas fa-shopping-cart"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Pesanan</span>
                                    <span class="info-box-number">{{ $totalOrders }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- Total Kategori -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tags"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Kategori</span>
                                    <span class="info-box-number">{{ $totalCategories }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- Total Kurir -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-truck"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Kurir</span>
                                    <span class="info-box-number">{{ $totalCouriers }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Monthly Sales Recap</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="monthlyRecapChart" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">Pesanan Terbaru</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>No Pesanan</th>
                                                    <th>Nama Customer</th>
                                                    <th>Status</th>
                                                    <th>Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('orders.adminShow', $order->id) }}">{{ $order->no_pesanan }}</a>
                                                        </td>
                                                        <td>{{ $order->user->name }}</td>
                                                        <td>
                                                            <span
                                                                class="badge
                                                                @if ($order->status === 'pending') badge-warning
                                                                @elseif ($order->status === 'processed') badge-info
                                                                @elseif ($order->status === 'shipped') badge-primary
                                                                @elseif ($order->status === 'delivered') badge-success
                                                                @else badge-danger @endif">
                                                                {{ ucfirst($order->status) }}
                                                            </span>
                                                        </td>
                                                        <td>Rp{{ number_format($order->total_jumlah, 2, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                {{-- <div class="card-footer clearfix">
                                    <a href="{{ route('admin.orders.create') }}" class="btn btn-sm btn-info float-left">Buat Pesanan Baru</a>
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary float-right">Lihat Semua Pesanan</a>
                                </div> --}}
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>

                        <!-- /.col -->

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Produk Baru</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                        @foreach ($recentProducts as $product)
                                            <li class="item">
                                                <div class="product-img">
                                                    @if ($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            alt="{{ $product->name }}" class="img-size-50">
                                                    @else
                                                        <img src="{{ asset('dist/img/default-150x150.png') }}"
                                                            alt="Default Image" class="img-size-50">
                                                    @endif
                                                </div>
                                                <div class="product-info">
                                                    {{ $product->name }}
                                                    <span class="badge badge-success float-right">
                                                        Rp {{ number_format($product->price, 2, ',', '.') }}
                                                    </span>
                                                    <span class="product-description">
                                                        {{ Str::limit($product->description, 50, '...') }}
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="{{ route('products.index') }}" class="uppercase">Lihat Semua Produk</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle (with Popper.js for Bootstrap) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('vendor/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dari backend
            const labels = @json($months);
            const data = @json($salesData);

            // Konfigurasi Chart.js
            const ctx = document.getElementById('monthlyRecapChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Sales (Rp)',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + new Intl.NumberFormat().format(value);
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
