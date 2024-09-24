<?php

namespace App\Http\Controllers\Install;

use Illuminate\Http\Request;

class GetInstallerRequirementsController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $phpIsSupported = version_compare(phpversion(), '8.2', '>=');

        $extensions = [
            'cURL' => 'curl',
            'BCMath' => 'bcmath',
            'JSON' => 'json',
            'mbstring' => 'mbstring',
            'mySQL' => 'pdo_mysql',
            'GD' => 'gd',
            'Zip' => 'zip',
            'XML' => 'xml',
            'openssl' => 'openssl',
        ];

        $extensions = collect($extensions)->map(function ($extension, $name) {
            return [
                'name' => $name,
                'installed' => extension_loaded($extension),
            ];
        })->toArray();

        $installedExtensions = array_filter($extensions, function($extension) {
            return $extension['installed'] === true;
        });

        $missingExtensions = array_filter($extensions, function($extension) {
            return $extension['installed'] === false;
        });

        $installedNames = implode(', ', array_map(fn($ext) => $ext['name'], $installedExtensions));
        $missingNames = implode(', ', array_map(fn($ext) => $ext['name'], $missingExtensions));

        $extensions = [
            'installed' => $installedNames,
            'missing' => $missingNames,
        ];

        $directories = [
            'Storage' => storage_path(),
            'Cache' => base_path('bootstrap/cache'),
        ];

        $checkPermissions = function ($path) {
            $perms = substr(sprintf('%o', fileperms($path)), -3);

            return $perms === '755';
        };

        $permissions = collect($directories)->mapWithKeys(function ($path, $name) use ($checkPermissions) {
            return [$name => $checkPermissions($path)];
        });

        $allPermissionsCorrect = $permissions->every(function ($permission) {
            return $permission;
        });

        $allFolderNames = $permissions->keys()->implode(', ');

        $requirements = [
            'php' => [
                'isSupported' => $phpIsSupported,
                'current' => phpversion(),
                'required' => '8.2',
                'extensions' => $extensions,
            ],
            'directories' => [
                'folders' => $allFolderNames,
                'allCorrect' => $allPermissionsCorrect,
            ],
        ];

        return view('installer.requirements', compact('requirements'));
    }
}
