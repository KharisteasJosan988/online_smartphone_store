<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schedule;

class UpdateOrderStatus extends Command
{
    protected $signature = 'orders:update-status';
    protected $description = 'Update status orders yang sudah melewati estimated delivery';

    public function handle()
    {
        $orders = Order::where('status', 'pending')
            ->whereDate('estimated_delivery', '<=', now())
            ->get();

        foreach ($orders as $order) {
            $order->update(['status' => 'shipped']);
            $this->info("Pesanan #{$order->id} telah diubah menjadi shipped.");
        }
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('orders:update-status')->daily();
    }
}
