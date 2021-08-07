<?php

namespace App\Services\Web\Role;

use App\Repositories\Contracts\RoleRepository;
use App\Services\AbstractService;
use App\Repositories\Contracts\PermissionRepository;

class RoleService extends AbstractService
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

    public function list($request)
    {
        return $this->roleRepository->all();
    }

    public function create($request)
    {
        $permissions = $this->permissionRepository->all()->pluck('name', 'id');

        return compact('permissions');
    }

    public function store($request)
    {
        $input = $request->only('name');
        $permissions = $request->only('permissions');

        return $this->transaction(function () use ($permissions, $input) {
            $role = $this->roleRepository->create($input);
            $role->syncPermissions($permissions);

            return $role;
        });
    }

    public function update($request)
    {
        $role = $this->roleRepository->findOrFail($request->route('role'));
        $input = $request->only('name');
        $permissions = $request->only('permissions');

        return $this->transaction(function () use ($permissions, $role, $input) {
            $role->syncPermissions($permissions);

            return $role->update($input);
        });
    }

    public function edit($request)
    {
        $role = $this->roleRepository->findOrFail($request->route('role'));
        $permissions = $this->permissionRepository->all()->pluck('name', 'id');
        $gavePermission = $role->permissions()->pluck('name', 'id');

        return compact('role', 'permissions', 'gavePermission');
    }

    public function delete($request)
    {
        return $this->transaction(function () use ($request) {
            return $this->roleRepository->findOrFail($request->route('role'))->delete();
        });
    }
}
