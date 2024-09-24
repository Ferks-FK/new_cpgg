<?php

namespace App\Http\Controllers\Install;

use App\Http\Requests\Installer\StoreInstallerEnviromentRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class GetInstallerEnviromentController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $enviroments = [
            'app_name' => setting('app_name', config('app.name')),
            'app_url' => setting('app_url', config('app.url')),
            'panel' => setting('panel', 'pterodactyl'),
            'panel_url' => setting('panel_url', 'https://panel.example.com'),
            'panel_api_key' => setting('panel_api_key'),
        ];

        return view('installer.enviroment', compact('enviroments'));
    }

    public function store(StoreInstallerEnviromentRequest $request)
    {
        $data = $request->validated();

        Setting::updateSettings($data);

        return response()->json([
            'redirect' => route('install.account')
        ]);
    }
}
