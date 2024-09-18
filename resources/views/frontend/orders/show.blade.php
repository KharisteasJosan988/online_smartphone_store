@extends('layouts.layout-customer')

@section('content')
    <div class="container">
        <h1>Detail Pesanan: {{ $order->no_pesanan }}</h1>
        <h4>Status: {{ ucfirst($order->status) }}</h4>
        <h5>Ongkos Kirim : Rp{{ number_format($order->shipping_cost, 2, ',', '.') }}</h5>
        <h5>Total Harga : Rp{{ number_format($order->total_jumlah, 2) }}</h5>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp{{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-warning"><a href="{{ route('orders.my') }}">Kembali</a></button>
    </div>
@endsection
