<?php

namespace App\Services\Api\Admin\User;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use Auth;

class UpdateService extends AbstractService
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
        $user = $this->repository->find($request->route('user'));

        return $this->transaction(function () use ($request, $user) {
            $input = $request->only($this->repository->getFillable());
            $user->update($input);

            $user->profile()->update([
                'first_name' => $request['profile.first_name'],
                'last_name' => $request['profile.last_name']
            ]);

            return $user->load('profile');
        });
    }
}
