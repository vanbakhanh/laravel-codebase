<?php

namespace App\Services\Web\Role;

use App\Repositories\Contracts\RoleRepository;
use App\Services\AbstractService;
use Auth;

class ListService extends AbstractService
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

    /**
     * Get list role.
     * @return array
     */
    public function handle($request)
    {
        return $this->repository->all();
    }
}
