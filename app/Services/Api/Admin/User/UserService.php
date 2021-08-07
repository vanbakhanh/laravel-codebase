<?php

namespace App\Services\Api\Admin\User;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;

class UserService extends AbstractService
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

    public function create($request)
    {
        $input = $request->only($this->repository->getFillable());
        $input['status'] = $request->get('status') ?: config('model.user.status.inactive');

        return $this->transaction(function () use ($request, $input) {
            $password = random_password();
            $input['password'] = $password;
            $user = $this->repository->create($input);

            $user->sendEmailGeneratePasswordNotification($password);

            $user->profile()->create($request->only([
                'first_name',
                'last_name',
            ]));

            return $user->load('profile');
        });
    }

    public function update($request)
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

    public function show($request)
    {
        return $this->repository->find($request->route('user'))->load('profile');
    }

    public function list($request)
    {
        return $this->repository->with('profile')->paginate(config('constants.pagination'));
    }

    public function delete($request)
    {
        return $this->transaction(function () use ($request) {
            $user = $this->repository->find($request->route('user'));

            $user->profile()->delete();
            return $user->delete();
        });
    }
}
