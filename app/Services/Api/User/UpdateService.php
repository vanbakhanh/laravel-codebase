<?php

namespace App\Services\Api\User;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;

class UpdateService extends AbstractService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UpdateService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle update user.
     *
     * @param Request $request
     * @return Response
     */
    public function handle($request)
    {
        //
    }
}
