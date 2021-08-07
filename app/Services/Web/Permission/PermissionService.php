<?php

namespace App\Services\Web\Permission;

use App\Repositories\Contracts\PermissionRepository;
use App\Services\AbstractService;

class PermissionService extends AbstractService
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

    public function update($request)
    {
        $permission = $this->repository->findOrFail($request->route('permission'));
        $input = $request->only('name');

        return $this->transaction(function () use ($permission, $input) {
            return $permission->update($input);
        });
    }

    public function store($request)
    {
        $input = $request->only('name');

        return $this->transaction(function () use ($input) {
            return $this->repository->create($input);
        });
    }

    public function list($request)
    {
        return $this->repository->all();
    }

    public function edit($request)
    {
        return $this->repository->findOrFail($request->route('permission'));
    }

    public function delete($request)
    {
        return $this->transaction(function () use ($request) {
            return $this->repository->findOrFail($request->route('permission'))->delete();
        });
    }
}
