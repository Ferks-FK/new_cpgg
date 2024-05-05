<?php

namespace Database\Seeders;

use App\Models\StoreCategory;
use Illuminate\Database\Seeder;

class StoreCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreCategory::create([
            'name' => 'Credits',
            'description' => 'Credits is a billing system that is charged hourly to your servers.',
            'active' => true,
        ]);

        StoreCategory::create([
            'name' => 'Servers',
            'description' => 'Server slot is the number of servers you can create for your account.',
            'active' => true,
        ]);
    }
}
