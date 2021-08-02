<?php

namespace App\Services\Web\User;

use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Services\AbstractService;

class EditService extends AbstractService
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
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function handle($request)
    {
        $user = $this->userRepository->find($request->route('user'));
        $roles = $this->roleRepository->pluck('name', 'id');
        $gaveRole = $user->roles()->pluck('name', 'id');

        return compact('user', 'roles', 'gaveRole');
    }
}
