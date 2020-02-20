<?php

namespace App\Services\Api\User;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;

class ShowService extends AbstractService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * ShowService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle show user.
     *
     * @param int $id
     * @return Response
     */
    public function handle($request)
    {
        return user()->load('profile');
    }
}
