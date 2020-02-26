<?php

namespace App\Services\Api\FcmUser;

use App\Repositories\Contracts\FcmUserRepository;
use App\Services\AbstractService;

class DeleteService extends AbstractService
{
    /**
     * @var FcmUserRepository
     */
    private $repository;

    /**
     * DeleteService constructor.
     *
     * @param FcmUserRepository $repository
     */
    public function __construct(FcmUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Delete fcm user.
     */
    public function handle($request)
    {
        $token = $request->get('fcm_token');

        return $this->transaction(function () use ($token) {
            return $this->repository->findWhere(['token' => $token])->delete();
        });
    }
}
