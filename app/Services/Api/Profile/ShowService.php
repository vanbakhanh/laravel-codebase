<?php

namespace App\Services\Api\Profile;

use App\Repositories\Contracts\ProfileRepository;
use App\Services\AbstractService;

class ShowService extends AbstractService
{
    /**
     * @var ProfileRepository
     */
    private $repository;

    /**
     * ShowService constructor.
     *
     * @param ProfileRepository $repository
     */
    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle show user's profile.
     *
     * @param Request $request
     * @return Response
     */
    public function handle($request)
    {
        return $this->repository->with('user')->findByField('user_id', user()->id)->first();
    }
}
