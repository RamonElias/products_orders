<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $products_size = 10;
        $orders_size = 20;
        $qty_top = 100;

        Product::factory($products_size)->create();

        for ($i = 0; $i < $orders_size; $i++) {
            $order = Order::factory()->create();

            $order->products()->attach(rand(1, $products_size), [
                'qty' => rand(1, $qty_top),
            ]);
        }
    }
}
