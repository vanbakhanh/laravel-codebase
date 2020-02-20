<?php

namespace App\Services\Api\Auth;

use App\Exceptions\Api\BadRequestException;
use App\Services\AbstractService;
use Auth;

class SendVerificationEmailService extends AbstractService
{
    /**
     * SendVerificationEmailService constructor.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Send verification email to user.
     *
     * @param Request $request
     * @return Response
     */
    public function handle($request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            throw new BadRequestException(trans('auth.verified'));
        }

        return $this->transaction(function () use ($request) {
            $request->user()->sendEmailVerificationNotification();
        });
    }
}
