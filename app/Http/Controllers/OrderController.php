<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Services\RajaOngkirService;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(
        Request $request,
        RajaOngkirService $rajaOngkir
    ) {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:qris,transfer',

            'province_id' => 'required|integer|min:1',
            'city_id' => 'required|integer|min:1',
            'district_id' => 'required|integer|min:1',

            'courier' => 'required|string',
            'shipping_service' => 'required|string',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return response()->json([
                'message' => 'Keranjang belanja kosong.'
            ], 400);
        }

        /*
     * Cari courier berdasarkan code RajaOngkir.
     */
        $courier = Courier::where('code', $validated['courier'])
            ->where('is_active', true)
            ->first();

        if (!$courier) {
            return response()->json([
                'message' => 'Kurir tidak valid atau tidak aktif.'
            ], 422);
        }

        /*
     * Hitung subtotal berdasarkan SESSION,
     * bukan berdasarkan nilai dari browser.
     */
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $totalWeight = collect($cart)->sum(function ($item) {

            return ($item['weight'] ?? 0) * $item['quantity'];
        });

        /*
     * Hitung ulang ongkir dari RajaOngkir.
     *
     * Jangan percaya shipping_cost dari frontend.
     */
        $origin = config(
            'services.rajaongkir.origin_district_id'
        );

        if (!$origin) {
            return response()->json([
                'message' => 'Origin district belum dikonfigurasi.'
            ], 500);
        }

        try {

            $shippingResults = $rajaOngkir->calculateShipping(
                origin: (int) $origin,
                destination: (int) $validated['district_id'],
                weight: $totalWeight,
                courier: $validated['courier']
            );
        } catch (\Throwable $e) {

            Log::error(
                'RajaOngkir order validation failed',
                [
                    'message' => $e->getMessage(),
                ]
            );

            return response()->json([
                'message' => 'Gagal memvalidasi ongkos kirim.'
            ], 500);
        }

        /*
     * Cari service yang dipilih user
     * dari hasil RajaOngkir.
     */
        $selectedShipping = collect($shippingResults)
            ->first(function ($shipping) use ($validated) {
                return ($shipping['service'] ?? null)
                    === $validated['shipping_service'];
            });

        if (!$selectedShipping) {
            return response()->json([
                'message' => 'Layanan pengiriman yang dipilih tidak tersedia.'
            ], 422);
        }

        $shippingCost = (int) ($selectedShipping['cost'] ?? 0);

        if ($shippingCost <= 0) {
            return response()->json([
                'message' => 'Biaya pengiriman tidak valid.'
            ], 422);
        }

        /*
     * Total dihitung SERVER.
     */
        $total = $subtotal + $shippingCost;

        /*
     * Estimasi dari RajaOngkir.
     */
        $etd = $selectedShipping['etd'] ?? null;

        $deliveryDate = now()->addDays(3);

        /*
     * Simpan order dalam transaction.
     */
        DB::beginTransaction();

        foreach ($cart as $item) {

            $product = Product::lockForUpdate()->find($item['id']);

            if (!$product) {
                throw new \Exception("Produk {$item['name']} tidak ditemukan.");
            }

            if ($product->stock < $item['quantity']) {
                throw new \Exception(
                    "Stok {$product->name} tidak mencukupi. Sisa stok: {$product->stock}"
                );
            }
        }

        try {

            $order = Order::create([
                'user_id' => auth()->id(),

                'courier_id' => $courier->id,
                'courier' => $courier->name,

                'no_pesanan' =>
                'ORD-' . strtoupper(Str::random(8)),

                'alamat_pengiriman' =>
                $validated['address'],

                'metode_pembayaran' =>
                $validated['payment_method'],

                'total_jumlah' =>
                $total,

                'shipping_cost' =>
                $shippingCost,

                'estimated_delivery' =>
                $deliveryDate,

                'status' =>
                'pending',

                'destination_province_id' =>
                $validated['province_id'],

                'destination_city_id' =>
                $validated['city_id'],

                'destination_district_id' =>
                $validated['district_id'],

                'shipping_courier_code' =>
                $validated['courier'],

                'shipping_service' =>
                $selectedShipping['service'] ?? null,

                'shipping_description' =>
                $selectedShipping['description'] ?? null,

                'shipping_etd' =>
                $etd,
            ]);

            /*
         * Simpan item order.
         */
            foreach ($cart as $item) {

                OrderItem::create([
                    'order_id' =>
                    $order->id,

                    'product_id' =>
                    $item['id'],

                    'quantity' =>
                    $item['quantity'],

                    'price' =>
                    $item['price'],
                ]);
            }

            foreach ($cart as $item) {

                Product::where('id', $item['id'])
                    ->decrement('stock', $item['quantity']);
            }

            /*
         * Kosongkan cart setelah order berhasil.
         */
            session()->forget('cart');

            DB::commit();

            Log::info(
                'Order created successfully',
                [
                    'order_id' => $order->id,
                    'order_number' => $order->no_pesanan,
                    'shipping_cost' => $shippingCost,
                ]
            );

            return response()->json([
                'message' =>
                'Pesanan berhasil dibuat.',
                'order_id' =>
                $order->id,
            ], 200);
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error(
                'Order creation failed',
                [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]
            );

            return response()->json([
                'message' =>
                $e->getMessage()
            ], 422);
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

    public function calculateShipping(
        Request $request,
        \App\Services\RajaOngkirService $rajaOngkir
    ) {
        $validated = $request->validate([
            'destination' => 'required|integer|min:1',
            'courier' => 'required|string',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang belanja kosong.'
            ], 400);
        }

        $totalWeight = collect($cart)->sum(function ($item) {
            return ($item['weight'] ?? 0) * $item['quantity'];
        });

        $origin = config('services.rajaongkir.origin_district_id');

        if (!$origin) {
            return response()->json([
                'success' => false,
                'message' => 'Origin district RajaOngkir belum dikonfigurasi.'
            ], 500);
        }

        try {

            $results = $rajaOngkir->calculateShipping(
                origin: (int) $origin,
                destination: (int) $validated['destination'],
                weight: $totalWeight,
                courier: $validated['courier']
            );

            return response()->json([
                'success' => true,
                'results' => $results,
            ]);
        } catch (\Throwable $e) {

            Log::error('RajaOngkir shipping calculation failed', [
                'origin' => $origin,
                'destination' => $validated['destination'],
                'weight' => $totalWeight,
                'courier' => $validated['courier'],
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghitung ongkos kirim.',
            ], 500);
        }
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
