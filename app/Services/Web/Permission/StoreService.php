<?php

namespace App\Services\Web\Permission;

use App\Repositories\Contracts\PermissionRepository;
use App\Services\AbstractService;

class StoreService extends AbstractService
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
        $input = $request->only('name');

        return $this->transaction(function () use ($request, $input) {
            return $this->repository->create($input);
        });
    }
}
