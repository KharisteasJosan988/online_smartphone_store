<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Ambil data produk dengan jumlah total terjual
        $topSellingProducts = Product::select('products.id', 'products.name', 'products.image', 'products.category_id', 'products.price', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id', 'products.name', 'products.image', 'products.category_id', 'products.price')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        $iosCategoryId = Category::where('name', 'IOS')->first()->id;
        $androidCategoryId = Category::where('name', 'Android')->first()->id;

        // Ambil produk terbaru (misalnya berdasarkan created_at atau updated_at)
        $products = Product::latest()->take(10)->get(); // Ambil 10 produk terbaru

        // Produk Terlaris Berdasarkan Kategori
        $iosBestSelling = Product::bestSellingInCategory(54)->get(); // ID kategori iOS
        $androidBestSelling = Product::bestSellingInCategory(53)->get(); // ID kategori Android

        return view('frontend.homePageUser', compact('products', 'iosBestSelling', 'androidBestSelling', 'topSellingProducts', 'iosCategoryId', 'androidCategoryId'));
    }

    public function topSelling()
    {
        // Ambil data produk dengan jumlah total terjual
        $topSellingProducts = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(10) // Batasi ke 10 produk teratas
            ->get();

        // Tampilkan halaman dengan data produk
        return view('frontend.homePageUser', compact('topSellingProducts'));
    }
}
