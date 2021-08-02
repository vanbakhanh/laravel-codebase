<?php

namespace App\Services\Web\Permission;

use App\Repositories\Contracts\PermissionRepository;
use App\Services\AbstractService;
use Auth;

class UpdateService extends AbstractService
{
    /**
     * @var PermissionRepository
     */
    private $repository;

    /**
     * PermissionService constructor.
     *
     * @param PermissionRepository $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($request)
    {
        $permission = $this->repository->findOrFail($request->route('permission'));
        $input = $request->only('name');

        return $this->transaction(function () use ($request, $permission, $input) {
            return $permission->update($input);
        });
    }
}
