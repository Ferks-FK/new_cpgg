<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Starter',
            'description' => '64MB Ram, 1GB Disk, 1 Database, 140 credits monthly',
            'price' => 140,
            'memory' => 64,
            'cpu' => 1,
            'swap' => 0,
            'disk' => 1024,
            'io' => 500,
            'databases' => 1,
            'backups' => 0,
            'allocations' => 1,
        ]);

        Product::create([
            'name' => 'Standard',
            'description' => '128MB Ram, 2GB Disk, 2 Database,  210 credits monthly',
            'price' => 210,
            'memory' => 128,
            'cpu' => 2,
            'swap' => 0,
            'disk' => 2048,
            'io' => 500,
            'databases' => 2,
            'backups' => 1,
            'allocations' => 2,
        ]);

        Product::create([
            'name' => 'Advanced',
            'description' => '256MB Ram, 5GB Disk, 5 Database,  280 credits monthly',
            'price' => 280,
            'memory' => 256,
            'cpu' => 3,
            'swap' => 0,
            'disk' => 3072,
            'io' => 500,
            'databases' => 5,
            'backups' => 2,
            'allocations' => 3,
        ]);
    }
}
