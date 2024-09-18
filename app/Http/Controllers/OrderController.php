<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

                $response = Http::withHeaders([
                    'key' => 'a1f8c6744907bd7f1c56679d33c78008',
                ])->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => $request->input('city_id'), // ID kota asal
                    'destination' => $request->input('destination'), // ID kota tujuan
                    'weight' => $request->input('weight'), // Berat dalam gram
                    'courier' => strtolower($courier->code), // Kode kurir (jne, pos, tiki, dll.)
                ]);

                Log::info('Mengirim data ke RajaOngkir:', [
                    'origin' => $request->input('city_id'),
                    'destination' => $request->input('destination'),
                    'weight' => $request->input('weight'),
                    'courier' => strtolower($courier->code),
                ]);

                Log::info('Response dari RajaOngkir:', $response->json());

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['rajaongkir']['results']) && count($data['rajaongkir']['results']) > 0) {
                        $results = $response->json()['rajaongkir']['results'][0]['costs'] ?? [];
                        $selectedService = $results[0] ?? null; // Pilih layanan pertama sebagai contoh

                        $estimatedDelivery = $selectedService['cost'][0]['etd'] ?? 'Tidak tersedia';

                        // Proses rentang waktu (misalnya "1-2")
                        if (strpos($estimatedDelivery, '-') !== false) {
                            [$minDays, $maxDays] = explode('-', $estimatedDelivery);
                            $deliveryDate = now()->addDays((int) $maxDays); // Gunakan nilai maksimum
                        } elseif (is_numeric($estimatedDelivery)) {
                            $deliveryDate = now()->addDays((int) $estimatedDelivery);
                        } else {
                            $deliveryDate = null; // Jika tidak valid, tetap null
                        }

                        Log::info('ETD from RajaOngkir:', ['etd' => $estimatedDelivery]);

                        $order = Order::create([
                            'user_id' => auth()->id(),
                            'courier_id' => $courier->id,
                            'no_pesanan' => 'ORD-' . strtoupper(Str::random(8)), // Nomor pesanan unik
                            'alamat_pengiriman' => $request->input('address'), // Sesuaikan dengan input field
                            'metode_pembayaran' => $request->input('payment_method'),
                            'total_jumlah' => $request->input('total_jumlah'),
                            'shipping_cost' => $request->input('shipping_cost'),
                            'estimated_delivery' => $deliveryDate ?? now()->addDays(7), // Default jika tidak tersedia
                            'status' => 'pending',
                        ]);
                    } else {
                        Log::error('Respon kosong dari RajaOngkir.', $data);
                        return response()->json(['message' => 'Tidak ada data pengiriman tersedia.'], 400);
                    }
                } else {
                    Log::error('Error dari API RajaOngkir:', $response->json());
                    return response()->json(['message' => 'Gagal mengambil data ongkos kirim.'], 500);
                }

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
                Log::error('Error during checkout: ' . $e->getMessage());
                return response()->json(['message' => 'Terjadi kesalahan saat memproses pesanan.'], 500);
            }
            Log::info('Order Created Successfully', ['order_id' => $order->id]);
            return response()->json(['message' => 'Pesanan berhasil dibuat.'], 200);
        } catch (\Exception $e) {
            Log::error('Error during checkout', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Terjadi kesalahan saat memproses pesanan.'], 500);
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
        Log::info('calculateShipping called', $request->all()); // Tambah log awal

        $request->validate([
            'city_id' => 'required|integer',
            'destination' => 'required|integer',
            'weight' => 'required|integer|min:1',
            'courier_id' => 'required|integer',
        ]);

        Log::info('Validation passed', $request->all()); // Tambah log setelah validasi

        $courier = Courier::find($request->courier_id);
        if (!$courier) {
            Log::error('Invalid courier ID', ['courier_id' => $request->courier_id]);
            return response()->json([
                'success' => false,
                'message' => 'Kurir tidak valid.',
            ], 400);
        }

        Log::info('Mengirim request ke RajaOngkir', [
            'origin' => $request->city_id,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => strtolower($courier->code),
        ]);

        try {
            $response = Http::withHeaders([
                'key' => 'a1f8c6744907bd7f1c56679d33c78008', // Pastikan sesuai
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $request->city_id,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => strtolower($courier->code),
            ]);

            Log::info('RajaOngkir response:', $response->json());
        } catch (\Exception $e) {
            Log::error('API Error:', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Gagal mengambil data ongkos kirim.'], 500);
        }

        if ($response->failed()) {
            Log::error('API RajaOngkir gagal', ['response' => $response->json()]);
            return response()->json([
                'success' => false,
                'message' => $response->json()['rajaongkir']['status']['description'] ?? 'Gagal mengakses API.',
            ], 400);
        }

        Log::info('Using API Key', ['key' => env('RAJAONGKIR_API_KEY')]);
        Log::info('Request payload:', $request->all());

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'results' => $response->json()['rajaongkir']['results'] ?? [],
            ]);
        }

        Log::error('RajaOngkir API call failed', ['response' => $response->json()]);
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengambil data ongkos kirim. Pastikan data sudah benar atau hubungi admin.',
        ], 500);
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
