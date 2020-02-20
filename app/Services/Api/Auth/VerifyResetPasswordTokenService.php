<?php

namespace App\Services\Api\Auth;

use App\Exceptions\Api\BadRequestException;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Services\AbstractService;
use Carbon\Carbon;

class VerifyResetPasswordTokenService extends AbstractService
{
    /**
     * @var PasswordResetRepository
     */
    private $repository;

    /**
     * ResetPasswordService constructor.
     *
     * @param PasswordResetRepository $repository
     */
    public function __construct(PasswordResetRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Check exists reset password token.
     *
     * @param Request $request
     * @return bool
     *
     * @throws BadRequestException
     */
    public function handle($request)
    {
        if ($this->existsToken($request)) {
            return true;
        }

        throw new BadRequestException(trans('passwords.token'));
    }

    /**
     * Determine if a token record exists and is valid.
     *
     * @param Request $request
     * @return bool
     */
    private function existsToken($request)
    {
        $record = $this->repository->findWhere([
            'token' => $request->token,
            'email' => $request->email,
        ])->first();

        return $record && !$this->tokenExpired($record->created_at);
    }

    /**
     * Determine if the token has expired.
     *
     * @param string $createdAt
     * @return bool
     */
    private function tokenExpired($createdAt)
    {
        return Carbon::parse($createdAt)->addMinutes(config('auth.passwords.users.expire'))->isPast();
    }
}
