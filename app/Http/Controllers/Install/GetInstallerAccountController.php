<?php

namespace App\Http\Controllers\Install;

use App\Contracts\Eloquent\UserRepositoryInterface as EloquentUserContract;
use App\Contracts\UserRepositoryInterface;
use App\Http\Requests\Installer\StoreInstallerAccountRequest;
use App\Exceptions\Repositories\Pterodactyl\ValidationException;
use Illuminate\Validation\ValidationException as BaseValidationException;
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
        return view('installer.account');
    }

    public function store(StoreInstallerAccountRequest $request)
    {
        $data = $request->validated();

        try {
            $response = $this->userRepositoryInterface->find(
                filters: ['email' => $data['email']]
            );

            if (empty($response['data'])) {
                throw BaseValidationException::withMessages([
                    'email' => [__('The email address provided is not associated with a root administrator on :attribute panel.', ['attribute' => setting('panel')])]
                ]);
            }

            if ($response['data'][0]['attributes']['root_admin']) {
                $data['pterodactyl_id'] = $response['data'][0]['attributes']['id'];

                $this->eloquentUserContract->create($data);

                setEnvironmentValue('APP_INSTALLED', 'true');

                Artisan::call('config:clear');
                Artisan::call('cache:clear');

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
