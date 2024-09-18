<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details,
        .summary {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .no-border {
            border: none !important;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <h1>Invoice</h1>
        <p>No Pesanan: {{ $order->no_pesanan }}</p>
        <p>Tanggal: {{ $order->created_at->format('d-m-Y') }}</p>
    </div>

    <div class="invoice-details">
        <h3>Detail Pesanan</h3>
        <table>
            <tr>
                <th>Nama Customer</th>
                <td>{{ $order->user->name }}</td>
            </tr>
            <tr>
                <th>Alamat Pengiriman</th>
                <td>{{ $order->alamat_pengiriman }}</td>
            </tr>
            <tr>
                <th>Metode Pembayaran</th>
                <td>{{ ucfirst($order->metode_pembayaran) }}</td>
            </tr>
            <tr>
                <th>Kurir</th>
                <td>{{ $order->courier->name ?? 'Tidak tersedia' }}</td>
            </tr>
            <tr>
                <th>Perkiraan Waktu Tiba</th>
                <td>{{ $order->estimated_delivery ?? 'Tidak tersedia' }}</td>
            </tr>

            <tr>
                <th>Ongkos Kirim</th>
                <td>Rp{{ number_format($order->shipping_cost, 2, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="summary">
        <h3>Detail Produk</h3>
        <table>
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
                        <td>Rp{{ number_format($item->price, 2, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp{{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h3>Total Harga</h3>
    <table>
        <tr>
            <th>Total Harga Produk</th>
            @foreach ($order->orderItems as $item)
                <td>Rp{{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
            @endforeach
        </tr>
        <tr>
            <th>Ongkos Kirim</th>
            <td>Rp{{ number_format($order->shipping_cost, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Keseluruhan</th>
            <td>Rp{{ number_format($item->price * $item->quantity + $order->shipping_cost, 2, ',', '.') }}</td>
        </tr>
    </table>
</body>

</html>
