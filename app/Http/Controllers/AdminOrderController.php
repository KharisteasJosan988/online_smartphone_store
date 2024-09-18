<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'orderItems.product')->latest()->get();

        return view('backend.orders.index', compact('orders'));
    }

    public function confirm(Order $order)
    {
        // Konfirmasi pesanan
        $order->update(['status' => 'processed']);

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan telah dikonfirmasi.');
    }

    public function generateInvoice(Order $order)
    {
        $order->load('orderItems.product'); // Load relasi

        $pdf = Pdf::loadView('backend.orders.invoice', compact('order'));

        return $pdf->download('Invoice-' . $order->no_pesanan . '.pdf');
    }

    public function show($id)
    {
        $order = Order::with(['user', 'courier', 'orderItems.product'])->findOrFail($id);

        \Log::info('Order Courier:', ['courier' => $order->courier]);

        return view('backend.orders.detail', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate(['status' => 'required|in:pending,shipped,delivered']);
        $order->update(['status' => $validated['status']]);
        return response()->json(['success' => true]);
    }
}
