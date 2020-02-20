<?php

namespace App\Services\Web\Profile;

use App\Common\Util;
use App\Repositories\Contracts\ProfileRepository;
use App\Services\AbstractService;

class UpdateService extends AbstractService
{
    /**
     * @var ProfileRepository
     */
    private $repository;

    /**
     * UpdateService constructor.
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
    public function handle($request)
    {
        $profile = $this->repository->findByField('user_id', user()->id)->first();

        return $this->transaction(function () use ($request, $profile) {
            $data = $request->only($this->repository->getFillable());
            $path = config('constants.path.user.avatar');

            if ($request->has('avatar')) {
                $data['avatar'] = Util::uploadFile($request->file('avatar'), $path, 'public');
            }

            return $profile->update($data);
        });
    }
}
