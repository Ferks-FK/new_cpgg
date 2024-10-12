<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Requests\Admin\Settings\UpdateGlobalSettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class GlobalSettingsController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $settings = [
            'app_name' => setting('app_name'),
            'app_url' => setting('app_url'),
            'favicon' => setting('favicon'),
            'logo' => setting('logo'),
            'timezone' => setting('timezone'),
            'locale' => setting('locale'),
            'credits_display' => setting('credits_display'),
        ];

        return view('modules.admin.settings.global', compact('settings'));
    }

    public function update(UpdateGlobalSettingsRequest $request)
    {
        $data = $request->validated();

        Setting::updateSettings($data);

        return response()->json([
            'message' => 'Settings updated successfully.',
        ]);
    }
}
