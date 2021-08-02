<?php

namespace App\Services\Web\Role;

use App\Repositories\Contracts\RoleRepository;
use App\Services\AbstractService;
use App\Repositories\Contracts\PermissionRepository;

class CreateService extends AbstractService
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * RoleService constructor.
     *
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function handle($request)
    {
        $permissions = $this->permissionRepository->all()->pluck('name', 'id');

        return compact('permissions');
    }
}
