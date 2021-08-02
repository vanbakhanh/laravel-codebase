<?php

namespace App\Services\Web\Role;

use App\Repositories\Contracts\RoleRepository;
use App\Services\AbstractService;
use App\Repositories\Contracts\PermissionRepository;

class EditService extends AbstractService
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
        $role = $this->roleRepository->findOrFail($request->route('role'));
        $permissions = $this->permissionRepository->all()->pluck('name', 'id');
        $gavePermission = $role->permissions()->pluck('name', 'id');

        return compact('role', 'permissions', 'gavePermission');
    }
}
