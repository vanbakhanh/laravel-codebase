<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\AbstractController;
use App\Services\Api\Auth\SendVerificationEmailService;
use App\Services\Api\Auth\VerifyEmailService;
use Illuminate\Http\Request;

class VerificationController extends AbstractController
{
    /**
     * @var SendVerificationEmailService
     */
    private $sendVerificationEmailService;

    /**
     * @var VerifyEmailService
     */
    private $verifyEmailService;

    /**
     * Create a new controller instance.
     *
     * @param SendVerificationEmailService $sendVerificationEmailService
     */
    public function __construct(
        SendVerificationEmailService $sendVerificationEmailService,
        VerifyEmailService $verifyEmailService
    ) {
        $this->sendVerificationEmailService = $sendVerificationEmailService;
        $this->verifyEmailService = $verifyEmailService;
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  Request  $request
     * @return Response
     */
    public function verify(Request $request)
    {
        $this->verifyEmailService->handle($request);
        $this->apiMessage = trans('auth.verify');

        return $this->success();
    }

    /**
     * Resend the email verification notification.
     *
     * @param Request $request
     * @return Response
     */
    public function resend(Request $request)
    {
        $this->sendVerificationEmailService->handle($request);
        $this->apiMessage = trans('auth.sent');

        return $this->success();
    }
}
