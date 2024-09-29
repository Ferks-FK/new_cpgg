<?php

namespace App\Http\Controllers\Install;

use App\Contracts\Eloquent\UserRepositoryInterface as EloquentUserContract;
use App\Contracts\UserRepositoryInterface;
use App\Http\Requests\Installer\StoreInstallerAccountRequest;
use App\Exceptions\Repositories\Pterodactyl\ValidationException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class GetInstallerAccountController
{
    /**
     * The user repository instance.
     */
    public function __construct(
        protected UserRepositoryInterface $userRepositoryInterface,
        protected EloquentUserContract $eloquentUserContract)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $account = [];

        return view('installer.account', compact('account'));
    }

    public function store(StoreInstallerAccountRequest $request)
    {
        $data = $request->validated();

        try {
            $response = $this->userRepositoryInterface->find(
                filters: ['email' => $data['email']]
            );

            if ($response['data'][0]['attributes']['root_admin']) {
                $this->eloquentUserContract->create($data);

                setEnvironmentValue('APP_INSTALLED', 'true');

                Artisan::call('config:clear');
                Artisan::call('config:cache');

                return response()->json([
                    'message' => 'User created successfully',
                    'redirect' => route('login.view')
                ]);
            }

            return response()->json([
                'message' => 'For security reasons, a non-administrator account cannot be used to install this panel.'
            ], 400);
        } catch (ValidationException $exception) {
            $exception->throwValidationException();
        } finally {
            unset($data['username']);
        }
    }
}
