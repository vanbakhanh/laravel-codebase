<?php

namespace App\Services\Api\Admin\Auth;

use App\Exceptions\Api\UnauthorizedException;
use App\Services\AbstractService;
use App\Services\Api\Passport\PassportService;
use Auth;

class LoginService extends AbstractService
{
    /**
     * @var PassportService
     */
    private $passportService;

    /**
     * LoginService constructor.
     *
     * @param PassportService $passportService
     */
    public function __construct(PassportService $passportService)
    {
        $this->passportService = $passportService;
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return Response
     */
    public function handle($request)
    {
        $data = $request->only([
            'email',
            'password',
            'client_id',
            'client_secret',
        ]);

        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            $responses = $this->transaction(function () use ($data) {
                return $this->passportService->passwordGrantToken($data);
            });
            $responses->user = auth()->user()->load('profile');
            $responses->permissions = auth()->user()->getPermissionsViaRoles();

            return $responses;
        }

        throw new UnauthorizedException(trans('auth.failed'));
    }
}
