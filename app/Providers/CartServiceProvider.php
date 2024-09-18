<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Menggunakan View Composer untuk menyediakan data keranjang di semua views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
                $totalQuantity = $cartItems->sum('quantity');
                $totalPrice = $cartItems->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });
            } else {
                $cartItems = collect(); // Kosongkan keranjang jika belum login
                $totalQuantity = 0;
                $totalPrice = 0;
            }

            // Kirim data ke view
            $view->with(compact('cartItems', 'totalQuantity', 'totalPrice'));
        });
    }
}
