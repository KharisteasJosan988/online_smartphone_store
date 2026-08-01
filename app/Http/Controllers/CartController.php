<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\RajaOngkirService;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Product::find($productId);

        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        $cart = session('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
                'weight' => $product->weight,
            ];
        }

        session(['cart' => $cart]);


        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function index(RajaOngkirService $rajaOngkir)
    {
        $provinsi = $rajaOngkir->getProvinces();

        $cart = session('cart', []);

        $totalPrice = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        $totalWeight = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['weight'] * $item['quantity']);
        }, 0);

        $categories = \App\Models\Category::all();
        $brands = Product::select('merk')->distinct()->get();
        $products = Product::with('category')->get();

        \Log::info('Rendering View frontend.checkout');

        return view('frontend.checkout', compact(
            'provinsi',
            'cart',
            'totalPrice',
            'totalWeight',
            'categories',
            'brands',
            'products'
        ));
    }

    public function getCitiesByProvince(
        Request $request,
        RajaOngkirService $rajaOngkir
    ) {
        $provinceId = $request->integer('province_id');

        if (!$provinceId) {
            return response()->json([
                'message' => 'Province ID wajib diisi.'
            ], 422);
        }

        try {
            $cities = $rajaOngkir->getCities($provinceId);

            return response()->json($cities);
        } catch (\Throwable $e) {
            \Log::error('RajaOngkir get cities error', [
                'province_id' => $provinceId,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Gagal mengambil data kota dari RajaOngkir.'
            ], 500);
        }
    }

    public function getDistrictsByCity(
        Request $request,
        RajaOngkirService $rajaOngkir
    ) {
        $cityId = $request->integer('city_id');

        if (!$cityId) {
            return response()->json([
                'message' => 'City ID wajib diisi.'
            ], 422);
        }

        try {
            $districts = $rajaOngkir->getDistricts($cityId);

            return response()->json($districts);
        } catch (\Throwable $e) {
            \Log::error('RajaOngkir get districts error', [
                'city_id' => $cityId,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Gagal mengambil data kecamatan dari RajaOngkir.'
            ], 500);
        }
    }
}
