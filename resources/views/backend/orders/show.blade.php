@extends('layouts.appAdmin')

@section('title', 'Order Detail')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detail Order #{{ $order->id }}</h3>
        </div>
        <div class="card-body">
            <h5>Customer: {{ $order->user->name }}</h5>
            <h5>Kurir: {{ $order->courier->name }}</h5>
            <h5>Status: {{ ucfirst($order->status) }}</h5>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>Total Harga: {{ $order->total_price }}</h4>
        </div>
    </div>
@endsection
