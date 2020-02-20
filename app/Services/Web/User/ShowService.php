<?php

namespace App\Services\Web\User;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use Auth;

class ShowService extends AbstractService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($request)
    {
        return $this->repository->find($request->route('user'));
    }
}
