<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CalculateCartTotal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil keranjang dari session
        $cart = session('cart', []);

        // Hitung total harga
        $totalPrice = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);
        \Log::info('Total Price:', ['totalPrice' => $totalPrice]);

        // Bagikan totalPrice ke semua view
        view()->share('totalPrice', $totalPrice);

        \Log::info('Cart Session:', session('cart', []));

        return $next($request);
    }
}
