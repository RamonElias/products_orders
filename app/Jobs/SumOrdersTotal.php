<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Record;
use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SumOrdersTotal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orders_total = 0;

        $orders = Order::with('products')->get();

        foreach ($orders as $order) {
            $this_order_total = $order->products[0]->cost * $order->products[0]->pivot->qty;

            $orders_total = $orders_total + $this_order_total;
        }

        $orders_total = $orders_total / 100; // Move the expresion to decimal values

        Record::create([
            'orders_total_sum' => $orders_total,
        ]);
    }
}
