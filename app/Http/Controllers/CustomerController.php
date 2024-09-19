<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Ambil semua produk yang tersedia dari database
        $products = Product::all();

        // Tampilkan view 'customer.home' dengan data produk yang tersedia
        return view('frontend.homePageUser', compact('products'));
    }

    public function showProduct($id)
    {
        // Ambil data produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Tampilkan view 'customer.product-detail' dengan data produk yang dipilih
        return view('customer.product-detail', compact('product'));
    }

    public function profile()
    {
        // Ambil data user yang sedang login
        $user = auth()->user();

        // Tampilkan view 'customer.profile' dengan data user
        return view('customer.profile', compact('user'));
    }

    // public function updateProfile(Request $request)
    // {
    //     // Validasi input yang diterima
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
    //         'password' => 'nullable|string|min:8|confirmed',
    //     ]);

    //     // Ambil data user yang sedang login
    //     $user = auth()->user();

    //     // Update data user dengan input yang diberikan
    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');

    //     // Jika password diberikan, maka update password
    //     if ($request->filled('password')) {
    //         $user->password = bcrypt($request->input('password'));
    //     }

    //     // Simpan perubahan ke database
    //     $user->save();

    //     // Redirect ke halaman profil dengan pesan sukses
    //     return redirect()->route('customer.profile')->with('success', 'Profil berhasil diperbarui.');
    // }
}
