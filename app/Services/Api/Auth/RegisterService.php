<?php

namespace App\Services\Api\Auth;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;

class RegisterService extends AbstractService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * RegisterService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle create user and send verification email.
     *
     * @param Request $request
     * @return array
     */
    public function handle($request)
    {
        return $this->transaction(function () use ($request) {
            $user = $this->repository->create($request->only($this->repository->getFillable()));
            $user->profile()->create($request->only([
                'first_name',
                'last_name',
            ]));
            $user->sendEmailVerificationNotification();

            return $user->load('profile');
        });
    }
}
