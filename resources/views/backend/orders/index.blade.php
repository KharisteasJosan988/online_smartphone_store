@extends('layouts.appAdmin')

@section('title', 'Orders List')

@section('page-title', 'Daftar Pesanan')

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No Pesanan</th>
                        <th>Status</th>
                        <th>Invoice</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->no_pesanan }}</td>
                            <td>
                                @if ($order->status === 'pending')
                                    <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Konfirmasi</button>
                                    </form>
                                @elseif ($order->status === 'processed')
                                    <form action="{{ route('orders.update-status', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="shipped">
                                        <button type="submit" class="btn btn-warning">Ship Order</button>
                                    </form>
                                @else
                                    <span>{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td><a href="{{ route('admin.orders.invoice', $order->id) }}" class="btn btn-danger">
                                    Invoice (PDF)
                                </a></td>
                            <td>
                                <a href="{{ route('orders.adminShow', $order->id) }}" class="btn btn-info">Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
