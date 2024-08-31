<?php

namespace Database\Seeders;

use App\Models\Gateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gateways = [
            [
                'image' => 'stripe.svg',
                'name' => 'Stripe',
                'type' => 'stripe',
                'data' => [
                    'public_key' => 'pk_test_1234567890',
                    'secret_key' => 'sk_test_1234567890',
                    'webhook_secret' => 'whsec_1234567890'
                ],
                'active' => true,
            ],
            [
                'image' => 'paypal.svg',
                'name' => 'PayPal',
                'type' => 'paypal',
                'data' => [
                    'email' => 'paypal@paypal.com'
                ],
                'active' => false,
            ]
        ];

        foreach ($gateways as $gateway) {
            Gateway::create($gateway);
        }
    }
}
