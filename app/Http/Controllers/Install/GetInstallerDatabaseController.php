<?php

namespace App\Http\Controllers\Install;

use App\Http\Requests\Installer\StoreInstallerDatabaseRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use PDOException;

class GetInstallerDatabaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $database = [
            'database_name' => config('database.default') === 'sqlite' ? 'db.sqlite' : config('database.connections.mysql.database'),
            'database_host' => config('database.connections.mysql.host'),
            'database_port' => config('database.connections.mysql.port'),
            'database_user' => config('database.connections.mysql.username'),
            'database_password' => config('database.connections.mysql.password'),
        ];

        return view('installer.database', compact('database'));
    }

    public function store(StoreInstallerDatabaseRequest $request)
    {
        $data = $request->validated();

        $connected = $this->testDatabaseConnection($data);

        if ($connected instanceof JsonResponse) {
            return $connected;
        }

        if ($connected) {
            setEnvironmentValue('DB_CONNECTION', config('database.default'));
            setEnvironmentValue('DB_HOST', $data['database_host']);
            setEnvironmentValue('DB_PORT', $data['database_port']);
            setEnvironmentValue('DB_DATABASE', $data['database_name']);
            setEnvironmentValue('DB_USERNAME', $data['database_user']);
            setEnvironmentValue('DB_PASSWORD', $data['database_password']);

            Artisan::call('config:clear');
            Artisan::call('config:cache');

            // Use fresh migration to avoid any conflicts.
            $migrated = Artisan::call('migrate:fresh', [
                '--force' => true,
                '--seed' => true,
                '--database' => config('database.default'),
            ]);

            if ($migrated === 0) {
                return response()->json([
                    'redirect' => route('install.enviroment')
                ]);
            }

            return response()->json([
                'message' => 'Failed to migrate database.'
            ], 400);
        }
    }

    protected function testDatabaseConnection($data)
    {
        $driver = config('database.default');

        if ($driver !== 'sqlite') {
            try {
                config()->set('database.connections._test_connection', [
                    'driver' => $driver,
                    'host' => $data['database_host'],
                    'port' => $data['database_port'],
                    'database' => $data['database_name'],
                    'username' => $data['database_user'],
                    'password' => $data['database_password'],
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'strict' => true,
                ]);

                DB::connection('_test_connection')->getPdo();

                return true;
            } catch (PDOException $exception) {
                return response()->json([
                    'message' => $exception->getMessage()
                ], 400);
            } finally {
                DB::disconnect('_test_connection');
            }
        }

    }
}
