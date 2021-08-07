<?php

namespace App\Services\Api\Profile;

use App\Common\Util;
use App\Exceptions\Api\UnauthorizedException;
use App\Repositories\Contracts\ProfileRepository;
use App\Services\AbstractService;

class ProfileService extends AbstractService
{
    /**
     * @var ProfileRepository
     */
    private $repository;

    /**
     * ProfileService constructor.
     *
     * @param ProfileRepository $repository
     */
    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle update user's profile.
     *
     * @param Request $request
     * @return Response
     */
    public function update($request)
    {
        $profile = $this->repository->findByField('user_id', user()->id)->first();

        return $this->transaction(function () use ($request, $profile) {
            $data = $request->only($this->repository->getFillable());
            $path = config('model.profile.avatar_path');

            if ($request->has('avatar')) {
                $data['avatar'] = Util::uploadFile($request->file('avatar'), $path, 'public');
            }

            if ($profile->update($data)) {
                return $profile->load('user');
            }

            throw new UnauthorizedException;
        });
    }

    /**
     * Handle show user's profile.
     *
     * @param Request $request
     * @return Response
     */
    public function show($request)
    {
        return $this->repository->with('user')->findByField('user_id', user()->id)->first();
    }
}
