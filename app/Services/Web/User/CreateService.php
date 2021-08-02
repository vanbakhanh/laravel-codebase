<?php

namespace App\Services\Web\User;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use App\Repositories\Contracts\RoleRepository;

class CreateService extends AbstractService
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

    public function handle($request)
    {
        $roles = $this->roleRepository->pluck('name', 'id');

        return compact('roles');
    }
}
