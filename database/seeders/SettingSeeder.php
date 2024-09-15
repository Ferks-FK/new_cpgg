<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: Remove when install page is implemented.
        if (config('app.debug') === true) {
            $settings = [
                'pterodactyl_api_url' => env('PTERODACTYL_API_URL'),
                'pterodactyl_api_key' => env('PTERODACTYL_API_KEY')
            ];

            Setting::updateSettings($settings);
        }
    }
}
