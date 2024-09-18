<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'customer') {
            return $next($request);
        }

        // Redirect jika user bukan customer
        return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
