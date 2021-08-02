<?php

namespace App\Services\Web\Permission;

use App\Repositories\Contracts\PermissionRepository;
use App\Services\AbstractService;
use Auth;

class DestroyService extends AbstractService
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
        return $this->transaction(function () use ($request) {
            return $this->repository->findOrFail($request->route('permission'))->delete();
        });
    }
}
