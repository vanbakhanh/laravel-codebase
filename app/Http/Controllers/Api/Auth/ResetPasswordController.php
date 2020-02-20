<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\AbstractController;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Services\Api\Auth\ResetPasswordService;

class ResetPasswordController extends AbstractController
{
    /**
     *
     * @var ResetPasswordService
     */
    private $resetPasswordService;

    /**
     * Create a new controller instance.
     *
     * @param ResetPasswordService $resetPasswordService
     */
    public function __construct(ResetPasswordService $resetPasswordService)
    {
        $this->resetPasswordService = $resetPasswordService;
    }

    /**
     * Reset the given user's password.
     *
     * @param ResetPasswordRequest $request
     * @return Response
     */
    public function reset(ResetPasswordRequest $request)
    {
        $this->resetPasswordService->handle($request);
        $this->apiMessage = trans('passwords.reset');

        return $this->success();
    }
}
