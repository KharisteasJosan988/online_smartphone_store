<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Order Creation Process Start');

        try {
            // Validasi input
            $request->validate([
                'address' => 'required|string',
                'payment_method' => 'required|string',
                'courier_id' => 'required|integer|exists:couriers,id',
                'shipping_cost' => 'required|numeric',
                'weight' => 'required|numeric',
                'city_id' => 'required|integer', // Tambahkan validasi
                'destination' => 'required|integer', // Tambahkan validasi
            ]);

            Log::info('Request Data:', $request->all());

            try {
                $cart = session('cart', []);
                if (empty($cart)) {
                    return response()->json(['message' => 'Keranjang belanja kosong.'], 400);
                }

                $courierid = $request->input('courier_id');

                // Cari ID kurir berdasarkan kode
                $courier = Courier::find($request->input('courier_id'));
                if (!$courier) {
                    return response()->json(['message' => 'Kurir tidak valid.'], 400);
                }

                $deliveryDate = now()->addDays(3);

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'courier_id' => $courier->id,
                    'no_pesanan' => 'ORD-' . strtoupper(Str::random(8)),
                    'alamat_pengiriman' => $request->input('address'),
                    'metode_pembayaran' => $request->input('payment_method'),
                    'total_jumlah' => $request->input('total_jumlah'),
                    'shipping_cost' => $request->input('shipping_cost'),
                    'estimated_delivery' => $deliveryDate,
                    'status' => 'pending',
                ]);

                // Simpan item pesanan
                foreach ($cart as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }

                // Kosongkan keranjang
                session()->forget('cart');

                Log::info('Request Data: ' . json_encode($request->all()));

                return response()->json(['message' => 'Pesanan berhasil dibuat.'], 200);
            } catch (\Exception $e) {

                return response()->json([
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ], 500);
            }
            Log::info('Order Created Successfully', ['order_id' => $order->id]);
            return response()->json(['message' => 'Pesanan berhasil dibuat.'], 200);
        } catch (\Exception $e) {
            dd(
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
        }
    }

    public function myOrders()
    {
        $user = auth()->user(); // Ambil user yang sedang login

        // Ambil pesanan berdasarkan user yang login
        $orders = Order::with('orderItems.product')->where('user_id', $user->id)->latest()->get();

        return view('frontend.orders.my-orders', compact('orders'));
    }

    public function show(Order $order)
    {
        // $this->authorize('view', $order); // Pastikan user hanya dapat melihat pesanan mereka sendiri
        $order->load('orderItems.product'); // Load relasi

        return view('frontend.orders.show', compact('order'));
    }

    public function calculateShipping(Request $request)
    {
        $request->validate([
            'city_id' => 'required',
            'destination' => 'required',
            'weight' => 'required',
            'courier_id' => 'required',
        ]);

        return response()->json([
            'success' => true,
            'results' => [
                [
                    'code' => 'jne',
                    'name' => 'JNE',
                    'costs' => [
                        [
                            'service' => 'REG',
                            'description' => 'Layanan Reguler',
                            'cost' => [
                                [
                                    'value' => 15000,
                                    'etd' => '2-3',
                                    'note' => ''
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:shipped,delivered',
        ]);

        if ($request->status === 'shipped' && $order->status !== 'processed') {
            return back()->with('error', 'Pesanan belum diproses, tidak bisa diubah ke Shipped.');
        }

        if ($request->status === 'delivered' && $order->status !== 'shipped') {
            return back()->with('error', 'Pesanan belum dikirim, tidak bisa diubah ke Delivered.');
        }

        $order->update(['status' => $request->status]);

        $message = $request->status === 'shipped'
            ? 'Status berhasil diubah menjadi Shipped.'
            : 'Status berhasil diubah menjadi Delivered.';

        return back()->with('success', $message);
    }
}
