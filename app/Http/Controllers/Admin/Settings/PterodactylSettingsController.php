<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Requests\Admin\Settings\UpdatePterodactylSettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class PterodactylSettingsController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $settings = [
            'pterodactyl_api_url' => setting('pterodactyl_api_url'),
            'pterodactyl_api_key' => setting('pterodactyl_api_key')
        ];

        return view('modules.admin.settings.pterodactyl', compact('settings'));
    }

    public function update(UpdatePterodactylSettingsRequest $request)
    {
        $data = $request->validated();

        Setting::updateSettings($data);

        return response()->json([
            'message' => 'Settings updated successfully.',
        ]);
    }
}
