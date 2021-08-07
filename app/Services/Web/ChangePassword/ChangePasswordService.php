<?php

namespace App\Services\Web\ChangePassword;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use Hash;

class ChangePasswordService extends AbstractService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * ChangePasswordService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle change password user.
     *
     * @param Request $request
     * @return Response
     */
    public function handle($request)
    {
        $user = user();

        if (Hash::check($request->current_password, $user->password)) {
            return $this->transaction(function () use ($request, $user) {
                return $user->update(['password' => $request->password]);
            });
        }

        return false;
    }
}
