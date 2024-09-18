@extends('layouts.appAdmin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Item Pesanan</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ number_format($item->price, 2, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->quantity * $item->price, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4 class="mt-4">Informasi Pesanan</h4>
            <table class="table table-bordered">
                <tr>
                    <th>No Pesanan</th>
                    <td>{{ $order->no_pesanan }}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{ $order->user->name }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ ucfirst($order->metode_pembayaran) }}</td>
                </tr>
                <tr>
                    <th>Kurir</th>
                    <td>{{ $order->courier->code ?? 'Tidak tersedia' }}</td>
                </tr>
                <tr>
                    <th>Perkiraan Waktu Sampai</th>
                    <td>{{ $order->formatted_estimated_delivery }}</td>
                </tr>
                <tr>
                    <th>Alamat Pengiriman</th>
                    <td>{{ $order->alamat_pengiriman }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($order->status) }}</td>
                </tr>
                <tr>
                    <th>Biaya Pengiriman</th>
                    <td>Rp{{ number_format($order->shipping_cost, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>Rp{{ number_format($order->total_jumlah, 2, ',', '.') }}</td>
                </tr>
            </table>

        </div>
        <div class="card-footer">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
