<?php

namespace App\Services\Web\Role;

use App\Repositories\Contracts\RoleRepository;
use App\Services\AbstractService;
use Auth;

class DestroyService extends AbstractService
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
        return $this->transaction(function () use ($request) {
            return $this->repository->findOrFail($request->route('role'))->delete();
        });
    }
}
