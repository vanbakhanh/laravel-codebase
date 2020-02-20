<?php

namespace App\Services\Api\Auth;

use App\Notifications\Api\ResetPasswordNotification;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Services\AbstractService;
use Carbon\Carbon;

class ForgotPasswordService extends AbstractService
{
    /**
     * @var PasswordResetRepository
     */
    private $repository;

    /**
     * ForgotPasswordService constructor.
     *
     * @param PasswordResetRepository $repository
     */
    public function __construct(PasswordResetRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle send token reset password via notification.
     *
     * @param Request $request
     * @return Notification
     */
    public function handle($request)
    {
        return $this->transaction(function () use ($request) {
            $email = $request->email;

            $record = $this->repository->updateOrCreate(
                ['email' => $email],
                [
                    'token' => create_token(6),
                    'created_at' => Carbon::now(),
                ]
            );

            $record->notify(new ResetPasswordNotification($record->token));
        });
    }
}
