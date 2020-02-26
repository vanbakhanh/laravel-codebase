<?php

namespace App\Services\Api\Auth;

use App\Exceptions\Api\BadRequestException;
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
            'fcm_token',
        ]);

        $isAuthenticated = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if ($isAuthenticated) {
            return $this->transaction(function () {
                $response = $this->passportService->passwordGrantToken($data);
                $response->user = user()->load('profile');

                return $response;
            });
        }

        throw new BadRequestException(trans('auth.failed'));
    }
}
