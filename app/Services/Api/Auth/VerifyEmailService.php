<?php

namespace App\Services\Api\Auth;

use App\Exceptions\Api\BadRequestException;
use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use Illuminate\Auth\Events\Verified;

class VerifyEmailService extends AbstractService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * VerifyEmailService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Verify email of user.
     *
     * @param Request $request
     * @return Response
     */
    public function handle($request)
    {
        $user = $this->repository->find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            throw new BadRequestException(trans('auth.verified'));
        }

        return $this->transaction(function () use ($user) {
            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
        });
    }
}
