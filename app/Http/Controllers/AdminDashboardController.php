<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Courier;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCategories = Category::count();
        $totalCouriers = Courier::count();
        $orders = Order::with('user')
            ->latest()
            ->take(10)
            ->get();
        $recentProducts = Product::latest()->take(5)->get();
        $monthlyRecap = Order::selectRaw('MONTH(created_at) as month, SUM(total_jumlah) as total_sales')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Mengubah data menjadi format yang sesuai untuk grafik
        $salesData = [];
        $months = [];

        foreach ($monthlyRecap as $order) {
            $salesData[] = $order->total_sales;
            $months[] = Carbon::createFromFormat('m', $order->month)->format('F');
        }

        return view('layouts.dashboardAdmin', compact('totalProducts', 'totalOrders', 'totalCategories', 'totalCouriers', 'orders', 'recentProducts', 'salesData', 'months'));
    }
}
