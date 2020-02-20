<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\AbstractController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\VerifyResetPasswordTokenRequest as VerifyTokenRequest;
use App\Services\Api\Auth\VerifyResetPasswordTokenService as VerifyTokenService;
use Illuminate\Http\Request;

class VerifyResetPasswordTokenController extends AbstractController
{
    /**
     *
     * @var VerifyTokenService
     */
    private $verifyTokenService;

    /**
     * Create a new controller instance.
     *
     * @param VerifyTokenService $verifyTokenService
     */
    public function __construct(VerifyTokenService $verifyTokenService)
    {
        $this->verifyTokenService = $verifyTokenService;
    }

    /**
     * Verify reset password token exists or not.
     *
     * @param VerifyTokenRequest $request
     * @return Response
     */
    public function verify(VerifyTokenRequest $request)
    {
        $this->verifyTokenService->handle($request);

        return $this->success();
    }
}
