<?php

namespace App\Services\Web\User;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use Auth;

class ListService extends AbstractService
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

    /**
     * Get list all user.
     * @return array
     */
    public function handle($request)
    {
        return $this->repository->with('profile')->paginate(config('constants.pagination'));
    }
}
