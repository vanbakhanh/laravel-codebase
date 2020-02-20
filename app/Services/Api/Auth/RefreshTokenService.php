<?php

namespace App\Services\Api\Auth;

use App\Services\AbstractService;
use App\Services\Api\Passport\PassportService;
use Auth;

class RefreshTokenService extends AbstractService
{
    /**
     * @var PassportService
     */
    private $passportService;

    /**
     * RefreshTokenService constructor.
     *
     * @param PassportService $passportService
     */
    public function __construct(PassportService $passportService)
    {
        $this->passportService = $passportService;
    }

    /**
     * Handle refresh access token.
     *
     * @param Request $request
     * @return Response
     */
    public function handle($request)
    {
        $data = $request->only([
            'refresh_token',
            'client_id',
            'client_secret',
        ]);

        return $this->transaction(function () use ($data) {
            return $this->passportService->refreshGrantToken($data);
        });
    }
}
