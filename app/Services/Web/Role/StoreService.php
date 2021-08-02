<?php

namespace App\Services\Web\Role;

use App\Repositories\Contracts\RoleRepository;
use App\Services\AbstractService;

class StoreService extends AbstractService
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
        $input = $request->only('name');
        $permissions = $request->only('permissions');

        return $this->transaction(function () use ($permissions, $input) {
            $role = $this->repository->create($input);
            $role->syncPermissions($permissions);

            return $role;
        });
    }
}
