<?php

namespace App\Services\Api\Auth;

use App\Exceptions\Api\NotFoundException;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;

class ResetPasswordService extends AbstractService
{
    /**
     * @var PasswordResetRepository
     */
    private $repository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ResetPasswordService constructor.
     *
     * @param PasswordResetRepository $repository
     * @param UserRepository $userRepository
     */
    public function __construct(
        PasswordResetRepository $repository,
        UserRepository $userRepository
    ) {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * Handle reset user's password.
     *
     * @param Request $request
     * @return bool
     *
     * @throws NotFoundException
     */
    public function handle($request)
    {
        return $this->transaction(function () use ($request) {
            $user = $this->userRepository->findByField('email', $request->email)->first();
            $user->update(['password' => $request->password]);

            $this->repository->deleteWhere(['email' => $user->email]);
        });
    }
}
