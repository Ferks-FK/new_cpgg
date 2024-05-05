<?php

namespace Database\Seeders;

use App\Models\StoreProduct;
use Illuminate\Database\Seeder;

class StoreProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreProduct::create([
            'name' => '200 Credits',
            'description' => '200 Credits',
            'price' => 10.00,
            'quantity' => 200,
            'category_id' => 1,
        ]);

        StoreProduct::create([
            'name' => '400 Credits',
            'description' => '400 Credits',
            'price' => 20.00,
            'quantity' => 400,
            'category_id' => 1,
        ]);

        StoreProduct::create([
            'name' => '5 Server Slots',
            'description' => '5 Server Slots',
            'type' => 'slots',
            'price' => 30.00,
            'quantity' => 5,
            'category_id' => 2,
        ]);
    }
}
