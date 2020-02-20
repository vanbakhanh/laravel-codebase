<?php

namespace App\Services\Api\Admin\User;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use Auth;

class DestroyService extends AbstractService
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
        return $this->transaction(function () use ($request) {
            $user = $this->repository->find($request->route('user'));
            
            $user->profile()->delete();
            return $user->delete();
        });
    }
}
