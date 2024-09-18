<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Product;
use App\Models\Province;
use Illuminate\Http\Request;

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

    public function index()
    {
        $provinsi = Province::select('id', 'province')->get();

        $cities = City::all();

        $cart = session('cart', []);
        $totalPrice = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        $categories = \App\Models\Category::all();
        $brands = Product::select('merk')->distinct()->get();
        $products = Product::with('category')->get();

        \Log::info('Rendering View frontend.checkout');

        return view('frontend.checkout', compact('provinsi', 'cart', 'totalPrice', 'categories', 'brands', 'products', 'cities'));
    }

    public function getCitiesByProvince(Request $request)
    {
        $provinceId = $request->province_id;
        $cities = City::where('province_id', $provinceId)->get();

        return response()->json($cities);
    }
}
