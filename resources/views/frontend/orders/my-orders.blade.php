@extends('layouts.layout-customer')

@section('content')
    <div class="container">
        <h1 >Pesanan Saya</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No Pesanan</th>
                    <th>Total Harga</th>
                    <th>Ongkir</th>
                    <th>Perkiraan Waktu Sampai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->no_pesanan }}</td>
                        <td>Rp{{ number_format($order->total_jumlah, 2) }}</td>
                        <td>Rp{{ number_format($order->shipping_cost, 2, ',', '.') }}</td>
                        <td>{{ $order->formatted_estimated_delivery }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Lihat Detail</a>
                            @if ($order->status === 'shipped')
                                <form action="{{ route('orders.update-status', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="delivered">
                                    <button type="submit" class="btn btn-success">Konfirmasi Diterima</button>
                                </form>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
