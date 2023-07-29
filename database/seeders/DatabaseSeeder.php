<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\Product;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Foo Bar Baz',
            'email' => 'foobarbaz@gmail.com',
            // 'full_record' => 'Ramon Elias ; eliasramondos@gmail.com',
            'password' => Hash::make('foobarbaz@gmail.com'),
        ]);

        $this->createTeam($user);

        $products_size = 10;
        $orders_size = 20;
        $qty_top = 100;

        for ($i = 0; $i < $products_size; $i++) {
            Product::factory()->create([
                'name' => 'Product '.($i + 1),
            ]);
        }

        for ($i = 0; $i < $orders_size; $i++) {
            $order = Order::factory()->create();

            $order->products()->attach(rand(1, $products_size), [
                'qty' => rand(1, $qty_top),
            ]);
        }
    }
}
