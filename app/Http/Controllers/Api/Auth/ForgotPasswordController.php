<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\AbstractController;
use App\Http\Requests\Api\Auth\ForgotPasswordRequest;
use App\Services\Api\Auth\ForgotPasswordService;

class ForgotPasswordController extends AbstractController
{
    /**
     *
     * @var ForgotPasswordService
     */
    private $forgotPasswordService;

    /**
     * Create a new controller instance.
     *
     * @param ForgotPasswordService $forgotPasswordService
     */
    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    /**
     * Send a password reset link to a user.
     *
     * @param ForgotPasswordRequest $request
     * @return Response
     */
    public function sendResetTokenEmail(ForgotPasswordRequest $request)
    {
        $this->forgotPasswordService->handle($request);
        $this->apiMessage = trans('passwords.sent');

        return $this->success();
    }
}
