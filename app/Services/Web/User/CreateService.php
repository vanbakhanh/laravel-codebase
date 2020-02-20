<?php

namespace App\Services\Web\User;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use Auth;

class CreateService extends AbstractService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($request)
    {
        $input = $request->only($this->repository->getFillable());
        $input['status'] = $request->get('status') ?: config('model.user.status.inactive');

        return $this->transaction(function () use ($request, $input) {
            $password = random_password();
            $input['password'] = $password;
            $user = $this->repository->create($input);

            $user->sendEmailGeneratePasswordNotification($password);

            return $user->profile()->create($request->only([
                'first_name',
                'last_name',
            ]));
        });
    }
}
