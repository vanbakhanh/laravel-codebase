<?php

namespace App\Services\Web\User;

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
            $data = $request->only($this->repository->getFillable());
            $data['status'] = $request->get('status') ?: config('model.user.status.inactive');

            $user->update($data);

            return $user->profile()->update($request->only([
                'first_name',
                'last_name',
            ]));
        });
    }
}
