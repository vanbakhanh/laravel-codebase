<?php

namespace App\Services\Web\User;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use App\Repositories\Contracts\RoleRepository;

class UserService extends AbstractService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function list($request)
    {
        return $this->userRepository->with('profile')->paginate(config('constants.pagination'));
    }

    public function show($request)
    {
        return $this->userRepository->find($request->route('user'));
    }

    public function create($request)
    {
        $roles = $this->roleRepository->pluck('name', 'id');

        return compact('roles');
    }

    public function store($request)
    {
        $input = $request->only($this->userRepository->getFillable());
        $input['status'] = $request->get('status') ?: config('model.user.status.inactive');
        $password = random_password();
        $input['password'] = $password;
        $roles = $request->only('roles');

        return $this->transaction(function () use ($request, $input, $password, $roles) {
            $user = $this->userRepository->create($input);

            $user->profile()->create($request->only([
                'first_name',
                'last_name',
            ]));

            $user->syncRoles($roles);

            $user->sendEmailGeneratePasswordNotification($password);

            return $user;
        });
    }

    public function edit($request)
    {
        $user = $this->userRepository->find($request->route('user'));
        $roles = $this->roleRepository->pluck('name', 'id');
        $gaveRole = $user->roles()->pluck('name', 'id');

        return compact('user', 'roles', 'gaveRole');
    }

    public function update($request)
    {
        $user = $this->userRepository->find($request->route('user'));
        $data = $request->only($this->userRepository->getFillable());
        $data['status'] = $request->get('status') ?: config('model.user.status.inactive');
        $roles = $request->only('roles');

        return $this->transaction(function () use ($request, $user, $data, $roles) {
            $user->update($data);

            $user->profile()->update($request->only([
                'first_name',
                'last_name',
            ]));

            $user->syncRoles($roles);

            return $user;
        });
    }

    public function delete($request)
    {
        return $this->transaction(function () use ($request) {
            $user = $this->userRepository->find($request->route('user'));

            if ($user->is(user())) {
                return false;
            }

            $user->profile()->delete();
            return $user->delete();
        });
    }
}
