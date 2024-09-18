<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function homePage()
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

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'customer') {
                return redirect()->route('customer.home');
            } elseif (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function adminLogin(Request $request)
    {
        // Validasi input login admin
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah atau Anda bukan admin.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
