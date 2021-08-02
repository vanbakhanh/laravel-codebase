<?php

namespace App\Services\Web\Role;

use App\Repositories\Contracts\RoleRepository;
use App\Services\AbstractService;
use Auth;

class UpdateService extends AbstractService
{
    /**
     * @var RoleRepository
     */
    private $repository;

    /**
     * RoleService constructor.
     *
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($request)
    {
        $role = $this->repository->findOrFail($request->route('role'));
        $input = $request->only('name');
        $permissions = $request->only('permissions');

        return $this->transaction(function () use ($permissions, $role, $input) {
            $role->syncPermissions($permissions);

            return $role->update($input);
        });
    }
}
